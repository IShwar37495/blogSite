<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: all 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .form-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn:active {
            background-color: #004085;
            transform: translateY(0);
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('signupUser') }}" class="form-container" enctype="multipart/form-data">
        @csrf
        <h2 class="form-title">Signup</h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <span class="error">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="form-group">
           <label for="profile_pic">Profile Picture</label>
           <input type="file" id="profile_pic" name="profile_pic">
           @if ($errors->has('profile_pic'))
                <span class="error">{{ $errors->first('profile_pic') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Signup</button>
        </div>
    </form>
</body>
</html>
