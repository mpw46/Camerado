<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = strip_tags($_POST["phone"]);
    $message = strip_tags($_POST["message"]);

    $to = "ckolly@byu.edu"; // Replace with your actual email
    $subject = "New Contact Form Submission";
    $headers = "From: " . $email . "\r\n" .
            "Reply-To: " . $email . "\r\n" .
            "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} else {
    http_response_code(403);
    echo "Forbidden";
}
?>
