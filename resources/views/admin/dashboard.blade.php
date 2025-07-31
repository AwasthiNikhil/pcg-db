<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .outline-button {
            border: 2px solid black;
            background: white;
            color: black;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .outline-button:hover {
            background: black;
            color: white;
        }
    </style>
</head>
<body class="p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">🎮 Admin Dashboard</h1>

        <p class="mb-6">Welcome back, admin. Use the panel to manage players, skins, and level rules.</p>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="outline-button">Logout</button>
        </form>
    </div>
</body>
</html>
