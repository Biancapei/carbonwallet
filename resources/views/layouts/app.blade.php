<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @hasSection('meta_title')
        <title>@yield('meta_title')</title>
    @else
        <title>CARBON AI</title>
    @endif
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif
    @hasSection('meta_image')
        @php
            $metaImageUrl = view()->yieldContent('meta_image');
            $imagePath = parse_url($metaImageUrl, PHP_URL_PATH);
            $publicPath = public_path(ltrim($imagePath, '/'));
            $cacheVersion = file_exists($publicPath) ? filemtime($publicPath) : time();
        @endphp
        <meta property="og:image" content="{{ $metaImageUrl }}?v={{ $cacheVersion }}">
        <meta property="og:image:secure_url" content="{{ $metaImageUrl }}?v={{ $cacheVersion }}">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="@yield('meta_title', 'Carbon AI')">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $metaImageUrl }}?v={{ $cacheVersion }}">
    @endif
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_v1.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts - Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    @if(request()->path() === 'about')
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    @endif

    @if(request()->path() === 'blogs')
        <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
    @endif

    @if(request()->path() === 'solutions')
        <link rel="stylesheet" href="{{ asset('css/solutions.css') }}">
    @endif

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Optional Bootstrap JS (for components like collapse, modal, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    defer></script>

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Logo -->
            <div class="navbar-brand d-flex align-items-center">
                <a href="{{ url('/') }}" class="logo-link">
                    <img src="/images/carbonlogoo.png" class="logo-img">
                </a>
            </div>

            <!-- Action Buttons (Desktop) -->
            <div class="navbar-actions d-none d-lg-flex">
                <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
                <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
            </div>

            <!-- Hamburger Menu Button (Mobile) -->
            <button class="navbar-toggler d-lg-none" type="button" id="navbarToggler">
                <div class="hamburger-icon" id="hamburgerIcon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Navigation Links -->
            <div class="navbar-nav-container" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/solutions') }}" aria-expanded="false">
                            AI
                        </a>
                        {{-- <ul class="dropdown-menu" aria-labelledby="aiDropdown">
                            <li><a class="dropdown-item" href="#">AI & Validation Engine</a></li>
                        </ul> --}}
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/blogs') }}" aria-expanded="false">
                            Blogs
                        </a>
                        {{-- <ul class="dropdown-menu" aria-labelledby="insightsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/blogs') }}">Blog</a></li>
                        </ul> --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}" aria-expanded="false">
                            About
                        </a>
                        {{-- <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                            <li><a class="dropdown-item" href="{{ url('/about') }}">About</a></li>
                        </ul> --}}
                    </li>
                </ul>

                <!-- Action Buttons (Mobile) -->
                <div class="navbar-actions d-lg-none">
                    <a href="#" class="start-for-free-btn">Start for Free</a>
                    <a href="#" class="request-demo-btn">Request a Demo</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hamburger Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.getElementById('navbarToggler');
            const navbarNav = document.getElementById('navbarNav');
            const hamburgerIcon = document.getElementById('hamburgerIcon');

            navbarToggler.addEventListener('click', function() {
                navbarNav.classList.toggle('active');
                hamburgerIcon.classList.toggle('active');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = navbarNav.contains(event.target);
                const isClickOnToggler = navbarToggler.contains(event.target);

                if (!isClickInsideNav && !isClickOnToggler && navbarNav.classList.contains('active')) {
                    navbarNav.classList.remove('active');
                    hamburgerIcon.classList.remove('active');
                }
            });

            // Set active navigation link based on current page
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            const dropdownItems = document.querySelectorAll('.dropdown-item');

            // Check main nav links
            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath && linkPath !== '#' && currentPath === linkPath) {
                    link.classList.add('active');
                    link.closest('.nav-item')?.classList.add('active');
                }
            });

            // Check dropdown items
            dropdownItems.forEach(item => {
                const itemPath = item.getAttribute('href');
                if (itemPath && itemPath !== '#' && currentPath === itemPath) {
                    item.classList.add('active');
                    // Also activate the parent dropdown toggle
                    const dropdownToggle = item.closest('.dropdown').querySelector('.dropdown-toggle');
                    if (dropdownToggle) {
                        dropdownToggle.classList.add('active');
                        dropdownToggle.closest('.nav-item')?.classList.add('active');
                    }
                }
            });

            // Add click handlers for nav links to show gradient effect
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all nav links
                    navLinks.forEach(l => l.classList.remove('active'));
                    navLinks.forEach(l => l.closest('.nav-item')?.classList.remove('active'));

                    // Add active class to clicked link
                    this.classList.add('active');
                    this.closest('.nav-item')?.classList.add('active');
                });
            });

            // Initialize Bootstrap dropdowns
            const dropdownElements = document.querySelectorAll('.dropdown-toggle');
            dropdownElements.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    const isCurrentlyOpen = dropdownMenu.classList.contains('show');

                    // Close all other dropdowns first
                    const allDropdownMenus = document.querySelectorAll('.dropdown-menu.show');
                    allDropdownMenus.forEach(menu => {
                        menu.classList.remove('show');
                        const toggle = menu.previousElementSibling;
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });

                    // Toggle current dropdown only if it wasn't already open
                    if (!isCurrentlyOpen && dropdownMenu.classList.contains('dropdown-menu')) {
                        dropdownMenu.classList.add('show');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown')) {
                    const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                    openDropdowns.forEach(dropdown => {
                        dropdown.classList.remove('show');
                        const toggle = dropdown.previousElementSibling;
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Main content -->
    <main class="">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer text-white">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-logo">
                        <img src="{{ asset('images/carbonlogoo.png') }}" alt="Carbon AI Logo" class="footer-logo-img">
                    </div>
                    <div class="footer-addresses mx-2">
                        <div class="footer-address">
                            <span>Level 33, Ilham Tower,<br> 8, Jalan Binjai, 50450 Kuala Lumpur,<br>Malaysia</span>
                            <span>Level 39, MBFC Tower 2, 10 Marina<br> Boulevard, Singapore, 018983</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Navigation Links -->
                <div class="footer-right">
                    <nav class="footer-nav mx-2">
                        <a href="{{ url('/solutions') }}">AI</a>
                        <a href="{{ url('/blogs') }}">Blogs</a>
                        <a href="{{ url('/about') }}">About</a>
                    </nav>
                    <div class="footer-follow-section mt-3">
                        <div class="footer-social">
                            <a href="https://www.linkedin.com/company/carbon2030ai/" target="_blank" class="social-icon" aria-label="LinkedIn">
                                <i class="fab fa-linkedin" style="font-size: 2rem;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="footer-phone d-md-block d-none">
                        <a href="https://wa.me/60125393065" target="_blank">+6012 539 3065</a>&nbsp;&nbsp;
                        <i class="fa-solid fa-mobile-screen-button" style="font-size: 2rem;"></i>
                    </div>

                    {{-- Mobile --}}
                    <div class="footer-phone d-block d-md-none">
                        <i class="fa-solid fa-mobile-screen-button" style="font-size: 2rem;"></i>
                        <a href="https://wa.me/60125393065" target="_blank">+6012 539 3065</a>&nbsp;&nbsp;
                    </div>

                    <div class="footer-waitlist-link mt-2">
                        <a href="{{ url('/waitlist') }}">SIGN UP TO OUR WAITLIST &nbsp; <i class="fa-solid fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Bottom -->
        <div class="footer-bottom text-center py-3">
            <div class="container">
                <small>© {{ date('Y') }} Carbon AI. All rights reserved.</small>
            </div>
        </div>
    </footer>
</body>

</html>
