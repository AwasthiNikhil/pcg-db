<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black font-sans flex justify-center items-center min-h-screen">

    <div class="w-full max-w-sm p-8 rounded-lg shadow-lg">
        <h2 class="text-4xl font-semibold text-center mb-4">Admin Login</h2>
        <p class="text-lg text-center mb-6">Sign in to your account to continue</p>

        <div>
            @if (session('error'))
                <div class="text-red-600 text-center text-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-lg mb-2">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        autofocus
                        class="w-full p-3 text-lg border-2 border-black rounded-md focus:outline-none focus:border-blue-500"
                    />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-lg mb-2">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="w-full p-3 text-lg border-2 border-black rounded-md focus:outline-none focus:border-blue-500"
                    />
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full py-3 text-xl font-semibold text-white bg-black rounded-md hover:bg-gray-700 transition"
                >
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>
