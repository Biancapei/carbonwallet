<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARBON AI</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logoo.svg') }}">
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
                    <img src="/images/latest-logo.png" class="logo-img">
                </a>
                <span class="logo-text">Carbon AI</span>
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
        {{-- <div class="container py-5">
            <div class="row">
                <!-- Newsletter -->
                <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                    <h5 class="mb-3">Subscribe to our Newsletter</h5>
                    <form class="d-flex flex-column flex-sm-row">
                        <input type="email" class="form-control me-sm-2 mb-2 mb-sm-0" placeholder="Enter your email">
                        <button type="submit" class="btn form-submit-btn">Subscribe</button>
                    </form>
                </div>

                <!-- About & Contact -->
                <div class="col-12 col-lg-7">
                    <div class="row"  style="justify-content: right;">
                        <div class="col-6 col-md-4 mb-4 mb-md-0">
                            <h6 class="fw-bold mb-3">Company</h6>
                            <ul class="list-unstyled mt-4">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>

                        <img src="/images/footer-logo.svg" style="max-width: 15%; position: absolute; right: 40%; top: -25%;">

                        <div class="col-6 col-md-4 mb-4 mb-md-0">
                            <a href="/contact" class="fw-bold mb-3">Contact</a>
                            <ul class="list-unstyled mt-4">
                                <li><a href="mailto:info@example.com">info@example.com</a></li>
                                <li><a href="#">+60 123 456 789</a></li>
                                <li><a href="#">Kuala Lumpur, MY</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Copyright -->
        <div class="footer-bottom text-center py-3">
            <small>© {{ date('Y') }} Carbon AI. All rights reserved.</small>
        </div>
    </footer>
</body>

</html>
