<?php
/**
 * SMTP Configuration for Gmail (SAFE FOR GITHUB)
 * This is a template file - your actual smtp_config.php is git-ignored
 */

return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_username' => getenv('SMTP_USERNAME') ?: 'your-email@gmail.com',
    'smtp_password' => getenv('SMTP_PASSWORD') ?: 'your-app-password-here',
    'from_email' => getenv('FROM_EMAIL') ?: 'your-email@gmail.com',
    'from_name' => 'Portfolio Contact Form',
    'to_email' => getenv('TO_EMAIL') ?: 'your-email@gmail.com'
];
?>
