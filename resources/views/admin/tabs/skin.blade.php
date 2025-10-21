<div class="tab-content" id="content-tab3">
    <h3 class="text-xl font-semibold mb-4">Skin Management</h3>
    <div class="flex">

        <!-- Add New Skin Form -->
        <form id="addSkinForm" class="w-1/4 mb-6 space-y-4" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" required class="p-2 border border-black w-full">
            <textarea name="description" placeholder="Description" class="p-2 border border-black w-full"></textarea>
            <input type="number" name="price" placeholder="Price" required class="p-2 border border-black w-full">
            <input type="number" name="rarity" placeholder="Rarity (1–100)" required
                class="p-2 border border-black w-full">

            <input type="file" name="image" accept="image/*" class="p-2 border border-black w-full">

            <button type="submit" class="px-4 py-2 bg-black text-white">Add Skin</button>
        </form>


        <!-- Existing Skins Table -->
        <table class=" w-3/4 table-auto  text-sm border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Rarity</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody id="skinTableBody">
                <!-- skins inserted here -->
            </tbody>
        </table>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', loadSkins);
    document.getElementById('addSkinForm').addEventListener('submit', addSkin);

    async function loadSkins() {
        const resp = await axios.get('/api/skins');
        const skins = resp.data;
        const tbody = document.getElementById('skinTableBody');
        tbody.innerHTML = '';
        skins.forEach(s => {
            const tr = document.createElement('tr');
            tr.classList.add('border-b');
            tr.innerHTML = `
            <td class="text-center px-4 py-2">${s.name}</td>
            <td class="text-center px-4 py-2">${s.description}</td>
            <td class="text-center px-4 py-2">${s.price}</td>
            <td class="text-center px-4 py-2">${s.rarity}</td>
            <td class="text-center px-4 py-2">
                ${s.image_path ? `<img src="/storage/${s.image_path}" class="w-16 h-16 object-cover rounded" />` : 'No Image'}
            </td>
            <td class="text-center px-4 py-2">${s.deleted_at ? 'Deleted' : 'Active'}</td>
            <td class="text-center px-4 py-2">
            <button class="text-red-500 hover:underline" onclick="toggleDeleteSkin(${s.id}, ${s.deleted_at ? 'false' : 'true'})">
            ${s.deleted_at ? 'Restore' : 'Delete'}
            </button>
            </td>
        `;
            tbody.appendChild(tr);
        });
    }

    async function addSkin(evt) {
        evt.preventDefault();
        const form = evt.target;
        const formData = new FormData(form);

        try {
            const resp = await axios.post('/api/skins', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            alert(resp.data.message);
            form.reset();
            loadSkins();
        } catch (error) {
            console.error('Error uploading skin:', error);
        }
    }

    async function toggleDeleteSkin(id, deleteFlag) {
        const action = deleteFlag ? 'delete' : 'restore';
        const resp = await axios.post(`/api/skins/${id}/${action}`);
        alert(resp.data.message);
        loadSkins();
    }
</script>


