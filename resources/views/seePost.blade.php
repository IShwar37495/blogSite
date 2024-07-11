<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e9ecef;
            padding: 20px;
        }
        .post-container {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .post-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .post-description {
            margin-top: 10px;
            color: #555;
        }
        .post-actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .edit-button, .delete-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .edit-button {
            background-color: #007BFF;
            color: white;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>Posts by {{ $user->name }}</h1>

      @if($blogs->isEmpty())
        <div>
            <p>There are no posts.</p>
        </div>
    @endif
    @foreach ($blogs as $post)
        <div class="post-container">
            <div class="post-title">{{ $post->title }}</div>
            <div class="post-description">{{ $post->short_description }}</div>
            <div class="post-description">{{ $post->long_description }}</div>
            <div class="post-actions">
                <a href="{{ route('editPost', $post->id) }}" class="edit-button">Edit</a>
                <form action="{{ route('deletePost', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    <div class="pagination">
        {{ $blogs->links() }}
    </div>
</body>
</html>


