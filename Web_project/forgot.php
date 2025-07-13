<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <div class="auth-container">
        <h2>Reset Password</h2>
        <form action="reset_request.php" method="POST">
            <input type="email" name="email" placeholder="Enter Your Email" required>
            <button type="submit" name="reset_request">Forgot Password</button>
        </form>
        <p>Remember your password? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
