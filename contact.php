<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Response array
$response = [
    'success' => false,
    'message' => ''
];

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Sanitize and validate input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get form data
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$subject = isset($_POST['subject']) ? sanitize_input($_POST['subject']) : '';
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required.';
} elseif (strlen($name) < 2) {
    $errors[] = 'Name must be at least 2 characters.';
}

if (empty($email)) {
    $errors[] = 'Email is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
}

if (empty($subject)) {
    $errors[] = 'Subject is required.';
} elseif (strlen($subject) < 3) {
    $errors[] = 'Subject must be at least 3 characters.';
}

if (empty($message)) {
    $errors[] = 'Message is required.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters.';
}

// If there are validation errors
if (!empty($errors)) {
    $response['message'] = implode(' ', $errors);
    echo json_encode($response);
    exit;
}

// ===== OPTION 1: Save to database =====
// Uncomment and configure if you want to save messages to a database
/*
try {
    $db = new PDO('mysql:host=localhost;dbname=portfolio', 'username', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare("INSERT INTO messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$name, $email, $subject, $message]);
    
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I will get back to you soon.';
} catch(PDOException $e) {
    $response['message'] = 'Database error. Please try again later.';
    error_log($e->getMessage());
}
*/

// ===== Send email using SMTP =====
require_once 'smtp_mailer.php';
$smtp_config = require 'smtp_config.php';

$email_subject = "Portfolio Contact: " . $subject;
$email_body = "You have received a new message from your portfolio contact form.\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "Message:\n$message\n";

// Send email using SMTP
if (sendSMTPEmail(
    $smtp_config['to_email'],
    $email_subject,
    $email_body,
    $smtp_config['from_email'],
    $smtp_config['from_name'],
    $email
)) {
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I will get back to you soon.';
} else {
    $response['message'] = 'Failed to send message. Please check your email configuration.';
}

// ===== OPTION 3: Save to file (for testing without email server) =====
// Uncomment this section if you want to save messages to a file for testing
/*
$log_file = 'messages.txt';
$log_entry = date('Y-m-d H:i:s') . " - Name: $name, Email: $email, Subject: $subject, Message: $message\n\n";

if (file_put_contents($log_file, $log_entry, FILE_APPEND)) {
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I will get back to you soon.';
} else {
    $response['message'] = 'Failed to save message. Please try again later.';
}
*/

// Return JSON response
echo json_encode($response);
?>
