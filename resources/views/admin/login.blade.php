<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-red-100">

    <div class="">
        <div class="">
            <h2 class="">Admin Login</h2>
            <p class="">Sign in to your account to continue</p>
        </div>

        <div class="">
            @if (session('error'))
                <div class="">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="">
                @csrf

                <div>
                    <label for="email" class="">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        autofocus
                        class=""
                    />
                </div>

                <div>
                    <label for="password" class="">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class=""
                    />
                </div>

                <button
                    type="submit"
                    class=""
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
