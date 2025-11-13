<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

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

// Temporary route to create admin user - REMOVE AFTER USE
Route::get('/create-admin-user', function() {
    try {
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'admin@carbonwallet.com'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('Password123'),
                'email_verified_at' => now(),
            ]
        );

        $user2 = \App\Models\User::updateOrCreate(
            ['email' => 'biancapei.tpy@gmail.com'],
            [
                'name' => 'Bianca',
                'password' => \Illuminate\Support\Facades\Hash::make('Password123'),
                'email_verified_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Admin users created successfully',
            'users' => [
                'admin' => $user->email,
                'bianca' => $user2->email
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile() . ':' . $e->getLine()
        ], 500);
    }
});

// Temporary route to create storage symlink - REMOVE AFTER USE
Route::get('/create-storage-link', function() {
    try {
        $target = storage_path('app/public');
        $link = public_path('storage');
        
        // Remove existing link if it exists
        if (file_exists($link) || is_link($link)) {
            unlink($link);
        }
        
        // Create the symlink
        symlink($target, $link);
        
        return response()->json([
            'success' => true,
            'message' => 'Storage symlink created successfully',
            'target' => $target,
            'link' => $link,
            'link_exists' => file_exists($link),
            'is_link' => is_link($link),
            'readable' => is_readable($link)
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile() . ':' . $e->getLine()
        ], 500);
    }
});

// Check storage symlink status
Route::get('/check-storage', function() {
    $link = public_path('storage');
    $target = storage_path('app/public');
    
    return response()->json([
        'link_exists' => file_exists($link),
        'is_link' => is_link($link),
        'link_path' => $link,
        'target_path' => $target,
        'target_exists' => file_exists($target),
        'readable' => is_readable($link),
        'blog_images_dir' => storage_path('app/public/blog-images'),
        'blog_images_exists' => file_exists(storage_path('app/public/blog-images')),
        'blog_images_files' => file_exists(storage_path('app/public/blog-images')) ? 
            array_slice(scandir(storage_path('app/public/blog-images')), 2) : []
    ], 200, [], JSON_PRETTY_PRINT);
});

// Check if user exists in database
Route::get('/check-user', function() {
    try {
        $adminUser = \App\Models\User::where('email', 'admin@carbonwallet.com')->first();
        $biancaUser = \App\Models\User::where('email', 'biancapei.tpy@gmail.com')->first();

        return response()->json([
            'admin_user_exists' => $adminUser !== null,
            'bianca_user_exists' => $biancaUser !== null,
            'admin_user_id' => $adminUser ? $adminUser->id : null,
            'bianca_user_id' => $biancaUser ? $biancaUser->id : null,
            'total_users' => \App\Models\User::count(),
            'all_users' => \App\Models\User::select('id', 'name', 'email')->get()
        ], 200, [], JSON_PRETTY_PRINT);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile() . ':' . $e->getLine()
        ], 500);
    }
});

// Check migration status (temporary - remove after checking)
Route::get('/check-migration', function() {
    $hasBlogStatus = \Illuminate\Support\Facades\Schema::hasColumn('blogs', 'blog_status');
    $hasCategory = \Illuminate\Support\Facades\Schema::hasColumn('blogs', 'category');
    $hasMetaTitle = \Illuminate\Support\Facades\Schema::hasColumn('blogs', 'meta_title');
    $hasMetaDescription = \Illuminate\Support\Facades\Schema::hasColumn('blogs', 'meta_description');
    $hasMetaKeywords = \Illuminate\Support\Facades\Schema::hasColumn('blogs', 'meta_keywords');

    // Check if blogs exist and are published
    $totalBlogs = \App\Models\Blog::count();
    $publishedBlogs = \App\Models\Blog::where('is_published', true)->count();
    $statusPublishedBlogs = $hasBlogStatus ? \App\Models\Blog::where('blog_status', 'published')->count() : 0;

    return response()->json([
        'columns' => [
            'blog_status_exists' => $hasBlogStatus,
            'category_exists' => $hasCategory,
            'meta_title_exists' => $hasMetaTitle,
            'meta_description_exists' => $hasMetaDescription,
            'meta_keywords_exists' => $hasMetaKeywords,
            'all_columns_exist' => $hasBlogStatus && $hasCategory && $hasMetaTitle && $hasMetaDescription && $hasMetaKeywords
        ],
        'blogs' => [
            'total_blogs' => $totalBlogs,
            'published_via_is_published' => $publishedBlogs,
            'published_via_blog_status' => $statusPublishedBlogs,
            'published_via_scope' => \App\Models\Blog::published()->count()
        ],
        'message' => $hasBlogStatus && $hasCategory ? 'All migrations appear to have run!' : 'Some migrations may be missing.'
    ], 200, [], JSON_PRETTY_PRINT);
});

Route::get('/', [HomeController::class, 'index'])->name('landing');

Route::get('/solutions', function () {
    return view('solutions');
});

Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');

Route::get('/blog', function () {
    return redirect()->route('blogs');
})->name('blog');

Route::get('/article/{blog:slug}', [HomeController::class, 'show'])->name('article.show');

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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});
