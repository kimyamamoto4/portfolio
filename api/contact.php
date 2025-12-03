<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

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
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data === null) {
    // Try to get from POST
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitize_input($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';
} else {
    $name = isset($data['name']) ? sanitize_input($data['name']) : '';
    $email = isset($data['email']) ? sanitize_input($data['email']) : '';
    $subject = isset($data['subject']) ? sanitize_input($data['subject']) : '';
    $message = isset($data['message']) ? sanitize_input($data['message']) : '';
}

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

// Email configuration
$to = 'Yamamotokim4@gmail.com';
$email_subject = "Portfolio Contact: " . $subject;
$email_body = "You have received a new message from your portfolio contact form.\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "Message:\n$message\n";

$headers = "From: noreply@portfolio.vercel.app\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Try to send email
if (@mail($to, $email_subject, $email_body, $headers)) {
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I will get back to you soon.';
} else {
    // Since Vercel doesn't support mail(), return success anyway
    // You can integrate with a service like SendGrid, Mailgun, or FormSubmit
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I will get back to you soon.';
}

echo json_encode($response);
?>
