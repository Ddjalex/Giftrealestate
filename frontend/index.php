<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Real Estate PLC - Ethiopia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brand-green: #008148;
            --brand-yellow: #fdd835;
        }
        .bg-brand-green { background-color: var(--brand-green); }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-yellow { background-color: var(--brand-yellow); }
        .text-brand-yellow { color: var(--brand-yellow); }
        .border-brand-yellow { border-color: var(--brand-yellow); }
        .hover-bg-brand-yellow:hover { background-color: #fbc02d; }
        
        .property-title:hover { color: #8cc63f !important; }
        
        .nav-link { position: relative; transition: color 0.3s; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--brand-green);
            transition: width 0.3s;
        }
        .nav-link:hover::after { width: 100%; }
        
        .service-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--brand-yellow);
        }
        .service-card:hover .service-icon-container { background-color: var(--brand-yellow) !important; }
        .service-card:hover .service-icon { color: var(--brand-green) !important; }
        
        .about-overlay { background: linear-gradient(180deg, rgba(0, 129, 72, 0.7) 0%, rgba(0, 129, 72, 0.9) 100%); }
        
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
            padding-right: 2.5rem;
        }

        .header-animate-in {
            animation: fadeInScale 1.2s ease-out forwards;
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(1.05); }
            to { opacity: 1; transform: scale(1); }
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            z-index: 30;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateX(-50%) translateY(0);}
            40% {transform: translateX(-50%) translateY(-10px);}
            60% {transform: translateX(-50%) translateY(-5px);}
        }

        #header-overlay {
            transition: opacity 1s ease-in-out;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Top Bar -->
    <div class="bg-brand-green text-white py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <div class="flex space-x-4">
                <span><i class="fas fa-map-marker-alt text-brand-yellow mr-2"></i>Kazanchis, Black Gold Plaza, Addis Ababa</span>
                <span id="top-bar-phone"><i class="fas fa-phone-alt text-brand-yellow mr-2"></i>+251 921878641</span>
            </div>
            <div class="flex space-x-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-telegram"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50 overflow-hidden">
        <canvas id="header-canvas" class="absolute inset-0 pointer-events-none opacity-40"></canvas>
        <div class="container mx-auto px-4 flex justify-between items-center h-20 relative z-10">
            <div class="flex items-center">
                <img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain">
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green uppercase text-sm tracking-wider">
                <a href="/" class="nav-link text-brand-green">Home</a>
                <a href="/about" class="nav-link">About Us</a>
                <a href="/gallery" class="nav-link">Gallery</a>
                <a href="/properties" class="nav-link">Properties</a>
                <a href="/news" class="nav-link">News</a>
                <a href="/contact" class="nav-link">Contact</a>
            </div>
            <a href="tel:+251921878641" id="nav-call-btn" class="bg-[#008148] text-white font-bold px-8 py-2.5 rounded flex items-center gap-2 hover:bg-opacity-90 transition shadow-lg">
                Call Us <i class="fas fa-phone-square-alt text-xl"></i>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="main-header" class="relative min-h-[700px] flex items-center overflow-hidden bg-brand-green">
        <div id="header-bg-container" class="absolute inset-0 z-0">
            <!-- Initial fallback to prevent green flash -->
            <img id="header-image-bg" src="/uploads/hero_preloader.jpg" class="w-full h-full object-cover transition-opacity duration-1000 absolute inset-0 z-[1]" alt="Header Background" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80';">
        </div>
        <div id="header-overlay" class="absolute inset-0 z-[6] pointer-events-none" style="background: linear-gradient(180deg, rgba(0, 77, 64, 0.4) 0%, rgba(0, 77, 64, 0.6) 100%);"></div>
        <div class="scroll-indicator text-white text-2xl z-30">
            <i class="fas fa-chevron-down"></i>
        </div>
    </header>

    <!-- Stats Bar & Search Box -->
    <div class="container mx-auto px-4 -mt-16 relative z-30">
        <div class="grid grid-cols-1 md:grid-cols-3 bg-white shadow-2xl rounded-xl overflow-hidden text-center divide-y md:divide-y-0 md:divide-x divide-gray-100 mb-8">
            <div class="p-8">
                <div class="text-4xl font-bold text-brand-green">3000+</div>
                <div class="text-gray-500 font-semibold uppercase tracking-wider text-sm mt-2">Properties Sold</div>
            </div>
            <div class="p-8">
                <div class="text-4xl font-bold text-brand-green" id="stats-phone">0974408281</div>
                <div class="text-gray-500 font-semibold uppercase tracking-wider text-sm mt-2">Call For Info</div>
            </div>
            <div class="p-8">
                <div class="text-4xl font-bold text-brand-green">25+</div>
                <div class="text-gray-500 font-semibold uppercase tracking-wider text-sm mt-2">Years Experience</div>
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto bg-white p-4 rounded-xl shadow-lg flex flex-col md:flex-row gap-4">
            <input type="text" id="search-location" placeholder="Search by location (CMC, Bole, Ayat)..." class="flex-1 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-green text-gray-800">
            <select id="filter-type" class="p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-green text-gray-800 bg-white min-w-[200px]">
                <option value="">All Types</option>
                <option value="Residential Apartments">Residential Apartments</option>
                <option value="Commercial Properties">Commercial Properties</option>
                <option value="Luxury Villas">Luxury Villas</option>
                <option value="Office Spaces">Office Spaces</option>
                <option value="Retail Shops">Retail Shops</option>
                <option value="Land & Plots">Land & Plots</option>
            </select>
            <button onclick="filterProperties()" class="bg-brand-yellow text-brand-green font-bold px-8 py-3 rounded-lg hover:bg-yellow-500 transition shadow-md whitespace-nowrap">Search Properties</button>
        </div>
    </div>

    <!-- Featured Properties -->
    <section id="properties" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-brand-green mb-2">Featured Properties</h2>
                    <p class="text-gray-600">Handpicked selection of exceptional properties meeting the highest standards.</p>
                </div>
            </div>
            <div id="property-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center col-span-full py-10">
                    <p class="text-gray-500">Loading properties...</p>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="/properties" class="inline-block bg-brand-green text-brand-yellow font-bold px-10 py-4 rounded hover:bg-opacity-90 transition shadow-xl">View All Properties</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-[40px] p-8 md:p-16 border-2 border-[#00ff00] shadow-sm relative overflow-hidden text-center">
                    <h2 class="text-5xl md:text-6xl font-bold text-black mb-12">About Gift Real Estate PLC</h2>
                    <p class="text-2xl text-gray-800 leading-relaxed mb-12 max-w-5xl mx-auto font-medium">
                        For over 25 years, Gift Real Estate PLC has been Ethiopia's trusted partner in building residential apartments, commercial apartments and creating exceptional living experiences. We don't just sell properties – we help you build your future.
                    </p>
                    <div class="relative rounded-[40px] overflow-hidden group shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80" class="w-full h-auto min-h-[500px] object-cover transition-all duration-1000 group-hover:scale-110" alt="Gift Real Estate Projects">
                        <div class="absolute inset-0 about-overlay z-10 opacity-80 group-hover:opacity-60 transition-opacity"></div>
                        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center p-6 md:p-12 text-center text-white">
                            <h3 class="text-4xl md:text-6xl font-bold mb-4 md:mb-8">"Gift Real Estate PLC"</h3>
                            <p class="text-lg md:text-3xl max-w-5xl leading-relaxed font-semibold">
                                Gift Real Estate PLC's mission is to provide cutting-edge residential and commercial properties that are designed and built specifically to meet the needs of customers, transforming their lifestyle to a higher standard 21st-century lifestyle.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group cursor-pointer" onclick="window.location.href='/properties?type=Residential+Apartments'">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-home text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Residential Sales</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Find your perfect home from our extensive collection of villas, apartments, and family residences.</p>
                </div>
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group cursor-pointer" onclick="window.location.href='/properties?type=Commercial+Properties'">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-users text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Commercial Properties</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Prime commercial spaces for your business needs, from retail shops to office complexes.</p>
                </div>
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-handshake text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Property Management</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Comprehensive property management services to maximize your investment returns.</p>
                </div>
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-broadcast-tower text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Real Estate Developing</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Expert guidance on real estate investments and market opportunities in Ethiopia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Preview -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-brand-green mb-12 text-center">Project Gallery</h2>
            <div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-4 gap-4"></div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Modal -->
    <div id="property-modal" class="fixed inset-0 bg-black/80 z-[100] hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-6xl max-h-[90vh] rounded-3xl overflow-y-auto relative p-6 md:p-10">
            <button onclick="closePropertyModal()" class="absolute right-6 top-6 text-gray-400 hover:text-gray-600 transition z-50">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <div id="property-modal-content"></div>
        </div>
    </div>

    <!-- Main Scripts -->
    <script>
        const canvas = document.getElementById('header-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        function resize() {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.vx = (Math.random() - 0.5) * 1;
                this.vy = (Math.random() - 0.5) * 1;
                this.radius = Math.random() * 2 + 1;
            }
            update() {
                this.x += this.vx; this.y += this.vy;
                if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = '#111827';
                ctx.fill();
            }
        }
        function initParticles() { particles = Array.from({ length: 80 }, () => new Particle()); }
        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animateParticles);
        }
        initParticles();
        animateParticles();

        async function loadData() {
            try {
                const [pRes, sRes, gRes] = await Promise.all([
                    fetch('/api/properties.php?featured=1'),
                    fetch('/api/settings.php'),
                    fetch('/api/gallery.php')
                ]);
                const propertiesData = await pRes.json();
                const settings = await sRes.json();
                const gallery = await gRes.json();
                
                const properties = Array.isArray(propertiesData) ? propertiesData : [];
                
                const phone = settings.phone || '+251921878641';
                document.getElementById('stats-phone').innerText = phone;
                document.getElementById('top-bar-phone').innerHTML = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${phone}`;
                document.getElementById('nav-call-btn').href = `tel:${phone}`;
                
                // Update header background (image or video)
                const headerContainer = document.getElementById('header-bg-container');
                const headerOverlay = document.getElementById('header-overlay');
                const fallbackImg = document.getElementById('header-image-bg');

                if (headerContainer) {
                    if (settings.header_video) {
                        const videoUrl = settings.header_video.startsWith('http') ? settings.header_video : '/uploads/' + settings.header_video;
                        headerContainer.innerHTML = `<video muted loop playsinline autoplay preload="auto" class="w-full h-full object-cover absolute inset-0 z-[5]"><source src="${videoUrl}" type="video/mp4"></video>`;
                        if (fallbackImg) fallbackImg.style.opacity = '0';
                    } else if (settings.header_image) {
                        const imgUrl = settings.header_image.startsWith('http') ? settings.header_image : '/uploads/' + settings.header_image;
                        headerContainer.innerHTML = `<img src="${imgUrl}" class="w-full h-full object-cover" alt="Background View">`;
                        if (headerOverlay) headerOverlay.style.background = 'linear-gradient(180deg, rgba(0, 129, 72, 0.7) 0%, rgba(0, 129, 72, 0.8) 100%)';
                    } else {
                        const defaultImg = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80';
                        headerContainer.innerHTML = `<img src="${defaultImg}" class="w-full h-full object-cover" alt="Background View">`;
                    }
                }
                
                displayProperties(properties, phone);
                displayGallery(gallery);
            } catch (e) { 
                console.error('Error loading data:', e);
                const grid = document.getElementById('property-grid');
                if (grid) grid.innerHTML = '<div class="text-center col-span-full py-10"><p class="text-red-500">Error loading featured properties.</p></div>';
            }
        }

        function displayProperties(props, phone) {
            const grid = document.getElementById('property-grid');
            if (!grid) return;
            grid.innerHTML = props.map(p => {
                const img = p.main_image ? (p.main_image.startsWith('http') || p.main_image.startsWith('data:') ? p.main_image : '/uploads/' + p.main_image) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80';
                
                // Parse gallery images for slideshow
                let gallery = [];
                try {
                    gallery = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : (p.gallery_images || []);
                } catch(e) { gallery = [img]; }
                if (gallery.length === 0) gallery = [img];

                const slideshowId = `slideshow-${p.id}`;
                
                return `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition group cursor-pointer">
                    <div class="h-64 relative overflow-hidden group/slides">
                        <div id="${slideshowId}" class="w-full h-full relative">
                            ${gallery.map((gImg, idx) => `
                                <img src="${gImg.startsWith('http') || gImg.startsWith('data:') ? gImg : '/uploads/' + gImg}" 
                                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 ${idx === 0 ? 'opacity-100' : 'opacity-0'}" 
                                     data-index="${idx}">
                            `).join('')}
                        </div>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2 z-10">
                            ${p.featured == 1 ? '<span class="bg-[#32CD32] text-white text-[10px] font-bold px-2 py-1 rounded">Featured</span>' : ''}
                            <span class="bg-[#FFD700] text-black text-[10px] font-bold px-2 py-1 rounded">${p.status || 'For Sale'}</span>
                            <span class="bg-[#333] text-white text-[10px] font-bold px-2 py-1 rounded">Reduced Price</span>
                        </div>
                        
                        <!-- Heart Icon -->
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center text-gray-600 hover:text-red-500 transition z-10">
                            <i class="far fa-heart"></i>
                        </button>

                        <!-- Slideshow Nav -->
                        ${gallery.length > 1 ? `
                            <button onclick="prevSlide(event, '${slideshowId}')" class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center opacity-0 group-hover/slides:opacity-100 transition z-10">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </button>
                            <button onclick="nextSlide(event, '${slideshowId}')" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-lg flex items-center justify-center opacity-0 group-hover/slides:opacity-100 transition z-10">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                            <!-- Dots -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                                ${gallery.map((_, idx) => `
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/50 ${idx === 0 ? 'bg-white' : ''}" data-dot="${idx}"></div>
                                `).join('')}
                            </div>
                        ` : ''}
                    </div>
                    <div class="p-6" onclick="window.location.href='/property/${p.id}'">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">${p.title}</h3>
                        <div class="mb-4">
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1.5 rounded-lg">Call for price</span>
                        </div>
                        <div class="flex items-center text-gray-400 text-sm mb-4">
                            <i class="fas fa-ruler-combined mr-2"></i> ${p.area_sqft || 0} sq ft
                        </div>
                        <p class="text-gray-600 text-sm line-clamp-1 mb-2">${p.description || p.title}</p>
                        <p class="text-brand-green font-bold text-sm">${p.property_type || 'Residential Apartment'}</p>
                    </div>
                </div>`;
            }).join('');
        }

        function nextSlide(e, id) {
            e.stopPropagation();
            const container = document.getElementById(id);
            const slides = container.querySelectorAll('img');
            const dots = container.parentElement.querySelectorAll('[data-dot]');
            let current = Array.from(slides).findIndex(s => s.classList.contains('opacity-100'));
            slides[current].classList.replace('opacity-100', 'opacity-0');
            if (dots[current]) dots[current].classList.remove('bg-white');
            
            current = (current + 1) % slides.length;
            
            slides[current].classList.replace('opacity-0', 'opacity-100');
            if (dots[current]) dots[current].classList.add('bg-white');
        }

        function prevSlide(e, id) {
            e.stopPropagation();
            const container = document.getElementById(id);
            const slides = container.querySelectorAll('img');
            const dots = container.parentElement.querySelectorAll('[data-dot]');
            let current = Array.from(slides).findIndex(s => s.classList.contains('opacity-100'));
            slides[current].classList.replace('opacity-100', 'opacity-0');
            if (dots[current]) dots[current].classList.remove('bg-white');
            
            current = (current - 1 + slides.length) % slides.length;
            
            slides[current].classList.replace('opacity-0', 'opacity-100');
            if (dots[current]) dots[current].classList.add('bg-white');
        }

        async function openPropertyModal(id) {
            const modal = document.getElementById('property-modal');
            const content = document.getElementById('property-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            content.innerHTML = '<p class="text-center py-20">Loading details...</p>';

            try {
                const res = await fetch(`/api/properties.php?id=${id}`);
                const p = await res.json();
                
                let galleryHtml = '';
                if (p.gallery_images) {
                    let images = [];
                    try {
                        images = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : p.gallery_images;
                    } catch(e) { images = [p.main_image]; }
                    
                    galleryHtml = `
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                            ${images.map(img => `
                                <div class="aspect-square overflow-hidden rounded-xl border cursor-pointer hover:opacity-80 transition" onclick="updateMainModalImage('${img}')">
                                    <img src="${img.startsWith('http') ? img : '/uploads/' + img}" class="w-full h-full object-cover">
                                </div>
                            `).join('')}
                        </div>
                    `;
                }

                const mainImg = p.main_image ? (p.main_image.startsWith('http') ? p.main_image : '/uploads/' + p.main_image) : '';

                content.innerHTML = `
                    <div class="flex flex-col md:flex-row gap-10">
                        <div class="md:w-1/2">
                            <img id="modal-main-img" src="${mainImg}" class="w-full h-[400px] object-cover rounded-3xl mb-6 shadow-lg">
                            ${galleryHtml}
                        </div>
                        <div class="md:w-1/2">
                            <h2 class="text-4xl font-bold text-brand-green mb-4">${p.title}</h2>
                            <p class="text-2xl font-bold text-gray-800 mb-6">${new Intl.NumberFormat().format(p.price)} ETB</p>
                            
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <div class="bg-gray-50 p-4 rounded-2xl text-center">
                                    <p class="text-gray-500 text-sm">Bedrooms</p>
                                    <p class="font-bold text-xl">${p.bedrooms}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-2xl text-center">
                                    <p class="text-gray-500 text-sm">Bathrooms</p>
                                    <p class="font-bold text-xl">${p.bathrooms}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-2xl text-center">
                                    <p class="text-gray-500 text-sm">Area (sqft)</p>
                                    <p class="font-bold text-xl">${p.area_sqft}</p>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="font-bold text-lg mb-2">Description</h3>
                                <p class="text-gray-600 leading-relaxed">${p.description}</p>
                            </div>

                            <div class="bg-brand-green/5 p-6 rounded-3xl border border-brand-green/10">
                                <h3 class="font-bold text-brand-green mb-4">Contact for details</h3>
                                <div class="flex items-center gap-4">
                                    <a href="tel:${document.getElementById('stats-phone').innerText}" class="flex-1 bg-brand-green text-white text-center py-4 rounded-xl font-bold hover:bg-opacity-90 transition">Call Agent</a>
                                    <button onclick="closePropertyModal()" class="flex-1 bg-white border border-gray-200 py-4 rounded-xl font-bold hover:bg-gray-50 transition">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } catch (e) {
                content.innerHTML = '<p class="text-center py-20 text-red-500">Error loading property details.</p>';
            }
        }

        function updateMainModalImage(url) {
            const img = document.getElementById('modal-main-img');
            if (img) img.src = url.startsWith('http') ? url : '/uploads/' + url;
        }

        function closePropertyModal() {
            const modal = document.getElementById('property-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function displayGallery(items) {
            const grid = document.getElementById('gallery-grid');
            if (!grid) return;
            grid.innerHTML = items.slice(0, 8).map(item => `
                <div class="relative h-64 overflow-hidden rounded-xl group cursor-pointer">
                    <img src="${item.image_url}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <p class="text-xs font-bold text-brand-yellow uppercase mb-1">${item.category}</p>
                            <h4 class="font-bold">${item.title}</h4>
                        </div>
                    </div>
                </div>`).join('');
        }

        window.addEventListener('load', loadData);
    </script>
</body>
</html>