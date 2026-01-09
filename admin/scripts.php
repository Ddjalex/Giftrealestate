<?php
// PHP version of scripts.js
?>
<script>
let currentTab = 'properties';
let data = { properties: [], gallery: [], news: [], inquiries: [], about: [], blog: [] };

function switchTab(tab) {
    currentTab = tab;
    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
    const content = document.getElementById(`content-${tab}`);
    if (content) content.classList.remove('hidden');
    
    document.querySelectorAll('#admin-nav button').forEach(b => b.classList.remove('bg-yellow-600', 'text-white'));
    const navBtn = document.getElementById(`nav-${tab}`);
    if (navBtn) navBtn.classList.add('bg-yellow-600', 'text-white');
    
    document.getElementById('current-tab-title').innerText = `Manage ${tab.charAt(0).toUpperCase() + tab.slice(1)}`;
    
    const addBtn = document.getElementById('add-btn');
    if (addBtn) {
        addBtn.style.display = (tab === 'inquiries' || tab === 'settings' || tab === 'about') ? 'none' : 'block';
    }
    
    fetchData();
}

async function fetchData() {
    if (currentTab === 'settings' || currentTab === 'about') {
        const response = await fetch('/api/about.php'); // Changed from settings.php to about.php
        const settings = await response.json();
        const formId = currentTab === 'settings' ? 'settings-form' : 'about-form';
        const form = document.getElementById(formId);
        if (form) {
            // Special handling for About tab
            if (currentTab === 'about') {
                const aboutTitle = document.getElementById('about_title_input');
                const aboutContent = document.getElementById('about_content_input');
                if (aboutTitle) aboutTitle.value = settings.title || '';
                if (aboutContent) aboutContent.value = settings.content || '';
                
                const images = [
                    { key: 'image_url', hidden: 'about_history_image_input', preview: 'about_history_image_preview' },
                    { key: 'vision_image', hidden: 'about_vision_image_input', preview: 'about_vision_image_preview' },
                    { key: 'ceo_image', hidden: 'about_ceo_image_input', preview: 'about_ceo_image_preview' }
                ];

                images.forEach(img => {
                    const value = settings[img.key];
                    if (value) {
                        const hiddenInput = document.getElementById(img.hidden);
                        if (hiddenInput) hiddenInput.value = value;
                        const preview = document.getElementById(img.preview);
                        if (preview) {
                            preview.src = value.startsWith('http') ? value : '/uploads/' + value;
                            preview.classList.remove('hidden');
                        }
                    } else {
                        // Clear previews if no value
                        const preview = document.getElementById(img.preview);
                        if (preview) {
                            preview.src = '';
                            preview.classList.add('hidden');
                        }
                    }
                });
                return;
            }
            // Original logic for settings
            for (const key in settings) {
                if (form.elements[key]) {
                    form.elements[key].value = settings[key];
                    if (key.includes('image') && settings[key]) {
                        const preview = document.getElementById(`${key}_preview`);
                        if (preview) {
                            preview.src = settings[key].startsWith('http') ? settings[key] : `/uploads/${settings[key]}`;
                            preview.classList.remove('hidden');
                        }
                    }
                    if (key === 'header_video' && settings[key]) {
                        const previewDiv = document.getElementById('header_video_preview');
                        const video = document.getElementById('admin-header-video');
                        if (previewDiv && video) {
                            video.src = settings[key].startsWith('http') ? settings[key] : `/uploads/${settings[key]}`;
                            previewDiv.classList.remove('hidden');
                        }
                    }
                }
            }
        }
        return;
    }
    const response = await fetch(`/api/${currentTab}.php`);
    data[currentTab] = await response.json();
    renderTable();
}

async function saveAbout() {
    const payload = {
        title: document.getElementById('about_title_input').value,
        content: document.getElementById('about_content_input').value,
        image_url: document.getElementById('about_history_image_input').value,
        vision_image: document.getElementById('about_vision_image_input').value,
        ceo_image: document.getElementById('about_ceo_image_input').value
    };
    
    // Process files
    const fileMappings = [
        { input: 'about_history_image_file', key: 'image_url' },
        { input: 'about_vision_image_file', key: 'vision_image' },
        { input: 'about_ceo_image_file', key: 'ceo_image' }
    ];

    for (const mapping of fileMappings) {
        const fileInput = document.querySelector(`input[name="${mapping.input}"]`);
        if (fileInput && fileInput.files.length > 0) {
            const uploadFormData = new FormData();
            uploadFormData.append('images[]', fileInput.files[0]);
            const uploadRes = await fetch('/api/upload.php', { method: 'POST', body: uploadFormData });
            const uploadData = await uploadRes.json();
            if (uploadData.urls && uploadData.urls.length > 0) {
                payload[mapping.key] = uploadData.urls[0];
            }
        }
    }
    
    const response = await fetch('/api/about.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });

    if (response.ok) {
        alert('About content saved successfully!');
        fetchData();
    }
}

function previewAboutImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
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
    } else if (currentTab === 'news' || currentTab === 'blog') {
        tbody.innerHTML = data[currentTab].map(n => `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(n.created_at).toLocaleDateString()}</td>
                <td class="px-6 py-4 whitespace-nowrap font-medium">${n.title}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <button onclick="editItem(${n.id})" class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                    <button onclick="deleteItem(${n.id})" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
            </tr>
        `).join('');
    } else if (currentTab === 'inquiries') {
        tbody.innerHTML = data.inquiries.map(i => `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(i.created_at).toLocaleDateString()}</td>
                <td class="px-6 py-4 whitespace-nowrap font-medium">${i.name}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">${i.email}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <button onclick="deleteItem(${i.id})" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
            </tr>
        `).join('');
    }
}

