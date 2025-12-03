# Gmail SMTP Setup Instructions

Your contact form is now configured to send emails via Gmail SMTP!

## ⚠️ IMPORTANT: Setup Required

To make the contact form work, you need to generate a Gmail App Password:

### Step 1: Enable 2-Factor Authentication
1. Go to your Google Account: https://myaccount.google.com/
2. Click "Security" in the left menu
3. Enable "2-Step Verification" if not already enabled

### Step 2: Generate App Password
1. Go to: https://myaccount.google.com/apppasswords
2. Select "Mail" as the app
3. Select "Windows Computer" as the device
4. Click "Generate"
5. Copy the 16-character password (it will look like: xxxx xxxx xxxx xxxx)

### Step 3: Update Configuration
1. Open `smtp_config.php`
2. Replace `'your-app-password-here'` with your generated app password
3. Remove spaces from the password (e.g., `xxxxxxxxxxxxxxxx`)
4. Save the file

## Example Configuration

```php
'smtp_password' => 'abcdеfghijklmnop',  // Your 16-character app password (no spaces)
```

## Testing

Once configured, try sending a message through your contact form. You should receive an email at: **Yamamotokim4@gmail.com**

## Troubleshooting

- **Authentication Failed**: Make sure you're using the App Password, not your regular Gmail password
- **Connection Failed**: Check that port 587 is not blocked by your firewall
- **SSL Error**: Ensure your PHP installation supports TLS/SSL

## Security Note

⚠️ Never commit `smtp_config.php` to public repositories as it contains your email credentials!

Add to `.gitignore`:
```
smtp_config.php
```
