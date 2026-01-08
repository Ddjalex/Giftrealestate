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
    
    // Handle single image upload for non-properties
    if (currentTab !== 'properties' && currentTab !== 'inquiries' && currentTab !== 'settings' && currentTab !== 'about') {
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
                if (uploadData.urls) {
                    payload.main_image = uploadData.urls[0];
                    payload.gallery_images = uploadData.urls;
                }
            } catch (e) {
                console.error('Upload failed', e);
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
