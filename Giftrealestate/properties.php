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
    <meta name="description" content="Browse luxury apartments and commercial properties for sale in Addis Ababa. Explore Gift Real Estate Legehar and other prime projects.">
    <meta name="keywords" content="Real Estate Property Addis Ababa for sale, Gift Real Estate Legehar price list, Apartments for sale Addis, Commercial shops Addis Ababa">
    <title>Properties for Sale in Addis Ababa | Gift Real Estate Legehar Apartments</title>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "name": "Real Estate Property Listings in Addis Ababa",
      "description": "Premium residential and commercial spaces for sale by Gift Real Estate PLC.",
      "url": "https://realestatepropertyaddis.com/properties.php"
    }
    </script>
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
            <div class="flex items-center shrink-0">
                <a href="/"><img src="/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 w-auto max-w-[150px] object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green uppercase text-sm tracking-wider">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About Us</a>
                <a href="gallery.php" class="nav-link">Gallery</a>
                <a href="properties.php" class="nav-link text-brand-yellow">Properties</a>
                <a href="news.php" class="nav-link">News</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="flex items-center">
                <a href="tel:+251921878641" id="nav-call-btn" class="bg-brand-green text-brand-yellow font-bold px-4 md:px-6 py-2 rounded-full text-sm md:text-base whitespace-nowrap">
                    <span class="hidden sm:inline">Call Us</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative py-32 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/assets/properties-header.jpg');">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-6xl font-bold text-white mb-4">Our Properties</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow font-medium tracking-widest uppercase">Explore our wide range of premium residential and commercial spaces.</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-white"></path>
            </svg>
        </div>
    </header>

    <!-- Search/Filter -->
    <section class="py-10 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row gap-4">
                <input type="text" id="search-location" placeholder="Search by location..." class="flex-1 p-3 border rounded-lg focus:ring-2 focus:ring-brand-green">
                <select id="filter-type" class="p-3 border rounded-lg focus:ring-2 focus:ring-brand-green">
                    <option value="">All Types</option>
                    <option value="Residential Apartments">Residential Apartments</option>
                    <option value="Commercial Properties">Commercial Properties</option>
                    <option value="Luxury Villas">Luxury Villas</option>
                    <option value="Office Spaces">Office Spaces</option>
                    <option value="Retail Shops">Retail Shops</option>
                    <option value="Land and Plots">Land & Plots</option>
                </select>
                <button onclick="filterProperties()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg">Filter</button>
            </div>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div id="property-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Loaded via JS -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
    <script>
        let allProperties = [];
        async function loadProperties() {
            const urlParams = new URLSearchParams(window.location.search);
            const typeFilter = urlParams.get('type');
            
            try {
                const [pRes, sRes] = await Promise.all([
                    fetch('/api/properties.php'),
                    fetch('/api/settings.php')
                ]);
                const data = await pRes.json();
                const settings = await sRes.json();
                
                // Update header/footer info
                if (settings.phone) {
                    const callBtn = document.querySelector('a[href^="tel:"]');
                    if (callBtn) {
                        callBtn.href = `tel:${settings.phone.replace(/\s/g, '')}`;
                        callBtn.innerText = 'Call Us';
                    }
                }

                allProperties = Array.isArray(data) ? data : [];
                
                if (typeFilter) {
                    document.getElementById('filter-type').value = typeFilter;
                    filterProperties();
                } else {
                    displayProperties(allProperties);
                }
            } catch (error) {
                console.error('Error loading properties:', error);
                document.getElementById('property-grid').innerHTML = '<div class="col-span-3 text-center py-20 text-red-500">Error loading properties. Please try again later.</div>';
            }
        }

        function displayProperties(properties) {
            const grid = document.getElementById('property-grid');
            if (!properties || properties.length === 0) {
                grid.innerHTML = '<div class="col-span-3 text-center py-20 text-gray-500">No properties found matching your criteria.</div>';
                return;
            }
            grid.innerHTML = properties.map(p => {
                const img = p.main_image ? (p.main_image.startsWith('http') || p.main_image.startsWith('data:') ? p.main_image : '/uploads/' + p.main_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
                
                let gallery = [];
                try {
                    gallery = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : (p.gallery_images || []);
                } catch(e) { gallery = [img]; }
                if (gallery.length === 0) gallery = [img];

                const slideshowId = `slideshow-${p.id}`;

                return `
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition cursor-pointer">
                    <div class="h-64 relative overflow-hidden group/slides">
                        <div id="${slideshowId}" class="w-full h-full relative">
                            ${gallery.map((gImg, idx) => `
                                <img src="${gImg.startsWith('http') || gImg.startsWith('data:') ? gImg : '/uploads/' + gImg}" 
                                     class="absolute inset-0 w-full h-full object-contain bg-gray-100 transition-opacity duration-500 ${idx === 0 ? 'opacity-100' : 'opacity-0'}" 
                                     data-index="${idx}">
                            `).join('')}
                        </div>
                        
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2 z-10">
                            ${p.featured == 1 ? '<span class="bg-[#32CD32] text-white text-[10px] font-bold px-2 py-1 rounded">Featured</span>' : ''}
                            <span class="bg-[#FFD700] text-black text-[10px] font-bold px-2 py-1 rounded">${p.status || 'For Sale'}</span>
                            <span class="bg-[#333] text-white text-[10px] font-bold px-2 py-1 rounded">Reduced Price</span>
                        </div>
                        
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center text-gray-600 hover:text-red-500 transition z-10">
                            <i class="far fa-heart"></i>
                        </button>

                        ${gallery.length > 1 ? `
                            <button onclick="prevSlide(event, '${slideshowId}')" class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center opacity-0 group-hover/slides:opacity-100 transition z-10">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </button>
                            <button onclick="nextSlide(event, '${slideshowId}')" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center opacity-0 group-hover/slides:opacity-100 transition z-10">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                                ${gallery.map((_, idx) => `
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/50 ${idx === 0 ? 'bg-white' : ''}" data-dot="${idx}"></div>
                                `).join('')}
                            </div>
                        ` : ''}
                    </div>
                    <div class="p-6" onclick="window.location.href='property.php?id=${p.id}'">
                        <div class="text-xs font-bold text-gray-400 uppercase mb-2">${p.property_type || 'Property'}</div>
                        <h3 class="text-xl font-bold text-brand-green mb-2">${p.title}</h3>
                        <p class="text-gray-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> ${p.location || 'Ethiopia'}</p>
                        <div class="mb-4 relative z-20">
                            <a href="tel:${settings.phone}" class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-gray-200 transition-colors pointer-events-auto">${p.price > 0 ? new Intl.NumberFormat().format(p.price) + ' ETB' : 'Call for price'}</a>
                        </div>
                        <div class="flex justify-between border-t pt-4 text-sm text-gray-600">
                            <span><i class="fas fa-bed mr-1"></i> ${p.bedrooms || 0}</span>
                            <span><i class="fas fa-bath mr-1"></i> ${p.bathrooms || 0}</span>
                            <span><i class="fas fa-ruler-combined mr-1"></i> ${p.area_sqft || 0} sq ft</span>
                        </div>
                    </div>
                </div>
                `;
            }).join('');
        }

        function nextSlide(e, id) {
            if (e) e.stopPropagation();
            const container = document.getElementById(id);
            if (!container) return;
            const slides = container.querySelectorAll('img');
            if (slides.length <= 1) return;
            const dots = container.parentElement.querySelectorAll('[data-dot]');
            let current = Array.from(slides).findIndex(s => s.classList.contains('opacity-100'));
            if (current === -1) current = 0;
            
            slides[current].classList.replace('opacity-100', 'opacity-0');
            if (dots[current]) dots[current].classList.remove('bg-white');
            current = (current + 1) % slides.length;
            slides[current].classList.replace('opacity-0', 'opacity-100');
            if (dots[current]) dots[current].classList.add('bg-white');
        }

        function prevSlide(e, id) {
            if (e) e.stopPropagation();
            const container = document.getElementById(id);
            if (!container) return;
            const slides = container.querySelectorAll('img');
            if (slides.length <= 1) return;
            const dots = container.parentElement.querySelectorAll('[data-dot]');
            let current = Array.from(slides).findIndex(s => s.classList.contains('opacity-100'));
            if (current === -1) current = 0;
            
            slides[current].classList.replace('opacity-100', 'opacity-0');
            if (dots[current]) dots[current].classList.remove('bg-white');
            current = (current - 1 + slides.length) % slides.length;
            slides[current].classList.replace('opacity-0', 'opacity-100');
            if (dots[current]) dots[current].classList.add('bg-white');
        }

        function filterProperties() {
            const location = document.getElementById('search-location').value.toLowerCase();
            const type = document.getElementById('filter-type').value;
            const filtered = allProperties.filter(p => {
                const matchLoc = !location || (p.location && p.location.toLowerCase().includes(location));
                const matchType = !type || p.property_type === type;
                return matchLoc && matchType;
            });
            displayProperties(filtered);
        }
        loadProperties();
    </script>
</body>
</html>