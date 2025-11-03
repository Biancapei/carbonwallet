<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Join Carbon AI | Get Early Access to Net-Zero Solutions</title>
    <meta name="description" content="Join the Carbon AI waitlist to experience AI-driven carbon accounting that helps you track, reduce, and verify emissions with precision toward net zero.">

    <!-- Google Fonts - Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        body {
            background: #000 !important;
            background-image: linear-gradient(rgba(255, 255, 255, 0.1) .6px, transparent 0.6px), linear-gradient(90deg, rgba(255, 255, 255, 0.1) .6px, transparent .6px) !important;
            background-size: 160px 160px !important;
            background-position: 0 0, 0 0 !important;
            background-repeat: repeat !important;
            min-height: 100vh !important;
            position: relative !important;
        }

        .carbon-logo {
            max-width: 10%;
        }

        .waitlist-form {
            width: 100%;
            max-width: 1000px;
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .brand-text {
            font-size: 12px;
            font-weight: 500;
            color: #a0a0a0;
            letter-spacing: 2px;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .main-title {
            font-size: 3.5rem;
            font-weight: 700 !important;
            background: linear-gradient(180deg, #212026 0%, #504f54 30%, #ffffff 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .accent-text {
            font-size: 4.375rem;
            font-weight: 700;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .waitlist-form p {
            font-weight: 300;
            font-size: 1rem;
            line-height: 30px;
            color: #666;
            padding: 0 4rem;
        }

        .form-group {
            margin-bottom: 14px;
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 70%;
            margin: 0 auto; /* center the wrapper so the icon aligns with the input */
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #ffffff;
            font-size: 16px;
            z-index: 1;
            opacity: 0.7;
            pointer-events: none; /* allow clicks to pass through to the input */
        }

        .form-input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            background: #0B0B0B;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            /* Prevent iOS zoom on focus */
            font-size: max(16px, 1em);
        }

        .form-input:focus {
            outline: none;
            border-color: #16d3ca;
            box-shadow: 0 0 0 3px rgba(22, 211, 202, 0.1);
            background: rgba(30, 30, 30, 0.8);
        }

        .form-input::placeholder {
            color: #666;
            font-family: Montserrat;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Override browser autofill styling */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus,
        .form-input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px rgba(30, 30, 30, 0.8) inset !important;
            -webkit-text-fill-color: #ffffff !important;
            background-color: rgba(30, 30, 30, 0.8) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Firefox autofill styling */
        .form-input:-moz-autofill {
            background-color: rgba(30, 30, 30, 0.8) !important;
            color: #ffffff !important;
        }

        /* .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            border-radius: 12px;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            font-family: 'Montserrat', sans-serif;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        } */

        .waitlist-container {
            width: 70%;
            height: 50px;
            position: relative;
            border-radius: 10px;
            margin: 0 auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .waitlist-container:hover {
            transform: translateY(-2px);
        }

        .waitlist-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 10px;
            background:
                linear-gradient(180deg, rgba(102, 102, 102, 0.2) 0%, rgba(102, 102, 102, 0) 33%),
                linear-gradient(180deg, rgba(102, 102, 102, 0) 50%, rgba(102, 102, 102, 0.4) 100%),
                rgba(29, 29, 29, 0.2),
                #1D1D1D;
            box-shadow: inset 0 0 22px rgba(242, 242, 242, 0.5);
            backdrop-filter: blur(12px);
        }

        .waitlist-gradient {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(22, 211, 202, 0.66) 0%, rgba(26, 179, 197, 0.66) 100%);
            box-shadow: inset 7px 7px 10px rgba(22, 211, 202, 0.4);
        }

        .waitlist-text {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            font-family: 'Montserrat';
            font-weight: 500;
            font-size: 16px;
            color: #ffffff;
            word-wrap: break-word;
        }

        .arrow-icon {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover .arrow-icon {
            transform: translateX(4px);
        }

        .footer-text {
            width: 100%;
            margin-top: 2rem;
            padding: 1rem 2rem;
            font-size: .625rem;
            color: #a0a0a0;
            text-align: center;
        }

        .footer-text p {
            margin-bottom: 4px;
        }

        .footer-text p:last-child {
            margin-bottom: 0;
        }

        /* Success Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            align-items: center;
        }

        .modal-content {
            background: radial-gradient(circle at top center, #16D3CA 0%, rgba(22, 211, 202, 0.3) 0%, transparent 35%), linear-gradient(179deg, transparent 0%, #0a0a0a 10%);
            backdrop-filter: blur(20px);
            background-repeat: no-repeat;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin: 15% auto;
            padding: 60px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(324deg, #47D67B, #16D3CA);
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }

        .modal-title {
            font-size: 1.875rem;
            font-weight: 600;
            margin-bottom: 16px;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .modal-message {
            font-size: 0.875rem;
            color: #b6b6b6;
            line-height: 25px;
            font-weight: 400;
        }

        .modal-waitlist-container {
            width: 100%;
            height: 50px;
            position: relative;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-top: 4rem;
        }

        .modal-waitlist-container:hover {
            transform: translateY(-2px);
        }

        .modal-waitlist-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 10px;
            background:
                linear-gradient(180deg, rgba(102, 102, 102, 0.2) 0%, rgba(102, 102, 102, 0) 33%),
                linear-gradient(180deg, rgba(102, 102, 102, 0) 50%, rgba(102, 102, 102, 0.4) 100%),
                rgba(29, 29, 29, 0.2),
                #1D1D1D;
            box-shadow: inset 0 0 22px rgba(242, 242, 242, 0.5);
            backdrop-filter: blur(12px);
        }

        .modal-waitlist-gradient {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(22, 211, 202, 0.66) 0%, rgba(26, 179, 197, 0.66) 100%);
            box-shadow: inset 7px 7px 10px rgba(22, 211, 202, 0.4);
        }

        .modal-waitlist-text {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            font-family: 'Montserrat';
            font-weight: 500;
            font-size: 1rem;
            word-wrap: break-word;
        }

        .success-message {
            display: none;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        /* Inline field validation errors (shown below inputs) */
        .field-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
            display: none;
        }

        @media (max-width: 1200px) {
            .main-title {
                font-size: 3.5rem;
            }

            .modal-title {
                font-size: 1.75rem;
            }

            .modal-message, .submit-btn {
                font-size: .9rem;
                line-height: 20px;
            }

            .modal-btn {
                font-size: .75rem;
            }

            .waitlist-form p {
                font-size: .95rem;
                line-height: 20px;
                padding: 0rem 5rem;
            }

            .footer-text {
                font-size: .5rem;
            }
        }

        /* Tablet Landscape Responsive Styles */
        @media (max-width: 992px) and (orientation: landscape) {
            .container {
                padding: 10px;
            }

            .waitlist-form {
                max-width: 100%;
                padding: 0 5px;
            }

            .main-title {
                font-size: 1.8rem;
                line-height: 1.1;
                margin-bottom: 0.5rem;
            }

            .accent-text {
                font-size: 1.8rem;
                line-height: 1.1;
                margin-bottom: 0.5rem;
            }

            .waitlist-form p {
                font-size: 0.8rem;
                line-height: 1.3;
                padding: 0rem 4rem;
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-input {
                padding: 12px 16px 12px 40px;
                font-size: 0.85rem;
            }

            .form-input::placeholder {
                font-size: 0.8rem;
            }

            .submit-btn {
                padding: 12px 20px;
                font-size: 0.9rem;
                margin-top: 1rem;
            }

            .modal-content {
                width: 85%;
                max-width: 350px;
                padding: 1.5rem 1rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
            }

            .modal-content p {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .modal-btn {
                padding: 10px 20px;
                font-size: 0.85rem;
            }

            .modal-waitlist-text {
                font-size: .875rem;
            }

            .footer-text {
                font-size: .5rem;
                padding: 0 15px;
            }
        }

        /* Mobile Responsive Styles */
        @media (max-width: 992px) and (orientation: portrait) {
            .container {
                padding: 15px;
            }

            .waitlist-form {
                max-width: 100%;
                padding: 0 10px;
            }

            .main-title {
                font-size: 3rem;
                line-height: 1.2;
            }

            .accent-text {
                font-size: 3.5rem;
                line-height: 1.2;
            }

            .waitlist-form p {
                font-size: .9rem;
                line-height: 1.4;
                padding: 0rem 4rem;
            }

            .waitlist-text {
                font-weight: 500;
                font-size: .875rem;
            }

            .form-input {
                padding: 16px 20px 16px 48px;
                font-size: .9rem;
            }

            .form-input::placeholder {
                font-size: 1rem;
            }

            .submit-btn {
                padding: 16px 24px;
                font-size: 1rem;
                margin-top: 1.5rem;
            }

            .modal-content {
                width: 90%;
                max-width: 400px;
                padding: 2rem 1.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 1.75rem;
                margin-bottom: 1rem;
            }

            .modal-content p {
                font-size: .9rem;
                line-height: 1.5;
            }

            .modal-btn {
                padding: 12px 24px;
                font-size: 1rem;
            }

            .footer-text {
                padding: 0 20px;
                font-size: .75rem;
                line-height: 20px;
            }
        }


        /* Responsive design */
        @media (max-width: 640px) {
            .waitlist-form {
                padding: 40px 24px;
                margin: 20px;
            }

            .main-title {
                font-size: 28px;
            }

            .accent-text {
                font-size: 32px;
            }
        }


        @media (max-width: 768px) {
            .carbon-logo {
                max-width: 25%;
            }

            .main-title {
                font-size: 1.875rem;
            }

            .accent-text {
                font-size: 2rem;
            }

            .waitlist-form p {
                font-size: .75rem;
                line-height: 20px;
                padding: 0 1rem;
            }

            .form-input {
                padding: 14px 16px 14px 48px;
                font-size: .9rem;
            }

            .form-input::placeholder {
                font-size: .75rem;
            }

            .submit-btn {
                font-size: 0.75rem;
            }

            .modal-content {
                padding: 4rem 1rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 1.75rem;
            }

            .modal-content p {
                font-size: 0.75rem;
                line-height: 25px;
            }

            .modal-btn {
                font-size: 0.75rem;
            }

            .footer-text {
                font-size: 0.5rem;
                line-height: 15px
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="waitlist-form">
            <!-- Main title -->
            <img src="{{ asset('images/logo.svg') }}" class="carbon-logo">
            <h1 class="main-title">Join the waitlist for</h1>
            <h1 class="accent-text">Carbon AI</h1>

            <p>Be among the first to access Carbon AI's audit-ready carbon accounting platform, purpose-built for verified ESG reporting and measurable progress toward Net Zero.</p>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Waitlist Form -->
            <form method="POST" action="{{ route('waitlist.store') }}" style="width: 100%; max-width: 600px; padding-top: 2rem;">
                @csrf
                <div class="form-group my-5">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-user"></i></div>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            placeholder="{{ old('name', 'Name') }}"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>
                    <div id="nameError" class="field-error"></div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-envelope"></i></div>
                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="{{ old('email', 'Email Address') }}"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                    <div id="emailError" class="field-error"></div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-building"></i></div>
                        <input
                            type="text"
                            name="company"
                            class="form-input"
                            placeholder="{{ old('company', 'Company') }}"
                            value="{{ old('company') }}"
                        >
                    </div>
                </div>

                <div class="waitlist-container" onclick="submitForm()">
                    <div class="waitlist-overlay"></div>
                    <div class="waitlist-gradient"></div>
                    <div class="waitlist-text">Join the Waitlist</div>
                </div>
            </form>
        </div>

        <!-- Footer text -->
        <div class="footer-text">
            <p>Be among the first to access Carbon AI, the audit ready carbon accounting platform built for verified ESG reporting and progress towards Net Zero.</p>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="modal-title">You're on the waitlist</h2>
            <p class="modal-message">Thank you for joining Carbon AI's early access program.<br><br><br><span style="color: #666;">You'll receive a confirmation email shortly with more details about what's next.</span></p>
            <div class="modal-waitlist-container" onclick="closeModal()">
                <div class="modal-waitlist-overlay"></div>
                <div class="modal-waitlist-gradient"></div>
                <div class="modal-waitlist-text">Go Back to Homepage</div>
            </div>
        </div>
    </div>

    <script>
        // Prevent iOS Safari zoom on page load and input focus
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent zoom on page load
            if (window.DeviceOrientationEvent) {
                window.addEventListener('orientationchange', function() {
                    setTimeout(function() {
                        document.body.style.zoom = '1';
                    }, 100);
                });
            }

            // Prevent zoom on input focus
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(function(input) {
                input.addEventListener('focus', function() {
                    // Ensure font size is at least 16px to prevent zoom
                    if (parseInt(window.getComputedStyle(this).fontSize) < 16) {
                        this.style.fontSize = '16px';
                    }
                });
            });
        });

        function submitForm() {
            // Get form inputs
            const nameInput = document.querySelector('input[name="name"]');
            const emailInput = document.querySelector('input[name="email"]');
            const companyInput = document.querySelector('input[name="company"]');
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');

            // Reset inline errors
            nameError.textContent = '';
            emailError.textContent = '';
            nameError.style.display = 'none';
            emailError.style.display = 'none';

            // Check if required fields are filled
            let hasError = false;
            if (!nameInput.value.trim()) {
                nameError.textContent = 'Please enter your name';
                nameError.style.display = 'block';
                if (!hasError) nameInput.focus();
                hasError = true;
            }

            if (!emailInput.value.trim()) {
                emailError.textContent = 'Please enter your email address';
                emailError.style.display = 'block';
                if (!hasError) emailInput.focus();
                hasError = true;
            }

            // Enhanced email validation
            function isValidEmail(email) {
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailRegex.test(email)) return false;
                if (email.includes('..')) return false; // No consecutive dots
                if (email.startsWith('.') || email.endsWith('.')) return false; // No leading/trailing dots
                if (email.includes('@.') || email.includes('.@')) return false; // No dots around @
                return true;
            }

            if (!hasError && !isValidEmail(emailInput.value.trim())) {
                emailError.textContent = 'Please enter a valid email address (e.g., name@company.com)';
                emailError.style.display = 'block';
                emailInput.focus();
                hasError = true;
            }

            if (hasError) {
                return; // Do not submit or show modal
            }

            // Show modal only after validation passes
            showModal();

            // Get form data
            const form = document.querySelector('form');
            const formData = new FormData(form);

            // Submit form in background
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Form submitted successfully');
                } else {
                    console.error('Form submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function showModal() {
            document.getElementById('successModal').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('successModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
