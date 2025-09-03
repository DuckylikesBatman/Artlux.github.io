<?php
// contact.php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  // reject non-POST
  http_response_code(405);
  exit('Method Not Allowed');
}

// sanitize inputs
$name    = strip_tags(trim($_POST['name'] ?? ''));
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$message = trim($_POST['message'] ?? '');

$to = 'maher.aboudiab@hotmail.com';    // ← set your real email here
$subject = "New message from $name via ArtLux";
$headers = implode("\r\n", [
  "From: ArtLux Website <$email>",
  "Reply-To: $email",
  "Content-Type: text/plain; charset=UTF-8"
]);

$body  = "Name: $name\n";
$body .= "Email: $email\n\n";
$body .= "Message:\n$message\n";

if ( mail($to, $subject, $body, $headers) ) {
  header('Location: thanks.html');
  exit;
} else {
  http_response_code(500);
  exit('There was a problem sending your message. Please try again later.');
}
