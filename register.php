<?php
// register.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = htmlspecialchars($_POST['name'] ?? '');
    $usn      = htmlspecialchars($_POST['usn'] ?? '');
    $email    = htmlspecialchars($_POST['email'] ?? '');
    $course   = htmlspecialchars($_POST['course'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');

    // ====== EMAIL CONFIG ======
    $to = "roop262005@gmail.com"; // <-- PUT YOUR EMAIL HERE
    $subject = "New Registration from $name";

    $message = "A new user has registered:\n\n";
    $message .= "Name: $name\n";
    $message .= "USN: $usn\n";
    $message .= "Email: $email\n";
    $message .= "Course: $course\n";

    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mailSent = mail($to, $subject, $message, $headers);
} else {
    // If someone opens register.php directly without submitting the form
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <?php if (!empty($mailSent) && $mailSent): ?>
                <h1>Registration Successful ✅</h1>
                <p class="subtitle">Your details have been sent to the registered email address.</p>
            <?php else: ?>
                <h1>Registration Received ✅</h1>
                <p class="subtitle">
                    Your registration details are submitted, but email could not be sent
                    (mail function may be disabled on this server).
                </p>
            <?php endif; ?>

            <div class="field">
                <label>Name</label>
                <p><?php echo $name; ?></p>
            </div>
            <div class="field">
                <label>USN</label>
                <p><?php echo $usn; ?></p>
            </div>
            <div class="field">
                <label>Email</label>
                <p><?php echo $email; ?></p>
            </div>
            <div class="field">
                <label>Course</label>
                <p><?php echo $course; ?></p>
            </div>

            <a href="index.html" class="btn" style="text-align:center;display:block;margin-top:10px;">
                Back to Registration
            </a>
        </div>
    </div>
</body>
</html>
