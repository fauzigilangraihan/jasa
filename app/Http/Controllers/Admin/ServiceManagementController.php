<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\PricingPackage;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceManagementController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['features'] = $validated['features']
            ? json_encode(array_filter(explode(',', $validated['features'])))
            : null;

        Service::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created_service',
            'model_type' => Service::class,
            'description' => "Service '{$validated['name']}' created",
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.create', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['features'] = $validated['features']
            ? json_encode(array_filter(explode(',', $validated['features'])))
            : null;

        $service->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated_service',
            'model_type' => Service::class,
            'model_id' => $service->id,
            'description' => "Service '{$validated['name']}' updated",
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted_service',
            'model_type' => Service::class,
            'description' => "Service '{$service->name}' deleted",
        ]);

        return back()->with('success', 'Service deleted successfully');
    }

    public function packages(Service $service): View
    {
        $packages = $service->pricingPackages()->get();
        return view('admin.services.packages', compact('service', 'packages'));
    }

    public function createPackage(Service $service): View
    {
        return view('admin.services.create-package', compact('service'));
    }

    public function storePackage(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
            'revision_rounds' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['service_id'] = $service->id;
        $validated['features'] = $validated['features']
            ? json_encode(array_filter(explode(',', $validated['features'])))
            : null;

        PricingPackage::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created_package',
            'model_type' => PricingPackage::class,
            'description' => "Package '{$validated['name']}' created for service '{$service->name}'",
        ]);

        return redirect()->route('admin.service.packages', $service)
            ->with('success', 'Package created successfully');
    }

    public function editPackage(PricingPackage $package): View
    {
        return view('admin.services.edit-package', compact('package'));
    }

    public function updatePackage(Request $request, PricingPackage $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
            'revision_rounds' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['features'] = $validated['features']
            ? json_encode(array_filter(explode(',', $validated['features'])))
            : null;

        $package->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated_package',
            'model_type' => PricingPackage::class,
            'model_id' => $package->id,
            'description' => "Package '{$validated['name']}' updated",
        ]);

        return redirect()->route('admin.service.packages', $package->service)
            ->with('success', 'Package updated successfully');
    }

    public function deletePackage(PricingPackage $package): RedirectResponse
    {
        $service = $package->service;
        $package->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted_package',
            'model_type' => PricingPackage::class,
            'description' => "Package '{$package->name}' deleted",
        ]);

        return redirect()->route('admin.service.packages', $service)
            ->with('success', 'Package deleted successfully');
    }
}
