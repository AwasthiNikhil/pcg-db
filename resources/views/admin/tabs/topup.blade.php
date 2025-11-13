<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Add Coins to User Account</h3>

    <form id="topupForm" class="space-y-4">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Search for a user...">
            <div id="userSuggestions" class="mt-1"></div>
        </div>

        <div>
            <label for="coins" class="block text-sm font-medium text-gray-700">Coins</label>
            <input type="number" id="coins" name="coins" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Enter amount of coins to add">
        </div>

        <input type="hidden" id="userId" name="user_id">

        <button type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Add Coins
        </button>
    </form>

    <div id="topupResult" class="mt-6"></div>
</div>

<script type="module">
    import axios from 'axios';
    document.addEventListener('DOMContentLoaded', function () {
        const usernameInput = document.getElementById('username');
        const userSuggestions = document.getElementById('userSuggestions');
        const userIdInput = document.getElementById('userId');
        const topupForm = document.getElementById('topupForm');
        const topupResult = document.getElementById('topupResult');

        usernameInput.addEventListener('input', async function () {
            const query = usernameInput.value;
            if (query.length < 2) {
                userSuggestions.innerHTML = '';
                return;
            }

            try {
                const response = await axios.get(`/api/admin/users/search?q=${query}`);
                const users = response.data;

                let suggestionsHtml = '<ul class="border border-gray-300 rounded-md">';
                users.forEach(user => {
                    suggestionsHtml += `<li class="p-2 cursor-pointer hover:bg-gray-100" data-id="${user.id}" data-username="${user.username}">${user.username}</li>`;
                });
                suggestionsHtml += '</ul>';
                userSuggestions.innerHTML = suggestionsHtml;

            } catch (error) {
                console.error('Error searching for users:', error);
            }
        });

        userSuggestions.addEventListener('click', function (e) {
            if (e.target && e.target.nodeName === 'LI') {
                usernameInput.value = e.target.dataset.username;
                userIdInput.value = e.target.dataset.id;
                userSuggestions.innerHTML = '';
            }
        });

        topupForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const userId = userIdInput.value;
            const coins = document.getElementById('coins').value;

            if (!userId) {
                topupResult.innerHTML = '<p class="text-red-500">Please select a user.</p>';
                return;
            }

            try {
                const response = await axios.post('/api/admin/topup', {
                    user_id: userId,
                    coins: coins
                });

                topupResult.innerHTML = `<p class="text-green-500">${response.data.message}</p>`;
                topupForm.reset();
                userIdInput.value = '';

            } catch (error) {
                topupResult.innerHTML = '<p class="text-red-500">An error occurred while adding coins.</p>';
                console.error('Error adding coins:', error);
            }
        });
    });
</script>