async function saveSettings() {
    const form = document.getElementById('settings-form');
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    
    // Process video file
    const videoFile = document.getElementById('header-video-file');
    if (videoFile && videoFile.files.length > 0) {
        const progressContainer = document.getElementById('upload-progress-container');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressText = document.getElementById('upload-progress-text');
        
        if (progressContainer) progressContainer.classList.remove('hidden');
        
        const uploadFormData = new FormData();
        uploadFormData.append('images[]', videoFile.files[0]);
        
        const xhr = new XMLHttpRequest();
        const uploadPromise = new Promise((resolve, reject) => {
            xhr.upload.addEventListener('progress', (e) => {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    if (progressBar) progressBar.style.width = percent + '%';
                    if (progressText) progressText.innerText = percent + '%';
                }
            });
            
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        resolve(JSON.parse(xhr.responseText));
                    } else {
                        reject(new Error('Upload failed'));
                    }
                }
            };
            
            xhr.open('POST', '/api/upload.php', true);
            xhr.send(uploadFormData);
        });

        try {
            const uploadData = await uploadPromise;
            if (uploadData.urls && uploadData.urls.length > 0) {
                payload.header_video = uploadData.urls[0];
            }
        } catch (e) {
            console.error('Video upload failed', e);
            alert('Video upload failed');
            if (progressContainer) progressContainer.classList.add('hidden');
            return;
        } finally {
            if (progressContainer) setTimeout(() => progressContainer.classList.add('hidden'), 2000);
        }
    }
    
    const response = await fetch('/api/settings.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });

    if (response.ok) {
        alert('Settings saved successfully!');
        location.reload(); // Refresh to show new state
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
        const item = data.properties.find(i => i.id == id);
        if (!item) return;
        
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
        document.getElementById('prop-featured').checked = item.featured == 1;
        
        const preview = document.getElementById('prop-images-preview');
        if (preview && item.gallery_images) {
            let images = [];
            try {
                images = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : item.gallery_images;
            } catch (e) { images = []; }
            
            preview.innerHTML = images.map(img => `
                <div class="relative group">
                    <img src="${img.startsWith('http') ? img : '/uploads/' + img}" class="h-20 w-20 object-cover rounded border">
                </div>
            `).join('');
        }
    } else if (currentTab === 'gallery') {
        document.getElementById('gallery-id').value = item.id;
        document.getElementById('gallery-title').value = item.title;
        document.getElementById('gallery-url').value = item.image_url;
        document.getElementById('gallery-category').value = item.category || '';
        const preview = document.getElementById('gallery-image-preview');
        if (preview && item.image_url) {
            preview.innerHTML = `<img src="${item.image_url.startsWith('http') ? item.image_url : '/uploads/'+item.image_url}" class="h-20 w-20 object-cover rounded border">`;
        }
    } else if (currentTab === 'news' || currentTab === 'blog') {
        const prefix = currentTab === 'news' ? 'news' : 'blog';
        document.getElementById(`${prefix}-id`).value = item.id;
        document.getElementById(`${prefix}-title`).value = item.title;
        document.getElementById(`${prefix}-content`).value = item.content || '';
        document.getElementById(`${prefix}-url`).value = item.image_url || '';
        const preview = document.getElementById(`${prefix}-image-preview`);
        if (preview && item.image_url) {
            preview.innerHTML = `<img src="${item.image_url.startsWith('http') ? item.image_url : '/uploads/'+item.image_url}" class="h-20 w-20 object-cover rounded border">`;
        }
    }
}

function showAddModal() {
    document.querySelectorAll('.modal-form').forEach(f => f.classList.add('hidden'));
    const formId = `add-${currentTab === 'properties' ? 'property' : currentTab}-form`;
    const form = document.getElementById(formId);
    if (form) form.classList.remove('hidden');
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
function setupImagePreview(inputId, previewId, hiddenId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.addEventListener('change', function() {
        const preview = document.getElementById(previewId);
        if (!preview) return;
        preview.innerHTML = '';
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-20 w-20 object-cover rounded border';
                preview.appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupImagePreview('gallery-image-input', 'gallery-image-preview', 'gallery-url');
    setupImagePreview('news-image-input', 'news-image-preview', 'news-url');
    setupImagePreview('blog-image-input', 'blog-image-preview', 'blog-url');
    
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
});

fetchData();
</script>
