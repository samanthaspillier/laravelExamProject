<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Message Received</title>
</head>
<body>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    <p><strong>Category:</strong> {{ $category }}</p>
    <p><strong>Message:</strong></p>
    <blockquote>{{ $content }}</blockquote>
</body>
</html>
