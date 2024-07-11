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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .profile {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile h2 {
            margin-top: 0;
        }
        .profile p {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .header{
            text-align: center;
        }

        .profile{
            margin-top: .5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile">
            <h2>User Profile</h2>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

           <div class="header">
            <h2>Blogs</h2>
           </div>
        <div class="container">
            
              @foreach($user->blogs as $post)
              <div class="profile">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->short_description }}</p>
                <a href="{{ route('blog.show', ['id'=>$post->id]) }}" class="btn btn-primary">Read More</a>
            </div>
        @endforeach
        </div>
    </div>
</body>
</html>