<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Auth\SocialAuthController;

// Waitlist routes
Route::get('/waitlist', [App\Http\Controllers\WaitlistController::class, 'index'])->name('waitlist');
Route::post('/waitlist', [App\Http\Controllers\WaitlistController::class, 'store'])->name('waitlist.store');

// Email test route
Route::get('/test-email-config', function () {
    try {
        // Test SMTP configuration
        $mailer = config('mail.mailers.smtp');
        $mailFrom = config('mail.from');
        $testEmail = request('email', 'test@example.com');

        // First, just show current configuration
        $config = [
            'status' => 'checking',
            'mailer' => env('MAIL_MAILER', 'not set'),
            'host' => env('MAIL_HOST', 'not set'),
            'port' => env('MAIL_PORT', 'not set'),
            'username' => env('MAIL_USERNAME', 'not set'),
            'encryption' => env('MAIL_ENCRYPTION', 'not set'),
            'from_address' => env('MAIL_FROM_ADDRESS', 'not set'),
            'from_name' => env('MAIL_FROM_NAME', 'not set'),
            'config_from' => $mailFrom,
        ];

        // Attempt to send test email
        Mail::raw('This is a test email from Carbon AI. If you receive this, your email configuration is working!', function($message) use ($testEmail, $mailFrom) {
            $message->to($testEmail)
                    ->subject('Test Email from Carbon AI')
                    ->from($mailFrom['address'], $mailFrom['name']);
        });

        $config['status'] = 'success';
        $config['message'] = 'Test email sent successfully!';
        $config['to'] = $testEmail;

        return response()->json($config);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send email',
            'error' => $e->getMessage(),
            'mailer' => env('MAIL_MAILER', 'not set'),
            'host' => env('MAIL_HOST', 'not set'),
            'error_class' => get_class($e),
            'error_file' => $e->getFile() . ':' . $e->getLine(),
        ], 500);
    }
})->name('test.email');

// Health check for Railway
Route::get('/health', function () {
    $cssFiles = [];
    if (is_dir(public_path('css'))) {
        $cssFiles = array_values(array_diff(scandir(public_path('css')), ['.', '..']));
    }

    return response()->json([
        'status' => 'ok',
        'app' => config('app.name'),
        'env' => config('app.env'),
        'url' => config('app.url'),
        'database' => config('database.default'),
        'css_files' => $cssFiles,
        'css_path' => public_path('css'),
    ]);
});

Route::get('/', function () {
    return view('home');
});

Route::get('/solutions', function () {
    return view('solutions');
});

Route::get('/blogs', function () {
    return view('blogs');
});

Route::get('/about', function () {
    return view('about');
});

// Test CSS loading
Route::get('/test-css', function () {
    return '<html><head>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/admin_style.css">
        <link rel="stylesheet" href="/css/font.css">
    </head><body><h1>CSS Test</h1><div class="navbar">Navbar Test</div></body></html>';
});

Route::get('/contact', function () {
    return view('contact');
});

// Social Authentication Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
Route::get('/auth/microsoft', [SocialAuthController::class, 'redirectToMicrosoft'])->name('auth.microsoft');
Route::get('/auth/microsoft/callback', [SocialAuthController::class, 'handleMicrosoftCallback']);
// Apple auth temporarily disabled for PHP 8.2 compatibility
// Route::get('/auth/apple', [SocialAuthController::class, 'redirectToApple'])->name('auth.apple');
// Route::get('/auth/apple/callback', [SocialAuthController::class, 'handleAppleCallback']);

