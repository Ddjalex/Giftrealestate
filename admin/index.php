<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gift Real Estate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --brand-green: #004d40;
            --brand-yellow: #fdd835;
        }
        .bg-brand-green { background-color: var(--brand-green); }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-yellow { background-color: var(--brand-yellow); }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-brand-green text-white">
        <div class="p-6 flex items-center bg-white">
            <img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-12 object-contain">
        </div>
        <div class="p-6 text-xl font-bold text-brand-yellow border-t border-white/10">Admin Dashboard</div>
        <nav class="mt-6" id="admin-nav">
            <button onclick="switchTab('properties')" id="nav-properties" class="w-full text-left py-2.5 px-4 bg-yellow-600 text-white">Properties</button>
            <button onclick="switchTab('gallery')" id="nav-gallery" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">Gallery</button>
            <button onclick="switchTab('news')" id="nav-news" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">News</button>
            <button onclick="switchTab('inquiries')" id="nav-inquiries" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">Inquiries</button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-40">
            <h2 id="current-tab-title" class="text-xl font-bold text-brand-green">Manage Properties</h2>
            <button id="add-btn" onclick="showAddModal()" class="bg-brand-green text-brand-yellow font-bold px-4 py-2 rounded">+ Add New</button>
        </header>

        <div id="content-properties" class="tab-content p-8">
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-property-list" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <div id="content-gallery" class="tab-content p-8 hidden">
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-gallery-list" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <div id="content-news" class="tab-content p-8 hidden">
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-news-list" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Simple Add Modal (Hidden by default) -->
    <div id="add-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
            <h3 id="modal-title" class="text-xl font-bold mb-4">Add New Item</h3>
            
            <form id="add-property-form" class="modal-form space-y-4">
                <input type="hidden" name="id" id="prop-id">
                <input type="text" name="title" id="prop-title" placeholder="Property Title" class="w-full p-2 border rounded" required>
                <textarea name="description" id="prop-description" placeholder="Description" class="w-full p-2 border rounded"></textarea>
                <div class="grid grid-cols-2 gap-4">
                    <select name="property_type" id="prop-type" class="p-2 border rounded">
                        <option value="Residential Apartments">Residential Apartments</option>
                        <option value="Commercial Properties">Commercial Properties</option>
                        <option value="Luxury Villas">Luxury Villas</option>
                        <option value="Office Spaces">Office Spaces</option>
                        <option value="Retail Shops">Retail Shops</option>
                        <option value="Land & Plots">Land & Plots</option>
                    </select>
                    <select name="status" id="prop-status" class="p-2 border rounded">
                        <option value="For Sale">For Sale</option>
                        <option value="For Rent">For Rent</option>
                        <option value="Reduced">Reduced</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="price" id="prop-price" placeholder="Price (ETB)" class="p-2 border rounded">
                    <input type="text" name="location" id="prop-location" placeholder="Location" class="p-2 border rounded">
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <input type="number" name="bedrooms" id="prop-beds" placeholder="Beds" class="p-2 border rounded">
                    <input type="number" name="bathrooms" id="prop-baths" placeholder="Baths" class="p-2 border rounded">
                    <input type="number" name="area_sqft" id="prop-area" placeholder="Sq Ft" class="p-2 border rounded">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="featured" id="prop-featured" class="mr-2">
                    <label for="prop-featured">Featured Property</label>
                </div>
            </form>

            <form id="add-gallery-form" class="modal-form space-y-4 hidden">
                <input type="hidden" name="id" id="gallery-id">
                <input type="text" name="title" id="gallery-title" placeholder="Image Title" class="w-full p-2 border rounded" required>
                <input type="text" name="image_url" id="gallery-url" placeholder="Image URL" class="w-full p-2 border rounded" required>
                <input type="text" name="category" id="gallery-category" placeholder="Category" class="w-full p-2 border rounded">
            </form>

            <form id="add-news-form" class="modal-form space-y-4 hidden">
                <input type="hidden" name="id" id="news-id">
                <input type="text" name="title" id="news-title" placeholder="News Title" class="w-full p-2 border rounded" required>
                <textarea name="content" id="news-content" placeholder="News Content" class="w-full p-2 border rounded h-32"></textarea>
                <input type="text" name="image_url" id="news-url" placeholder="Cover Image URL" class="w-full p-2 border rounded">
            </form>

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="hideAddModal()" class="px-4 py-2 text-gray-500">Cancel</button>
                <button type="button" onclick="handleSave()" class="bg-brand-green text-brand-yellow px-4 py-2 rounded">Save Changes</button>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 'properties';
        let data = { properties: [], gallery: [], news: [] };

        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
            document.getElementById(`content-${tab}`).classList.remove('hidden');
            
            document.querySelectorAll('#admin-nav button').forEach(b => b.classList.remove('bg-yellow-600', 'text-white'));
            document.getElementById(`nav-${tab}`).classList.add('bg-yellow-600', 'text-white');
            
            document.getElementById('current-tab-title').innerText = `Manage ${tab.charAt(0).toUpperCase() + tab.slice(1)}`;
            fetchData();
        }

        async function fetchData() {
            const response = await fetch(`/api/${currentTab}`);
            data[currentTab] = await response.json();
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById(`admin-${currentTab}-list`);
            if (!tbody) return;
            
            if (currentTab === 'properties') {
                tbody.innerHTML = data.properties.map(p => `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">${p.title}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${p.location}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${new Intl.NumberFormat().format(p.price)} ETB</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">${p.status}</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button onclick="editItem(${p.id})" class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                            <button onclick="deleteItem(${p.id})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                `).join('');
            } else if (currentTab === 'gallery') {
                tbody.innerHTML = data.gallery.map(g => `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><img src="${g.image_url}" class="h-10 w-10 object-cover rounded"></td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">${g.title}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${g.category}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button onclick="editItem(${g.id})" class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                            <button onclick="deleteItem(${g.id})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                `).join('');
            } else if (currentTab === 'news') {
                tbody.innerHTML = data.news.map(n => `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(n.created_at).toLocaleDateString()}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">${n.title}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button onclick="editItem(${n.id})" class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                            <button onclick="deleteItem(${n.id})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                `).join('');
            }
        }

        async function deleteItem(id) {
            if (confirm(`Are you sure you want to delete this ${currentTab} item?`)) {
                const response = await fetch(`/api/${currentTab}?id=${id}`, { method: 'DELETE' });
                if (response.ok) fetchData();
            }
        }

        function editItem(id) {
            const item = data[currentTab].find(i => i.id == id);
            if (!item) return;
            
            showAddModal();
            document.getElementById('modal-title').innerText = `Edit ${currentTab.charAt(0).toUpperCase() + currentTab.slice(1)}`;
            
            if (currentTab === 'properties') {
                document.getElementById('prop-id').value = item.id;
                document.getElementById('prop-title').value = item.title;
                document.getElementById('prop-description').value = item.description || '';
                document.getElementById('prop-type').value = item.property_type;
                document.getElementById('prop-status').value = item.status;
                document.getElementById('prop-price').value = item.price;
                document.getElementById('prop-location').value = item.location;
                document.getElementById('prop-beds').value = item.bedrooms;
                document.getElementById('prop-baths').value = item.bathrooms;
                document.getElementById('prop-area').value = item.area_sqft;
                document.getElementById('prop-featured').checked = item.featured;
            } else if (currentTab === 'gallery') {
                document.getElementById('gallery-id').value = item.id;
                document.getElementById('gallery-title').value = item.title;
                document.getElementById('gallery-url').value = item.image_url;
                document.getElementById('gallery-category').value = item.category || '';
            } else if (currentTab === 'news') {
                document.getElementById('news-id').value = item.id;
                document.getElementById('news-title').value = item.title;
                document.getElementById('news-content').value = item.content || '';
                document.getElementById('news-url').value = item.image_url || '';
            }
        }

        function showAddModal() {
            document.querySelectorAll('.modal-form').forEach(f => f.classList.add('hidden'));
            document.getElementById(`add-${currentTab === 'properties' ? 'property' : currentTab}-form`).classList.remove('hidden');
            document.getElementById('modal-title').innerText = `Add New ${currentTab.charAt(0).toUpperCase() + currentTab.slice(1)}`;
            document.getElementById('add-modal').classList.remove('hidden');
        }

        function hideAddModal() {
            document.getElementById('add-modal').classList.add('hidden');
            document.querySelectorAll('.modal-form').forEach(f => {
                f.reset();
                const idField = f.querySelector('input[type="hidden"]');
                if (idField) idField.value = '';
            });
        }

        async function handleSave() {
            const formId = `add-${currentTab === 'properties' ? 'property' : currentTab}-form`;
            const form = document.getElementById(formId);
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());
            
            if (currentTab === 'properties') {
                payload.featured = document.getElementById('prop-featured').checked;
            }

            const response = await fetch(`/api/${currentTab}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                hideAddModal();
                fetchData();
            }
        }

        fetchData();
    </script>
</body>
</html>
