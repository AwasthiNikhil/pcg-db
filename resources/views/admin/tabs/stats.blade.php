<div>
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Total Players</h3>
            <p id="totalPlayers" class="text-3xl font-bold">{{$totalPlayers ?? 0}}</p>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-2">Players Online</h3>
            <p id="onlinePlayers" class="text-3xl font-bold">0</p>
        </div>
    </div>
</div>

<script type="module">
    import axios from 'axios';

    // Fetch and display real-time stats
    async function fetchStats() {
        try {
            const response = await axios.get('/api/admin/stats');
            const stats = response.data;

            // Update the DOM with the new stats
            document.getElementById('totalPlayers').textContent = stats.totalPlayers;
            document.getElementById('onlinePlayers').textContent = stats.onlinePlayers;

        } catch (error) {
            console.error('Error fetching stats:', error);
        }
    }

    // Fetch stats every 10 seconds
    setInterval(fetchStats, 10000);

    // Initial fetch
    fetchStats();
</script>