// Account Dashboard Routes - Temporarily without authentication
Route::prefix('account')->name('account.')->group(function () {
    Route::get('/', function () {
        return view('account.index');
    })->name('index');

    Route::resource('locations', LocationController::class);
    Route::get('locations/create/single', [LocationController::class, 'createSingle'])->name('locations.create.single');
    Route::get('locations/create/multiple', [LocationController::class, 'createMultiple'])->name('locations.create.multiple');

    Route::resource('vehicles', VehicleController::class);
    Route::resource('equipment', EquipmentController::class);

    // Scope 1 Routes
    Route::get('scope1/natural-gas', [App\Http\Controllers\NaturalGasController::class, 'index'])->name('scope1.natural-gas');
    Route::post('scope1/natural-gas', [App\Http\Controllers\NaturalGasController::class, 'store'])->name('scope1.natural-gas.store');
    Route::get('scope1/vehicle-usage-fuel', [App\Http\Controllers\VehicleUsageFuelController::class, 'index'])->name('scope1.vehicle-usage-fuel');
    Route::post('scope1/vehicle-usage-fuel', [App\Http\Controllers\VehicleUsageFuelController::class, 'store'])->name('scope1.vehicle-usage-fuel.store');
    Route::get('scope1/vehicle-usage-distance', [App\Http\Controllers\VehicleUsageDistanceController::class, 'index'])->name('scope1.vehicle-usage-distance');
    Route::post('scope1/vehicle-usage-distance', [App\Http\Controllers\VehicleUsageDistanceController::class, 'store'])->name('scope1.vehicle-usage-distance.store');
    Route::get('scope1/fuel-consumption-equipment', [App\Http\Controllers\FuelConsumptionEquipmentController::class, 'index'])->name('scope1.fuel-consumption-equipment');
    Route::post('scope1/fuel-consumption-equipment', [App\Http\Controllers\FuelConsumptionEquipmentController::class, 'store'])->name('scope1.fuel-consumption-equipment.store');

    // Scope 2 Routes
    Route::get('scope2/electricity-usage', [App\Http\Controllers\ElectricityController::class, 'index'])->name('scope2.electricity-usage');
    Route::post('scope2/electricity-usage', [App\Http\Controllers\ElectricityController::class, 'store'])->name('scope2.electricity-usage.store');
    Route::get('scope2/heat-steam-usage', [App\Http\Controllers\HeatSteamController::class, 'index'])->name('scope2.heat-steam-usage');
    Route::post('scope2/heat-steam-usage', [App\Http\Controllers\HeatSteamController::class, 'store'])->name('scope2.heat-steam-usage.store');
    Route::get('scope2/purchased-cooling', [App\Http\Controllers\PurchasedCoolingController::class, 'index'])->name('scope2.purchased-cooling');
    Route::post('scope2/purchased-cooling', [App\Http\Controllers\PurchasedCoolingController::class, 'store'])->name('scope2.purchased-cooling.store');

    // Scope 3 Routes
    Route::get('scope3', [App\Http\Controllers\Scope3Controller::class, 'index'])->name('scope3.index');
    Route::get('scope3/purchased-goods-services', [App\Http\Controllers\Scope3Controller::class, 'purchasedGoodsServices'])->name('scope3.purchased-goods-services');
    Route::get('scope3/business-travel', [App\Http\Controllers\Scope3Controller::class, 'businessTravel'])->name('scope3.business-travel');
    Route::post('scope3/remove-source', [App\Http\Controllers\Scope3Controller::class, 'removeSource'])->name('scope3.remove-source');
    Route::post('scope3/restore-source', [App\Http\Controllers\Scope3Controller::class, 'restoreSource'])->name('scope3.restore-source');
    Route::post('scope3/save-categories', [App\Http\Controllers\Scope3Controller::class, 'saveCategories'])->name('scope3.save-categories');
    Route::get('scope3/category/{category}', [App\Http\Controllers\Scope3Controller::class, 'showCategory'])->name('scope3.category');
    Route::get('scope3/footprint-analytics', [App\Http\Controllers\Scope3Controller::class, 'footprintAnalytics'])->name('scope3.footprint-analytics');

    // Reports inside admin group (ensure only one admin prefix)
    Route::get('reports/cdp', [App\Http\Controllers\ReportsController::class, 'cdp'])->name('reports.cdp');
    Route::get('reports/ghg-methodology', [App\Http\Controllers\ReportsController::class, 'methodology'])->name('reports.methodology');
    Route::get('reports/sustainability', [App\Http\Controllers\ReportsController::class, 'sustainability'])->name('reports.sustainability');
    Route::get('reports/secr', [App\Http\Controllers\ReportsController::class, 'secr'])->name('reports.secr');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
