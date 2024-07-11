<!-- resources/views/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        .profile {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-info {
            flex: 1;
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .profile-email {
            color: #666;
        }
        .profile-content {
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #1877f2;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #166fe5;
        }
    </style>
</head>
<body>
   <div class="container">
    <div class="profile">
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ Storage::url($user->profile_pic) }}" alt="Profile Picture">
               
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-email">{{ $user->email }}</div>
                 <p> {{$user->profile_pic}}</p>
                
            </div>
        </div>
        <div class="profile-content">
        
        </div>
        <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
    </div>
</div>
</body>
</html>

