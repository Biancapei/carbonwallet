<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CarbonAI Waitlist!</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #edf2f7;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #ffffff;
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #e8e5ef;
        }
        .logo {
            max-width: 75px;
            height: auto;
        }
        .content {
            padding: 32px;
        }
        .banner {
            text-align: center;
            margin-bottom: 30px;
        }
        .banner img {
            max-width: 200px;
            height: auto;
        }
        h1 {
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            margin-bottom: 16px;
            color: #3d4852;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e8e5ef;
        }
        .footer p {
            color: #b0adc5;
            font-size: 12px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        {{-- <div class="header">
            <img src="https://laravel.com/img/notification-logo.png" alt="Laravel Logo" class="logo">
        </div> --}}

        <div class="content">
            <!-- Banner Image -->
            <div class="banner">
                <img src="https://carbon2030.ai/images/logo.svg">
            </div>

            <!-- Greeting -->
            <h1>Hello {{ $waitlistEntry->name ?: 'there' }}!</h1>

            <!-- Content -->
            <p>Thank you for joining the CarbonAI waitlist!</p>
            <p>We're excited to have you on board as we work towards launching our carbon footprint tracking platform.</p>
            <p>We'll keep you updated on our progress and notify you as soon as CarbonAI is ready for you to use.</p>
            <p>If you have any questions in the meantime, feel free to reach out to us.</p>
            <p><strong>Best regards, <br>The CarbonAI Team</strong></p>
        </div>

        <div class="footer">
            <p>© 2025 Laravel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
