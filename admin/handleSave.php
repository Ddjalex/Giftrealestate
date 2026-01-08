<?php
// PHP version of handleSave.js
// This file can be included or the logic moved to a script tag in index.php
?>
async function handleSave() {
    const formId = `add-${currentTab === 'properties' ? 'property' : currentTab}-form`;
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    
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
