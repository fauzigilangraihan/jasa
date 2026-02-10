<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\PricingPackage;
use App\Models\OrderFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        // Middleware registered in routes
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first');
        }

        $services = Service::where('is_active', true)->get();
        return view('orders.create', compact('services'));
    }

    public function getPackages(Request $request)
    {
        $packages = PricingPackage::where('service_id', $request->service_id)
            ->where('is_active', true)
            ->get();
        return response()->json($packages);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return back()->with('error', 'Please login first');
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'pricing_package_id' => 'required|exists:pricing_packages,id',
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string',
            'delivery_days' => 'required|integer|min:1',
            'requirements' => 'nullable|string',
            'files.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);

        $package = PricingPackage::findOrFail($validated['pricing_package_id']);

        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'pricing_package_id' => $validated['pricing_package_id'],
            'project_name' => $validated['project_name'],
            'project_description' => $validated['project_description'],
            'requirements' => ['custom_days' => $validated['delivery_days']],
            'total_price' => $package->price,
            'down_payment' => $package->price * 0.3, // 30% down payment
            'status' => 'pending',
            'delivery_date' => now()->addDays($validated['delivery_days']),
        ]);

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('orders/' . $order->id, 'public');
                OrderFile::create([
                    'order_id' => $order->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => 'requirement',
                ]);
            }
        }

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order created successfully. Please proceed with payment.');
    }

    public function show(Order $order): View
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            abort(403);
        }

        $payments = $order->payments()->orderBy('created_at', 'desc')->get();

        return view('orders.show', compact('order', 'payments'));
    }

    public function index(): View
    {
        if (!Auth::check()) {
            abort(401);
        }

        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}

