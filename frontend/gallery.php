<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Gallery - Gift Real Estate PLC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-green': '#004d40',
                        'brand-yellow': '#fdd835',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/"><img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green">
                <a href="/" class="hover:text-brand-yellow">Home</a>
                <a href="/properties" class="hover:text-brand-yellow">Properties</a>
                <a href="/gallery" class="text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-brand-green py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Our Project Gallery</h1>
            <p class="text-brand-yellow">Visual journey through our landmark developments in Ethiopia.</p>
        </div>
    </header>

    <!-- Gallery Grid -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Loaded via JS -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-green text-white py-12 border-t border-white/10">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>

    <script>
        async function loadGallery() {
            try {
                const response = await fetch('/api/gallery');
                const items = await response.json();
                const grid = document.getElementById('gallery-grid');
                grid.innerHTML = items.map(item => `
                    <div class="relative group h-72 overflow-hidden rounded-xl">
                        <img src="${item.image_url}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6 text-white">
                            <span class="text-xs font-bold text-brand-yellow uppercase mb-1">${item.category}</span>
                            <h4 class="font-bold">${item.title}</h4>
                        </div>
                    </div>
                `).join('');
            } catch (error) {
                console.error('Error loading gallery:', error);
            }
        }
        loadGallery();
    </script>
</body>
</html>