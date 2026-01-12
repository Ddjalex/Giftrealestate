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
    const payload = {};
    
    // Explicitly handle all form fields including checkboxes
    for (let [key, value] of formData.entries()) {
        if (key.endsWith('[]')) {
            const cleanKey = key.slice(0, -2);
            if (!payload[cleanKey]) payload[cleanKey] = [];
            payload[cleanKey].push(value);
        } else {
            payload[key] = value;
        }
    }
    
    // Special handling for amenities checkbox array if not present in payload
    if (currentTab === 'properties' && !payload.amenities) {
        payload.amenities = [];
    }
    
    // Convert arrays to JSON strings for backend
    for (let key in payload) {
        if (Array.isArray(payload[key])) {
            payload[key] = JSON.stringify(payload[key]);
        }
    }
    
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
        payload.featured = document.getElementById('prop-featured').checked ? 1 : 0;
        payload.map_url = document.getElementById('prop-map-url').value;
        
        // Amenities are now handled by the multi-value logic above
        
        // Handle multiple image uploads
        const imageInput = document.getElementById('prop-images-input');
        
        // Get existing images from the data object
        const item = payload.id ? data.properties.find(i => i.id == payload.id) : null;
        let finalGallery = [];
        if (item) {
            try {
                finalGallery = typeof item.gallery_images === 'string' ? JSON.parse(item.gallery_images) : (item.gallery_images || []);
            } catch (e) { finalGallery = []; }
        } else if (payload.gallery_images) {
             // Handle case where gallery_images might already be in payload from some other logic
             try {
                finalGallery = typeof payload.gallery_images === 'string' ? JSON.parse(payload.gallery_images) : payload.gallery_images;
             } catch(e) { finalGallery = []; }
        }
        
        if (selectedFiles && selectedFiles.length > 0) {
            const imgFormData = new FormData();
            for (let i = 0; i < selectedFiles.length; i++) {
                imgFormData.append('images[]', selectedFiles[i]);
            }
            try {
                const uploadRes = await fetch('/api/upload.php', {
                    method: 'POST',
                    body: imgFormData
                });
                const uploadData = await uploadRes.json();
                if (uploadData && uploadData.urls && uploadData.urls.length > 0) {
                    finalGallery = [...finalGallery, ...uploadData.urls];
                }
            } catch (e) {
                console.error('Upload failed', e);
            }
        }
        
        if (finalGallery.length > 0) {
            // Respect the main_image if it was manually set (or unset) in the state
            if (item && item.hasOwnProperty('main_image')) {
                payload.main_image = item.main_image;
            } else {
                payload.main_image = finalGallery[0];
            }
            payload.gallery_images = JSON.stringify(finalGallery);
        } else {
            payload.main_image = null;
            payload.gallery_images = JSON.stringify([]);
        }
    }

    try {
        const response = await fetch(`/api/${currentTab}.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            showToast('Your changes have been successfully saved.');
            hideAddModal();
            fetchData();
        } else {
            const err = await response.json();
            showToast('We encountered an error: ' + (err.error || 'The item could not be saved. Please try again.'), 'error');
        }
    } catch (e) {
        console.error('Save failed', e);
        showToast('An unexpected error occurred while saving. Please check your connection and try again.', 'error');
    }
}
</script>
