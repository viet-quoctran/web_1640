<!DOCTYPE html>
<html>
<head>
    <title>New Contribution Submitted</title>
</head>
<body>
    <h1>A new contribution has been submitted!</h1>
    <p>Contribution ID: {{ $contribution->id }}</p>
    <p>Submitted by: {{ $contribution->user->name }}</p>
    <p>Submitted at: {{ $contribution->created_at->format('Y-m-d H:i:s') }}</p>
    <!-- Thêm các thông tin khác của contribution nếu cần -->
</body>
</html>