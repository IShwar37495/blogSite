<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f0f0f0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        a {
            text-decoration: none;
            color: black;
        }
        .load-more-btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .load-more-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        
        <div class="navbar">
            <a href="#users">All Users</a>
            <a href="{{route('admin.index')}}">All Blogs</a>
        </div>

        <section id="users">
            <h2>All Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Is Admin</th>
                        <th>Profile Picture</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('seeProfile', ['userId' => $user->id]) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td>
                                @if ($user->profile_pic)
                                    <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Picture" width="50">
                                @else
                                    No Picture
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button id="loadMoreBtn" class="load-more-btn" data-page="1">Load More</button>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreButton = document.getElementById('loadMoreBtn');
            let page = 2;

            async function loadMoreUsers(page) {
                try {
                    const response = await fetch(`/loadMore/${page}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();
                    appendUsersToTable(data);
                } catch (error) {
                    console.error('Error loading more users:', error);
                }
            }

            function appendUsersToTable(users) {
                const userTableBody = document.getElementById('userTableBody');
                users.data.forEach(user => {
                    const userRow = `
                        <tr>
                            <td>${user.id}</td>
                            <td><a href="/profile/${user.id}" class="user-profile-link">${user.name}</a></td>
                            <td>${user.email}</td>
                            <td>${user.is_admin ? 'Yes' : 'No'}</td>
                            <td>
                                ${user.profile_pic ? `<img src="{{ asset('storage/') }}/${user.profile_pic}" alt="Profile Picture" width="50">` : 'No Picture'}
                            </td>
                        </tr>
                    `;
                    userTableBody.insertAdjacentHTML('beforeend', userRow);
                });
                loadMoreButton.setAttribute('data-page', users.current_page + 1);
            }

            loadMoreButton.addEventListener('click', function() {
                page++;
                loadMoreUsers(page);
            });

            // loadMoreUsers(page);
        });
    </script>
</body>
</html>





