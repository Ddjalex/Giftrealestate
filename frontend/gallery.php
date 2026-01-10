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
                <a href="/about" class="hover:text-brand-yellow">About</a>
                <a href="/properties" class="hover:text-brand-yellow">Properties</a>
                <a href="/gallery" class="text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/inquiries" class="hover:text-brand-yellow">Inquiries</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative py-32 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/uploads/gallery_header.jpg');">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-6xl font-bold text-white mb-4">Our Project Gallery</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow font-medium tracking-widest uppercase">Visual journey through our landmark developments in Ethiopia.</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-gray-50"></path>
            </svg>
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
    <?php include 'footer.php'; ?>
</body>
</html>
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