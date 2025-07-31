<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lucky You Admin</title>
    @vite('resources/css/app.css')
    <style>
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body class="bg-white text-black font-sans">
    <!-- Navbar -->
    <nav class="bg-black text-white p-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Lucky You Admin Dashboard</h1>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="outline outline-2 outline-white p-4">Logout</button>
        </form>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-col p-8">
        <!-- Tab Buttons -->
        <div class="tabs flex mb-6 border-b-2 border-black">
            <button id="tab1"
                class="tab-button flex-1 py-2 text-lg font-semibold text-black hover:text-white hover:bg-black transition">Statistics</button>
            <button id="tab2"
                class="tab-button flex-1 py-2 text-lg font-semibold text-black hover:text-white hover:bg-black transition">Players</button>
            <button id="tab3"
                class="tab-button flex-1 py-2 text-lg font-semibold text-black hover:text-white hover:bg-black transition">Skin
                Management</button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content active" id="content-tab1">
            @include('admin.tabs.stats')
        </div>

        <div class="tab-content" id="content-tab2">
            @include('admin.tabs.player')
        </div>

        <div class="tab-content" id="content-tab3">
            @include('admin.tabs.skin')
        </div>
    </div>
    <script>
        // Tab Switching Logic
        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.id; // ID of the clicked tab
                contents.forEach(content => {
                    if (content.id === `content-${target}`) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
            });
        });
    </script>

</body>

</html>
