# Using Microsoft 365 SMTP Without App Password

## Option 1: Enable App Passwords (Best for Security)

### Steps:
1. Go to: https://myaccount.microsoft.com/security
2. Click on **"Additional security verification"** or **"Security defaults"**
3. Follow the wizard to enable MFA
4. Add a verification method (phone, email, or authenticator app)
5. Once MFA is enabled, you can create app passwords

## Option 2: Use Modern Authentication (If Enabled by Admin)

Some organizations allow Modern Authentication for SMTP. Try your regular password:

### On Render Dashboard:
1. Go to your service
2. Click **"Environment"**
3. Add these variables:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=hello@carbon2030.ai
MAIL_PASSWORD=your-current-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@carbon2030.ai
MAIL_FROM_NAME="Carbon AI"
```

**Note:** This only works if:
- Your organization allows Modern Auth for SMTP
- No specific app password policy is enforced

## Option 3: Check Organization Settings

If hello@carbon2030.ai is a business account, the IT admin controls these settings.

### What to Check:
1. Contact your IT department or domain administrator
2. Ask if they can:
   - Enable app passwords for your account
   - Allow Modern Authentication for your application
   - Create a service account specifically for sending emails

### Information for Your Admin:
- **Application**: Laravel PHP
- **Purpose**: Transactional emails (waitlist confirmations)
- **Protocol**: SMTP (smtp.office365.com:587)
- **Requirement**: App password or Modern Auth exception

## Option 4: Use a Transactional Email Service (Recommended for Production)

Services like SendGrid, Mailgun, or AWS SES:
- Don't require app passwords
- Better deliverability
- Built for application emails
- Free tiers available

**SendGrid Setup (Recommended):**
1. Sign up at https://sendgrid.com
2. Verify your domain (carbon2030.ai)
3. Get API key
4. Update Render environment variables:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@carbon2030.ai
MAIL_FROM_NAME="Carbon AI"
```

## Testing Your Current Setup

If you want to try without enabling MFA first:

1. **Update Render Environment** with your current password
2. **Deploy** the changes
3. **Test** by submitting the waitlist form
4. **Check logs** in Render dashboard for any errors

If you see authentication errors in the logs, then you'll need to:
- Enable MFA and create app password, OR
- Use a transactional email service

## Current Status

Based on your configuration, you have:
- ✅ SMTP configured for Microsoft 365
- ✅ Username and password set
- ❓ Whether Modern Auth is allowed by your organization
- ❓ Whether your current password will work with SMTP

**Next steps:**
1. Try submitting the waitlist form again
2. Check Render logs for any authentication errors
3. If it fails, enable MFA or switch to a transactional email service

