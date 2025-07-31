<h3 class="text-xl font-semibold mb-4">Player Management</h3>

<!-- Search and Filters -->
<div class="flex mb-4">
    <input type="text" id="searchInput" class="p-2 border border-black mr-4" placeholder="Search by Username">
    <select id="statusFilter" class="p-2 border border-black">
        <option value="">All Statuses</option>
        <option value="active">Active</option>
        <option value="banned">Banned</option>
    </select>
</div>

<!-- Player Table -->
<table class="table-auto w-full text-sm border-collapse">
    <thead>
        <tr class="border-b">
            <th class="py-2 px-4">Username</th>
            <th class="py-2 px-4">Total Score</th>
            <th class="py-2 px-4">Last Login</th>
            <th class="py-2 px-4">Actions</th>
        </tr>
    </thead>
    <tbody id="playerTableBody">
        <!-- Players will be listed here dynamically -->
    </tbody>
</table>

<!-- Player Details -->
<div class="tab-content" id="playerDetails" style="display:none;">
    <h3 class="text-xl font-semibold mb-4">Player Details</h3>
    <div id="playerDetailsContent"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchPlayers(); // Load players on page load
    });

    document.getElementById('searchInput').addEventListener('input', fetchPlayers);
    document.getElementById('statusFilter').addEventListener('change', fetchPlayers);

    // Fetch players from the server
    async function fetchPlayers() {
        const searchTerm = document.getElementById('searchInput').value;
        const status = document.getElementById('statusFilter').value;

        try {
            const response = await axios.get('/api/players', {
                params: {
                    search: searchTerm,
                    status: status
                }
            });
            const players = response.data;

            const tableBody = document.getElementById('playerTableBody');
            tableBody.innerHTML = ''; // Clear existing table rows

            players.forEach(player => {
                const row = document.createElement('tr');
                row.classList.add('border-b');

                row.innerHTML = `
                <td class="py-2 px-4 text-center">${player.username}</td>
                <td class="py-2 px-4 text-center">${player.total_score}</td>
                <td class="py-2 px-4 text-center">${player.last_login ? new Date(player.last_login).toLocaleString() : 'null'}</td>
                <td class="py-2 px-4 text-center">
                    <button class="text-blue-500 hover:underline" onclick="viewPlayerDetails(${player.id})">View</button>
                    <button class="text-red-500 hover:underline ml-2" onclick="toggleBanPlayer(${player.id}, '${player.status}')">
                        ${player.status === 'banned' ? 'Unban' : 'Ban'}
                    </button>
                </td>
            `;

                tableBody.appendChild(row);
            });
        } catch (error) {
            console.error('Error fetching players:', error);
        }
    }


    // View Player Details
    function viewPlayerDetails(playerId) {
        axios.get(`/api/players/${playerId}`)
            .then(response => {
                const player = response.data;
                const detailsContent = document.getElementById('playerDetailsContent');

                detailsContent.innerHTML = `
                    <p><strong>Username:</strong> ${player.username}</p>
                    <p><strong>Email:</strong> ${player.email}</p>
                    <p><strong>Total Score:</strong> ${player.total_score}</p>
                    <p><strong>Level:</strong> ${player.level}</p>
                    <p><strong>Items:</strong> ${player.items.map(item => item.name).join(', ')}</p>
                `;

                // Show the player details section
                document.getElementById('playerDetails').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching player details:', error);
            });
    }


    function toggleBanPlayer(playerId, currentStatus) {
        const action = currentStatus === 'banned' ? 'unban' : 'ban';
        axios.post(`/api/players/${playerId}/${action}`)
            .then(response => {
                alert(response.data.message);
                fetchPlayers(); // Refresh the player list
            })
            .catch(error => {
                console.error(`Error ${action} player:`, error);
            });
    }
</script>
