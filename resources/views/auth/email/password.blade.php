<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password Reset</h2>

<div>
    Reset your password by clicking <a href="{{ "reset-password/{$user->getUserId()}/{$code}" }}">here</a> <br>
    This link will expire in 60 minutes.
</div>
</body>
</html>