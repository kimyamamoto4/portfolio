<?php
/**
 * Simple SMTP Email Sender
 * Sends emails using Gmail SMTP without external dependencies
 */

function sendSMTPEmail($to, $subject, $message, $fromEmail, $fromName, $replyTo = null) {
    $smtp_config = require 'smtp_config.php';
    
    // Connect to Gmail SMTP server
    $smtp = fsockopen($smtp_config['smtp_host'], $smtp_config['smtp_port'], $errno, $errstr, 30);
    
    if (!$smtp) {
        error_log("SMTP Connection Error: $errstr ($errno)");
        return false;
    }
    
    // Read response
    $response = fgets($smtp, 515);
    if (substr($response, 0, 3) != '220') {
        error_log("SMTP Error: $response");
        return false;
    }
    
    // Send EHLO
    fputs($smtp, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
    $response = fgets($smtp, 515);
    
    // Start TLS
    fputs($smtp, "STARTTLS\r\n");
    $response = fgets($smtp, 515);
    
    if (substr($response, 0, 3) != '220') {
        error_log("SMTP STARTTLS Error: $response");
        return false;
    }
    
    // Enable crypto
    stream_socket_enable_crypto($smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    
    // Send EHLO again after TLS
    fputs($smtp, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
    $response = fgets($smtp, 515);
    
    // Authenticate
    fputs($smtp, "AUTH LOGIN\r\n");
    $response = fgets($smtp, 515);
    
    fputs($smtp, base64_encode($smtp_config['smtp_username']) . "\r\n");
    $response = fgets($smtp, 515);
    
    fputs($smtp, base64_encode($smtp_config['smtp_password']) . "\r\n");
    $response = fgets($smtp, 515);
    
    if (substr($response, 0, 3) != '235') {
        error_log("SMTP Authentication Error: $response");
        return false;
    }
    
    // Send email
    fputs($smtp, "MAIL FROM: <{$fromEmail}>\r\n");
    $response = fgets($smtp, 515);
    
    fputs($smtp, "RCPT TO: <{$to}>\r\n");
    $response = fgets($smtp, 515);
    
    fputs($smtp, "DATA\r\n");
    $response = fgets($smtp, 515);
    
    // Build email headers and body
    $headers = "From: {$fromName} <{$fromEmail}>\r\n";
    if ($replyTo) {
        $headers .= "Reply-To: {$replyTo}\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "Subject: {$subject}\r\n";
    
    $email_content = $headers . "\r\n" . $message . "\r\n.\r\n";
    fputs($smtp, $email_content);
    $response = fgets($smtp, 515);
    
    if (substr($response, 0, 3) != '250') {
        error_log("SMTP Send Error: $response");
        return false;
    }
    
    // Close connection
    fputs($smtp, "QUIT\r\n");
    fclose($smtp);
    
    return true;
}
?>
