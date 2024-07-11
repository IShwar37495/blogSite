<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        h1{
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .blog {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .blog h2 {
            margin-top: 0;
        }
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center; /* Center align pagination */
        }
        .pagination li {
            margin-right: 5px; /* Adjust spacing between pagination items */
        }
        .pagination li a {
            text-decoration: none;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .pagination li a:hover {
            background-color: #0056b3;
        }
        .pagination .active a {
            background-color: #0056b3; /* Active page background color */
        }
        .auth-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .auth-buttons a {
            margin-right: 10px;
        }
        .navbar {
            background-color: #007bff; /* Navbar background color */
            padding: 10px 0;
            margin-bottom: 20px;
        }
        .navbar-brand {
            color: #fff; /* Navbar brand text color */
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar-nav {
            margin-left: auto;
        }
        .navbar-nav .nav-link {
            color: #fff; /* Navbar link text color */
            margin-right: 10px;
        }
        .navbar-nav .nav-link:hover {
            text-decoration: underline; /* Underline on hover for navbar links */
        }
        .delete{
            margin-top: .9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Blogs</h1>
        @foreach($blogs as $blog)
            <div class="blog">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->short_description }}</p>
                <a href="{{ route('blog.show', ['id'=>$blog->id]) }}" class="btn btn-primary">Read More</a>
                 <!-- <a href="{{ route('blog.delete', ['id'=>$blog->id]) }}" class="btn btn-primary delete">DELETE</a> -->
                  <form action="{{ route('blog.delete', ['id' => $blog->id]) }}" method="POST">
                      @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger delete">Delete Blog</button>
             </form>

            </div>
        @endforeach

        {{ $blogs->onEachSide(1)->links() }}
    </div>
</body>
</html>