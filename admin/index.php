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
            <button onclick="switchTab('blog')" id="nav-blog" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">Blog</button>
            <button onclick="switchTab('about')" id="nav-about" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">About Us</button>
            <button onclick="switchTab('inquiries')" id="nav-inquiries" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">Inquiries</button>
            <button onclick="switchTab('settings')" id="nav-settings" class="w-full text-left py-2.5 px-4 hover:bg-yellow-600 transition">Settings</button>
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
                    <tbody id="admin-properties-list" class="divide-y divide-gray-200"></tbody>
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

        <div id="content-blog" class="tab-content p-8 hidden">
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-blog-list" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <div id="content-about" class="tab-content p-8 hidden">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-brand-green mb-8">About Page Content</h3>
                <form id="about-form" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">About Us Title</label>
                        <input type="text" name="title" id="about_title_input" class="w-full p-3 border rounded-lg" placeholder="Gift Real Estate PLC">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">About Us Content</label>
                        <textarea name="content" id="about_content_input" class="w-full p-3 border rounded-lg h-32" placeholder="Describe your company..."></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">History Section Image</label>
                        <input type="file" name="about_history_image_file" class="w-full p-3 border rounded-lg" accept="image/*" onchange="previewAboutImage(this, 'about_history_image_preview')">
                        <input type="hidden" id="about_history_image_input">
                        <img id="about_history_image_preview" class="mt-2 h-32 hidden">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Vision Section Image</label>
                        <input type="file" name="about_vision_image_file" class="w-full p-3 border rounded-lg" accept="image/*" onchange="previewAboutImage(this, 'about_vision_image_preview')">
                        <input type="hidden" id="about_vision_image_input">
                        <img id="about_vision_image_preview" class="mt-2 h-32 hidden">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">CEO/Founder Image</label>
                        <input type="file" name="about_ceo_image_file" class="w-full p-3 border rounded-lg" accept="image/*" onchange="previewAboutImage(this, 'about_ceo_image_preview')">
                        <input type="hidden" id="about_ceo_image_input">
                        <img id="about_ceo_image_preview" class="mt-2 h-32 hidden">
                    </div>
                    <button type="button" onclick="saveAbout()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Save About Content</button>
                </form>
            </div>
        </div>

        <div id="content-inquiries" class="tab-content p-8 hidden">
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-inquiries-list" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <div id="content-settings" class="tab-content p-8 hidden">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-brand-green mb-8">System Settings</h3>
                <form id="settings-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Office Address</label>
                            <input type="text" name="address" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Contact Phone</label>
                            <input type="text" name="phone" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Contact Email</label>
                            <input type="email" name="email" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Facebook URL</label>
                            <input type="text" name="facebook" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Telegram URL</label>
                            <input type="text" name="telegram" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Instagram URL</label>
                            <input type="text" name="instagram" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">LinkedIn URL</label>
                            <input type="text" name="linkedin" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Header Video (MP4)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                <input type="file" id="header-video-file" class="hidden" accept="video/mp4,video/webm">
                                <button type="button" onclick="document.getElementById('header-video-file').click()" class="bg-gray-100 px-4 py-2 rounded border hover:bg-gray-200">Choose File</button>
                                <div id="header-video-name" class="mt-2 text-xs text-gray-500"></div>
                                
                                <div id="upload-progress-container" class="mt-4 hidden">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div id="upload-progress-bar" class="bg-brand-green h-2.5 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <p id="upload-progress-text" class="text-xs mt-1">0%</p>
                                </div>
                                
                                <input type="hidden" name="header_video" id="header_video_input">
                                <div id="header_video_preview" class="mt-4 hidden text-center">
                                    <video id="admin-header-video" controls class="mx-auto max-h-40 rounded"></video>
                                </div>
                            </div>
                            <script>
                            document.getElementById('header-video-file')?.addEventListener('change', function() {
                                const nameDiv = document.getElementById('header-video-name');
                                if (nameDiv && this.files.length > 0) {
                                    nameDiv.innerText = this.files[0].name;
                                }
                            });
                            </script>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Google Map Iframe Source (URL only)</label>
                        <textarea name="map_iframe" class="w-full p-3 border rounded-lg h-24" placeholder="Paste the src URL from the Google Maps embed code"></textarea>
                    </div>
                    <button type="button" onclick="saveSettings()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Save Settings</button>
                </form>

                <div class="mt-12 pt-8 border-t">
                    <h3 class="text-2xl font-bold text-brand-green mb-8">Security</h3>
                    <form id="password-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">New Password</label>
                                <input type="password" id="new-password" class="w-full p-3 border rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                                <input type="password" id="confirm-password" class="w-full p-3 border rounded-lg" required>
                            </div>
                        </div>
                        <button type="button" onclick="changePassword()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Update Password</button>
                    </form>
                </div>
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
                <div>
                    <label class="block text-sm font-bold mb-2">Property Images</label>
                    <div class="flex gap-2 mb-2">
                        <input type="file" id="prop-images-input" multiple class="flex-1 p-2 border rounded" accept="image/*">
                        <button type="button" onclick="document.getElementById('prop-images-input').click()" class="bg-gray-200 px-4 py-2 rounded font-bold text-sm hover:bg-gray-300">Add More</button>
                    </div>
                    <div id="prop-images-preview" class="grid grid-cols-4 gap-2 mt-2"></div>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="featured" id="prop-featured" class="mr-2">
                    <label for="prop-featured">Featured Property</label>
                </div>
            </form>

            <form id="add-gallery-form" class="modal-form space-y-4 hidden">
                <input type="hidden" name="id" id="gallery-id">
                <input type="text" name="title" id="gallery-title" placeholder="Image Title" class="w-full p-2 border rounded" required>
                <div>
                    <label class="block text-sm font-bold mb-2">Gallery Image</label>
                    <input type="file" id="gallery-image-input" class="w-full p-2 border rounded" accept="image/*">
                    <input type="hidden" name="image_url" id="gallery-url">
                    <div id="gallery-image-preview" class="mt-2 h-20"></div>
                </div>
                <input type="text" name="category" id="gallery-category" placeholder="Category" class="w-full p-2 border rounded">
            </form>

            <form id="add-news-form" class="modal-form space-y-4 hidden">
                <input type="hidden" name="id" id="news-id">
                <input type="text" name="title" id="news-title" placeholder="News Title" class="w-full p-2 border rounded" required>
                <textarea name="content" id="news-content" placeholder="News Content" class="w-full p-2 border rounded h-32"></textarea>
                <div>
                    <label class="block text-sm font-bold mb-2">Cover Image</label>
                    <input type="file" id="news-image-input" class="w-full p-2 border rounded" accept="image/*">
                    <input type="hidden" name="image_url" id="news-url">
                    <div id="news-image-preview" class="mt-2 h-20"></div>
                </div>
            </form>

            <form id="add-blog-form" class="modal-form space-y-4 hidden">
                <input type="hidden" name="id" id="blog-id">
                <input type="text" name="title" id="blog-title" placeholder="Blog Title" class="w-full p-2 border rounded" required>
                <textarea name="content" id="blog-content" placeholder="Blog Content" class="w-full p-2 border rounded h-32"></textarea>
                <div>
                    <label class="block text-sm font-bold mb-2">Cover Image</label>
                    <input type="file" id="blog-image-input" class="w-full p-2 border rounded" accept="image/*">
                    <input type="hidden" name="image_url" id="blog-url">
                    <div id="blog-image-preview" class="mt-2 h-20"></div>
                </div>
            </form>

            <form id="add-inquiries-form" class="modal-form space-y-4 hidden">
                <p class="text-gray-600">Inquiries cannot be added manually.</p>
            </form>

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="hideAddModal()" class="px-4 py-2 text-gray-500">Cancel</button>
                <button type="button" onclick="handleSave()" class="bg-brand-green text-brand-yellow px-4 py-2 rounded">Save Changes</button>
            </div>
        </div>
    </div>

    <?php include 'scripts.php'; ?>
    <?php include 'handleSave.php'; ?>
</body>
</html>
