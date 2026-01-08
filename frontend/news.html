<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Updates - Gift Real Estate PLC</title>
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
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
                <a href="/gallery" class="hover:text-brand-yellow">Gallery</a>
                <a href="/news" class="text-brand-yellow">News</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-brand-green py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Latest News & Updates</h1>
            <p class="text-brand-yellow">Stay informed about our projects and community initiatives.</p>
        </div>
    </header>

    <!-- News Grid -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Loaded via JS -->
            </div>
        </div>
    </section>

    <!-- Footer (Simplified) -->
    <footer class="bg-brand-green text-white py-12 border-t border-white/10">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>

    <script>
        async function loadNews() {
            try {
                const response = await fetch('/api/news');
                const items = await response.json();
                const grid = document.getElementById('news-grid');
                grid.innerHTML = items.map(item => `
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                        <img src="${item.image_url || 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80'}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <span class="text-xs text-gray-400 font-bold uppercase">${new Date(item.created_at).toLocaleDateString()}</span>
                            <h4 class="text-xl font-bold text-brand-green mt-2 mb-4">${item.title}</h4>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4">${item.content}</p>
                            <a href="#" class="text-brand-green font-bold text-sm hover:text-brand-yellow">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                `).join('');
            } catch (error) {
                console.error('Error loading news:', error);
            }
        }
        loadNews();
    </script>
</body>
</html>