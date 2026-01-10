<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-358ERBD36R"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-358ERBD36R');
</script>
    <link rel="icon" type="image/png" href="/assets/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay updated with the latest news, project milestones, and real estate market trends in Ethiopia from Gift Real Estate PLC.">
    <title>News & Updates | Gift Real Estate PLC Ethiopia Real Estate Market</title>
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
            <div class="flex items-center shrink-0">
                <a href="/"><img src="/assets/logo.png" alt="Gift Real Estate Logo" class="h-12 md:h-16 object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green uppercase text-sm tracking-wider">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About Us</a>
                <a href="gallery.php" class="nav-link">Gallery</a>
                <a href="properties.php" class="nav-link">Properties</a>
                <a href="news.php" class="nav-link text-brand-yellow">News</a>
            </div>
            <div class="flex items-center gap-2">
                <a href="tel:+251921878641" id="nav-call-btn" class="bg-brand-green text-brand-yellow font-bold px-4 md:px-6 py-2 rounded-full text-sm md:text-base whitespace-nowrap">
                    <span class="hidden sm:inline">Call Us</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative py-32 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/uploads/news_header.jpg');">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-6xl font-bold text-white mb-4">Latest News & Updates</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow font-medium tracking-widest uppercase">Stay informed about our projects and community initiatives.</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-gray-50"></path>
            </svg>
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

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <script>
        async function loadNews() {
            try {
                // Fetch settings for call button
                const sRes = await fetch('/api/settings.php');
                const settings = await sRes.json();
                if (settings.phone) {
                    const callBtn = document.getElementById('nav-call-btn');
                    if (callBtn) {
                        callBtn.href = `tel:${settings.phone.replace(/[^\d+]/g, '')}`;
                    }
                }

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