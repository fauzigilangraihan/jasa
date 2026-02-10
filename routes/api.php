<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Public API routes
Route::get('/services', [HomeController::class, 'getServices']);
Route::get('/portfolios', [HomeController::class, 'getPortfolios']);
Route::get('/testimonials', [HomeController::class, 'getTestimonials']);
Route::get('/faqs', [HomeController::class, 'getFaqs']);
Route::get('/pricing-packages', [HomeController::class, 'getPricingPackages']);
