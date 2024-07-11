<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        .blog, .comment {
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }
        .blog h1, .comment h3 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .blog p, .comment p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .meta {
            font-style: italic;
            color: #777;
        }
        .back-link {
            display: block;
            margin-top: 20px;
        }
        .load-more {
            display: block;
            text-align: center;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .load-more:hover {
            background-color: #0056b3;
        }
        .no-comments {
            text-align: center;
            font-size: 18px;
            color: #777;
            margin-top: 20px;
        }
        .add-comment-container {
            margin-bottom: 20px;
        }
        .add-comment-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .add-comment-button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-comment-button:hover {
            background-color: #0056b3;
        }
        .comment {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
        }
        .comment-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: #ccc;
        }
        .comment-body {
            flex: 1;
        }
        .comment-body p {
            margin: 0;
        }
        .comment-body .meta {
            margin-top: 5px;
            color: #555;
            font-size: 12px;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="blog">
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->short_description }}</p>
        <p>{{ $blog->long_description }}</p>
        <div class="meta">
            <p>Written by: {{ $blog->user->name }}</p>
            <p>Published at: {{ $blog->created_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="comments">
        <h2>Comments</h2>
        
        <div class="add-comment-container">
            <form action="{{ route('addComment') }}" method="POST">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <input type="text" name="comment" id="add-comment" class="add-comment-input" placeholder="Add a public comment...">
                <button type="submit" id="submit-comment" class="add-comment-button">Comment</button>
            </form>
        </div>
        
        <div id="comment-list"></div>
        <div id="no-comments" class="no-comments" style="display:none;">Add one.</div>
        <button id="load-more" class="load-more" data-page="1" data-blog-id="{{ $blog->id }}">Load More</button>
    </div>

    <a href="{{ route('home') }}" class="back-link">Back to all blogs</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentList = document.getElementById('comment-list');
            const noCommentsDiv = document.getElementById('no-comments');
            const loadMoreButton = document.getElementById('load-more');
            const blogId = loadMoreButton.getAttribute('data-blog-id');
            let page = 1;

            function renderComments(comments) {
                if (comments.length === 0) {
                    noCommentsDiv.style.display = 'block';
                    loadMoreButton.style.display = 'none';
                } else {
                    comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                       const userId=comment.user.id;
                        commentDiv.classList.add('comment');
                        commentDiv.innerHTML = `
                            <div class="comment-avatar"></div>
                            <div class="comment-body">
                               <a href="/profile/${userId}" class="user-profile-link"><b>${comment.user.name}</b></a>
                                <p>${comment.comment}</p>
                                <p class="meta">Posted at: ${new Date(comment.created_at).toLocaleString()}</p>
                            </div>
                        `;
                        commentList.appendChild(commentDiv);
                    });
                    noCommentsDiv.style.display = 'none';
                    loadMoreButton.style.display = 'block';
                }
            }

            function loadComments(page) {
                fetch(`/blogs/${blogId}/comments?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        renderComments(data);
                        if (data.length < 3) {
                            loadMoreButton.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            loadMoreButton.addEventListener('click', function() {
                page++;
                loadComments(page);
            });

            loadComments(page);
        });
    </script>
</body>
</html>










