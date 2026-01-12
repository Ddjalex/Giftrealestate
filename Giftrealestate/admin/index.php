<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /admin/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gift Real Estate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brand-green: #004d40;
            --brand-yellow: #fdd835;
        }
        .bg-brand-green { background-color: var(--brand-green); }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-yellow { background-color: var(--brand-yellow); }
        
        /* Custom Toast Styles */
        .toast-notification {
            position: fixed;
            bottom: 24px;
            right: 24px;
            padding: 16px 24px;
            border-radius: 12px;
            background: white;
            color: #1f2937;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 2000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 4px solid var(--brand-green);
        }
        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }
        .toast-error {
            border-left-color: #ef4444;
        }
    </style>
    <script>
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast-notification ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML = `
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle text-red-500' : 'fa-check-circle text-brand-green'}"></i>
                <span class="font-medium">${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 10);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
        const originalAlert = window.alert;
        window.alert = (msg) => {
            if (msg.includes('Are you sure')) {
                return originalAlert(msg);
            }
            showToast(msg, msg.toLowerCase().includes('error') ? 'error' : 'success');
        };
    </script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-64 bg-brand-green text-white transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto transition-transform duration-300 ease-in-out z-50 flex flex-col">
        <div class="p-6 flex items-center bg-white justify-between">
            <img src="/assets/logo.png" alt="Gift Real Estate Logo" class="h-12 object-contain">
            <button onclick="toggleSidebar()" class="lg:hidden text-brand-green p-2">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 text-xl font-bold text-brand-yellow border-t border-white/10">Admin Dashboard</div>
        <nav class="mt-6 flex-1 overflow-y-auto" id="admin-nav">
            <button onclick="switchTab('properties')" id="nav-properties" class="w-full text-left py-3 px-6 bg-yellow-600 text-white flex items-center gap-3">
                <i class="fas fa-home w-5"></i> Properties
            </button>
            <button onclick="switchTab('gallery')" id="nav-gallery" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-images w-5"></i> Gallery
            </button>
            <button onclick="switchTab('news')" id="nav-news" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-newspaper w-5"></i> News
            </button>
            <button onclick="switchTab('blog')" id="nav-blog" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-blog w-5"></i> Blog
            </button>
            <button onclick="switchTab('about')" id="nav-about" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-info-circle w-5"></i> About Us
            </button>
            <button onclick="switchTab('inquiries')" id="nav-inquiries" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-envelope w-5"></i> Inquiries
            </button>
            <button onclick="switchTab('settings')" id="nav-settings" class="w-full text-left py-3 px-6 hover:bg-yellow-600 transition flex items-center gap-3 text-white/80 hover:text-white">
                <i class="fas fa-cog w-5"></i> Settings
            </button>
        </nav>
        <div class="p-4 border-t border-white/10 lg:hidden">
            <a href='logout" class="flex items-center gap-3 text-red-400 font-bold px-2 py-2">
                <i class="fas fa-sign-out-alt w-5"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto w-full">
        <header class="bg-white shadow p-3 md:p-4 flex justify-between items-center sticky top-0 z-40">
            <div class="flex items-center gap-2 md:gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden text-brand-green p-1.5 md:p-2 hover:bg-gray-100 rounded-lg flex items-center justify-center border-2 border-brand-green">
                    <i class="fas fa-bars text-lg md:text-2xl"></i>
                </button>
                <h2 id="current-tab-title" class="text-base md:text-xl font-bold text-brand-green truncate max-w-[120px] xs:max-w-none">Manage Properties</h2>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                <button id="add-btn" onclick="showAddModal()" class="bg-brand-green text-brand-yellow font-bold px-2 py-1.5 md:px-4 md:py-2 rounded text-xs md:text-base whitespace-nowrap">+ Add New</button>
                <a href='logout" class="hidden md:block bg-red-600 text-white font-bold px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
            </div>
        </header>

        <div id="content-properties" class="tab-content p-2 md:p-8">
            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 md:px-6 py-2 md:py-3 text-left text-[10px] md:text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                            <th class="px-2 md:px-6 py-2 md:py-3 text-left text-[10px] md:text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Location</th>
                            <th class="px-2 md:px-6 py-2 md:py-3 text-left text-[10px] md:text-xs font-medium text-gray-500 uppercase tracking-wider hidden xs:table-cell">Price</th>
                            <th class="px-2 md:px-6 py-2 md:py-3 text-left text-[10px] md:text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Status</th>
                            <th class="px-2 md:px-6 py-2 md:py-3 text-right text-[10px] md:text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-properties-list" class="bg-white divide-y divide-gray-200 text-xs md:text-sm"></tbody>
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
                            <label class="block text-gray-700 font-bold mb-2">Contact Phone 1</label>
                            <input type="text" name="phone" class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Contact Phone 2</label>
                            <input type="text" name="phone2" class="w-full p-3 border rounded-lg">
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
                                    <video id="admin-header-video" controls autoplay muted loop class="mx-auto max-h-40 rounded"></video>
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
                        <textarea name="map_iframe_url" class="w-full p-3 border rounded-lg h-24" placeholder="Paste the src URL from the Google Maps embed code or a link with coordinates (e.g., @9.013,38.756)"></textarea>
                    </div>
                    <button type="button" onclick="saveSettings()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Save Settings</button>
                </form>

                <div class="mt-12 pt-8 border-t">
                    <h3 class="text-2xl font-bold text-brand-green mb-8">Security</h3>
                    <form id="email-form" class="mb-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Login Email</label>
                                <input type="email" id="admin-email" class="w-full p-3 border rounded-lg" value="<?php echo $_SESSION['admin_email']; ?>" required>
                            </div>
                        </div>
                        <button type="button" onclick="changeEmail()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Update Email</button>
                    </form>
                    <form id="password-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">New Password</label>
                                <input type="password" id="new-password" name="new-password" autocomplete="new-password" class="w-full p-3 border rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password" autocomplete="new-password" class="w-full p-3 border rounded-lg" required>
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
        <div class="bg-white rounded-lg p-6 max-w-lg w-full max-h-[90vh] flex flex-col">
            <h3 id="modal-title" class="text-xl font-bold mb-4 shrink-0">Add New Item</h3>
            
            <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar">
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
                <div>
                    <label class="block text-sm font-bold mb-1">Map Embed URL (Google or OSM)</label>
                    <input type="text" name="map_url" id="prop-map-url" placeholder="Paste the 'src' URL from the embed code here..." class="w-full p-2 border rounded focus:ring-green-500 outline-none">
                    <p class="text-[10px] text-gray-500 mt-1">Paste the source URL from any map's "Embed" code (Google Maps or OpenStreetMap) or a Google Maps link containing coordinates (e.g., @9.013,38.756).</p>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <input type="number" name="bedrooms" id="prop-beds" placeholder="Beds" class="p-2 border rounded">
                    <input type="number" name="bathrooms" id="prop-baths" placeholder="Baths" class="p-2 border rounded">
                    <input type="number" name="area_sqft" id="prop-area" placeholder="Sq Ft" class="p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Amenities & Features</label>
                    <div id="amenities-checkboxes" class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto p-2 border rounded bg-gray-50">
                        <?php 
                        $common_amenities = ['Air conditioning', 'Free WiFi', 'Elevator', 'Gym', 'Parking', 'Security', 'Swimming Pool', 'Garden', 'Balcony', 'City View', 'Furnished', 'Laundry Room'];
                        foreach ($common_amenities as $amen): 
                        ?>
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="amenities[]" value="<?php echo $amen; ?>" class="amenity-checkbox">
                                <?php echo $amen; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Property Images</label>
                    <div class="flex gap-2 mb-2">
                        <input type="file" id="prop-images-input" multiple class="hidden" accept="image/*">
                        <button type="button" onclick="document.getElementById('prop-images-input').click()" class="bg-brand-green text-brand-yellow px-4 py-2 rounded font-bold text-sm hover:bg-opacity-90 transition">Add More Images</button>
                    </div>
                    <div id="prop-images-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
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
            </div>

            <div class="flex justify-end space-x-2 mt-6 pt-4 border-t shrink-0">
                <button type="button" onclick="hideAddModal()" class="px-4 py-2 text-gray-500">Cancel</button>
                <button type="button" onclick="handleSave()" class="bg-brand-green text-brand-yellow px-4 py-2 rounded">Save Changes</button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = sidebar.classList.contains('translate-x-0');
            
            if (isOpen) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
            }
        }

        // Close sidebar when switching tabs on mobile
        function switchTab(tab) {
            if (typeof window.originalSwitchTab === 'function') {
                window.originalSwitchTab(tab);
            }
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('admin-sidebar');
                if (sidebar && sidebar.classList.contains('translate-x-0')) {
                    toggleSidebar();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            window.originalSwitchTab = window.switchTab;
            window.switchTab = switchTab;
        });
    </script>
    <?php include 'scripts.php'; ?>
    <?php include 'handleSave.php'; ?>
</body>
</html>
