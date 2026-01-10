<?php
// PHP version of handleSave.js
?>
<script>
async function handleSave() {
    const formId = `add-${currentTab === 'properties' ? 'property' : currentTab}-form`;
    const form = document.getElementById(formId);
    if (!form) {
        console.error('Form not found:', formId);
        return;
    }
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    
    // Handle image uploads
    if (currentTab === 'about') {
        // Handled by saveAbout function in scripts.php
        return;
    } else if (currentTab !== 'properties' && currentTab !== 'inquiries' && currentTab !== 'settings') {
        const inputId = `${currentTab === 'properties' ? 'prop' : currentTab}-image-input`;
        const imageInput = document.getElementById(inputId);
        if (imageInput && imageInput.files.length > 0) {
            const imgFormData = new FormData();
            imgFormData.append('images[]', imageInput.files[0]);
            const uploadRes = await fetch('/api/upload.php', { method: 'POST', body: imgFormData });
            const uploadData = await uploadRes.json();
            if (uploadData.urls && uploadData.urls.length > 0) {
                payload.image_url = uploadData.urls[0];
            }
        }
    }

    if (currentTab === 'properties') {
        payload.featured = document.getElementById('prop-featured').checked;
        
        // Handle multiple image uploads
        const imageInput = document.getElementById('prop-images-input');
        if (imageInput && imageInput.files.length > 0) {
            const imgFormData = new FormData();
            for (let i = 0; i < imageInput.files.length; i++) {
                imgFormData.append('images[]', imageInput.files[i]);
            }
            try {
                const uploadRes = await fetch('/api/upload.php', {
                    method: 'POST',
                    body: imgFormData
                });
                const uploadData = await uploadRes.json();
                if (uploadData && uploadData.urls && uploadData.urls.length > 0) {
                    let newImages = uploadData.urls;
                    
                    if (payload.id) {
                        // If editing, we append new images to existing ones instead of replacing
                        const item = data.properties.find(i => i.id == payload.id);
                        if (item) {
                            let existingImages = [];
                            try {
                                existingImages = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : (item.gallery_images || []);
                            } catch (e) { existingImages = []; }
                            
                            if (!Array.isArray(existingImages)) existingImages = [];
                            newImages = [...existingImages, ...uploadData.urls];
                        }
                    }
                    
                    payload.main_image = newImages[0];
                    payload.gallery_images = newImages;
                }
            } catch (e) {
                console.error('Upload failed', e);
            }
        } else if (payload.id) {
            // If editing and no new images, keep existing
            const item = data.properties.find(i => i.id == payload.id);
            if (item) {
                payload.main_image = item.main_image;
                payload.gallery_images = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : item.gallery_images;
            }
        }
    }

    try {
        const response = await fetch(`/api/${currentTab}.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            alert('Saved successfully!');
            hideAddModal();
            fetchData();
        } else {
            const err = await response.json();
            alert('Error: ' + (err.error || 'Failed to save'));
        }
    } catch (e) {
        console.error('Save failed', e);
        alert('An error occurred while saving.');
    }
}
</script>
