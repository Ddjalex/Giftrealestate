<?php
// PHP version of scripts.js
?>
<script>
let currentTab = 'properties';
let data = { properties: [], gallery: [], news: [], inquiries: [], about: [], blog: [] };
let selectedFiles = [];

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
        const endpoint = currentTab === 'settings' ? '/api/settings.php' : '/api/about.php';
        const response = await fetch(endpoint);
        const settings = await response.json();
        const formId = currentTab === 'settings' ? 'settings-form' : 'about-form';
        const form = document.getElementById(formId);
        if (form) {
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
                        const preview = document.getElementById(img.preview);
                        if (preview) {
                            preview.src = '';
                            preview.classList.add('hidden');
                        }
                    }
                });
                return;
            }
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
                        const hiddenInput = document.getElementById('header_video_input');
                        if (previewDiv && video) {
                            video.src = settings[key].startsWith('http') ? settings[key] : `/uploads/${settings[key]}`;
                            previewDiv.classList.remove('hidden');
                        }
                        if (hiddenInput) {
                            hiddenInput.value = settings[key];
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

function setupHeaderVideoAutoUpload() {
    const videoFile = document.getElementById('header-video-file');
    if (!videoFile) return;

    videoFile.addEventListener('change', async function() {
        if (this.files.length === 0) return;

        const progressContainer = document.getElementById('upload-progress-container');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressText = document.getElementById('upload-progress-text');
        const hiddenInput = document.getElementById('header_video_input');
        const previewDiv = document.getElementById('header_video_preview');
        const video = document.getElementById('admin-header-video');
        
        if (progressContainer) progressContainer.classList.remove('hidden');
        if (previewDiv) previewDiv.classList.add('hidden');
        
        const uploadFormData = new FormData();
        uploadFormData.append('images[]', this.files[0]);
        
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
                        try {
                            const response = JSON.parse(xhr.responseText);
                            resolve(response);
                        } catch (e) {
                            reject(new Error('Invalid JSON response'));
                        }
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
                const videoUrl = uploadData.urls[0];
                if (hiddenInput) hiddenInput.value = videoUrl;
                if (video) {
                    video.src = '/uploads/' + videoUrl;
                    if (previewDiv) previewDiv.classList.remove('hidden');
                }
            }
        } catch (e) {
            alert('Video upload failed: ' + e.message);
        } finally {
            setTimeout(() => {
                if (progressContainer) progressContainer.classList.add('hidden');
            }, 1000);
        }
    });
}

async function saveSettings() {
    const form = document.getElementById('settings-form');
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    
    const videoInput = document.getElementById('header_video_input');
    if (videoInput && videoInput.value) {
        payload.header_video = videoInput.value;
    }
    
    const response = await fetch('/api/settings.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });

    if (response.ok) {
        alert('Settings saved successfully!');
        fetchData();
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

function refreshPropertyPreviews() {
    const preview = document.getElementById('prop-images-preview');
    if (!preview) return;
    preview.innerHTML = '';
    
    const idField = document.getElementById('prop-id');
    const propertyId = idField ? idField.value : null;
    
    // Show main image if it exists and is not in gallery
    const item = propertyId ? data.properties.find(i => i.id == propertyId) : null;
    if (item && item.main_image) {
        const div = document.createElement('div');
        div.className = 'relative group h-20 w-20';
        div.innerHTML = `
            <img src="${item.main_image.startsWith('http') ? item.main_image : '/uploads/' + item.main_image}" class="h-full w-full object-cover rounded border border-brand-green">
            <span class="absolute -top-2 -left-2 bg-brand-green text-white rounded px-1 text-[10px]">Main</span>
        `;
        preview.appendChild(div);
    }

    if (item) {
        let images = [];
        try {
            images = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : (item.gallery_images || []);
        } catch (e) { images = []; }
        if (Array.isArray(images)) {
            images.forEach((img, index) => {
                // Skip if it's the main image (already shown)
                if (img === item.main_image) return;
                
                const div = document.createElement('div');
                div.className = 'relative group h-20 w-20';
                div.innerHTML = `
                    <img src="${img.startsWith('http') ? img : '/uploads/' + img}" class="h-full w-full object-cover rounded border">
                    <button type="button" onclick="removeExistingImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>
                `;
                preview.appendChild(div);
            });
        }
    }
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group h-20 w-20';
            div.innerHTML = `
                <img src="${e.target.result}" class="h-full w-full object-cover rounded border">
                <button type="button" onclick="removeSelectedFile(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>
            `;
            preview.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
}

function removeExistingImage(index) {
    const idField = document.getElementById('prop-id');
    const propertyId = idField ? idField.value : null;
    if (!propertyId) return;

    const item = data.properties.find(i => i.id == propertyId);
    if (!item) return;

    let images = [];
    try {
        images = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : (item.gallery_images || []);
    } catch (e) { images = []; }
    
    if (Array.isArray(images)) {
        images.splice(index, 1);
        item.gallery_images = JSON.stringify(images);
        if (images.length > 0) item.main_image = images[0];
        else item.main_image = null;
        refreshPropertyPreviews();
    }
}

function removeSelectedFile(index) {
    selectedFiles.splice(index, 1);
    refreshPropertyPreviews();
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
        document.getElementById('prop-featured').checked = item.featured == 1;
        
        selectedFiles = [];
        const preview = document.getElementById('prop-images-preview');
        if (preview) {
            preview.innerHTML = '';
            
            // Show main image first
            if (item.main_image) {
                const div = document.createElement('div');
                div.className = 'relative group h-20 w-20';
                div.innerHTML = `
                    <img src="${item.main_image.startsWith('http') ? item.main_image : '/uploads/' + item.main_image}" class="h-full w-full object-cover rounded border border-brand-green">
                    <span class="absolute -top-2 -left-2 bg-brand-green text-white rounded px-1 text-[10px]">Main</span>
                `;
                preview.appendChild(div);
            }

            // Show gallery images
            let gallery = [];
            try {
                gallery = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : (item.gallery_images || []);
            } catch (e) { gallery = []; }
            
            if (Array.isArray(gallery)) {
                gallery.forEach((img, index) => {
                    if (img === item.main_image) return;
                    const div = document.createElement('div');
                    div.className = 'relative group h-20 w-20';
                    div.innerHTML = `
                        <img src="${img.startsWith('http') ? img : '/uploads/' + img}" class="h-full w-full object-cover rounded border">
                        <button type="button" onclick="removeExistingImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>
                    `;
                    preview.appendChild(div);
                });
            }
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
    selectedFiles = [];
    document.querySelectorAll('.modal-form').forEach(f => {
        f.reset();
        const idField = f.querySelector('input[type="hidden"]');
        if (idField) idField.value = '';
    });
    const preview = document.getElementById('prop-images-preview');
    if (preview) preview.innerHTML = '';
}

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
    setupHeaderVideoAutoUpload();
    
    document.getElementById('prop-images-input')?.addEventListener('change', function(e) {
        Array.from(this.files).forEach(file => {
            selectedFiles.push(file);
        });
        this.value = '';
        refreshPropertyPreviews();
    });
});

fetchData();
</script>