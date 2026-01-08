<?php
// PHP version of scripts.js
?>
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
    if (currentTab === 'settings') {
        const response = await fetch('/api/settings.php');
        const settings = await response.json();
        const form = document.getElementById('settings-form');
        for (const key in settings) {
            if (form.elements[key]) {
                form.elements[key].value = settings[key];
            }
        }
        return;
    }
    const response = await fetch(`/api/${currentTab}.php`);
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

async function saveSettings() {
    const form = document.getElementById('settings-form');
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    
    const response = await fetch('/api/settings.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });

    if (response.ok) {
        alert('Settings saved successfully!');
    }
}

async function changePassword() {
    const newPass = document.getElementById('new-password').value;
    const confirmPass = document.getElementById('confirm-password').value;
    if (!newPass) {
        alert('Please enter a new password');
        return;
    }
    if (newPass !== confirmPass) {
        alert('Passwords do not match!');
        return;
    }
    
    const response = await fetch('/api/change_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ new_password: newPass })
    });

    if (response.ok) {
        alert('Password updated successfully!');
        document.getElementById('password-form').reset();
    } else {
        alert('Failed to update password.');
    }
}

async function deleteItem(id) {
    if (confirm(`Are you sure you want to delete this ${currentTab} item?`)) {
        const response = await fetch(`/api/${currentTab}.php?id=${id}`, { method: 'DELETE' });
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
    const preview = document.getElementById('prop-images-preview');
    if (preview) preview.innerHTML = '';
}

// Image preview logic
document.getElementById('prop-images-input')?.addEventListener('change', function(e) {
    const preview = document.getElementById('prop-images-preview');
    if (!preview) return;
    preview.innerHTML = '';
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'h-20 w-20 object-cover rounded border';
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
});

fetchData();
