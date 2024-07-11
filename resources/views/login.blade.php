<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for login page */
        .login-card {
            width: 35%; 
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-option {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-bottom: 20px;
        }
        .login-option button {
            outline: none;
            border: none;
            background: transparent;
            cursor: pointer;
            font-weight: bold;
            color: #4a4a4a;
            padding: 5px 10px;
            transition: all 0.3s ease;
        }
        .login-option button.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        .login-option button:hover {
            color: #007bff;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="login-card mt-10">
        <!-- Login Options -->
        <div class="login-option mb-6">
            <button id="userLoginBtn" class="active" onclick="toggleLoginOption('user')">User</button>
            <button id="adminLoginBtn" onclick="toggleLoginOption('admin')">Admin</button>
        </div>

        <!-- User Login Form -->
        <form method="POST" action="{{ route('login.user') }}" id="userLoginForm">
            @csrf
            <h2 class="text-3xl font-bold text-center mb-6">User Login</h2>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login as User
            </button>
        </form>
        
        <!-- Admin Login Form -->
        <form method="POST" action="{{ route('login.admin') }}" id="adminLoginForm" class="hidden">
            @csrf
            <h2 class="text-3xl font-bold text-center mb-6">Admin Login</h2>
            <div class="mb-4">
                <label for="adminEmail" class="block text-sm font-medium text-gray-700">Admin Email</label>
                <input id="adminEmail" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="adminPassword" class="block text-sm font-medium text-gray-700">Admin Password</label>
                <input id="adminPassword" type="password" name="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login as Admin
            </button>
        </form>
    </div>

    <script>
        // Function to toggle between User and Admin login forms
        function toggleLoginOption(option) {
            if (option === 'user') {
                document.getElementById('userLoginForm').classList.remove('hidden');
                document.getElementById('adminLoginForm').classList.add('hidden');
                document.getElementById('userLoginBtn').classList.add('active');
                document.getElementById('adminLoginBtn').classList.remove('active');
            } else if (option === 'admin') {
                document.getElementById('userLoginForm').classList.add('hidden');
                document.getElementById('adminLoginForm').classList.remove('hidden');
                document.getElementById('userLoginBtn').classList.remove('active');
                document.getElementById('adminLoginBtn').classList.add('active');
            }
        }
    </script>
</body>
</html>










