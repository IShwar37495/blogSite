<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Authenticated</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error 401</h1>
        <p> We think you are not authenticated. Please login first.</p>
        <a href="{{ route('login') }}" class="btn">Login</a>
    </div>
</body>
</html>
