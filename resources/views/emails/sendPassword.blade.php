<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your New Password</h1>
        <p>Hello,</p>
        <p>Your new password is: <strong>{{ $password }}</strong></p>
        <p>Please make sure to change your password once you log in for the first time.</p>
        <p>If you did not request a new password, please ignore this email or contact support.</p>
    </div>
</body>
</html>
