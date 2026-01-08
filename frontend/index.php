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
        
        .property-title:hover {
            color: #8cc63f !important;
        }
        
        /* Navigation enhancements */
        .nav-link {
            position: relative;
            transition: color 0.3s;
        }
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
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Modern Card Styling */
        .service-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--brand-yellow);
        }
        .service-card:hover .service-icon-container {
            background-color: var(--brand-yellow) !important;
        }
        .service-card:hover .service-icon {
            color: var(--brand-green) !important;
        }
        
        /* About Section Overlay */
        .about-overlay {
            background: linear-gradient(180deg, rgba(0, 129, 72, 0.7) 0%, rgba(0, 129, 72, 0.9) 100%);
        }
        
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
                <a href="/properties" class="nav-link">Propertys</a>
                <a href="/news" class="nav-link">News</a>
                <a href="/contact" class="nav-link">Contact</a>
            </div>
            <a href="tel:+251921878641" id="nav-call-btn" class="bg-[#008148] text-white font-bold px-8 py-2.5 rounded flex items-center gap-2 hover:bg-opacity-90 transition shadow-lg">
                Call Us <i class="fas fa-phone-square-alt text-xl"></i>
            </a>
        </div>
    </nav>

    <div class="bg-white py-4 border-b border-gray-100">
        <div class="container mx-auto px-4 flex justify-center items-center gap-4">
            <div class="h-[2px] w-24 bg-brand-green opacity-50"></div>
            <div class="h-[2px] w-24 bg-brand-green opacity-50"></div>
            <i class="fas fa-star text-brand-yellow text-xl"></i>
            <div class="h-[2px] w-24 bg-brand-green opacity-50"></div>
            <div class="h-[2px] w-24 bg-brand-green opacity-50"></div>
        </div>
    </div>

    <script>
        // Particles Animation
        const canvas = document.getElementById('header-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        let mouse = { x: null, y: null, radius: 200 };

        function resize() {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }
        window.addEventListener('resize', resize);
        window.addEventListener('mousemove', function(event) {
            const rect = canvas.getBoundingClientRect();
            mouse.x = event.clientX - rect.left;
            mouse.y = event.clientY - rect.top;
        });
        resize();

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.baseX = this.x;
                this.baseY = this.y;
                this.vx = (Math.random() - 0.5) * 1.5;
                this.vy = (Math.random() - 0.5) * 1.5;
                this.radius = 1.5 + Math.random() * 2;
                this.density = (Math.random() * 40) + 5;
            }
            update() {
                // Movement with mouse interaction
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                let forceDirectionX = dx / distance;
                let forceDirectionY = dy / distance;
                let maxDistance = mouse.radius;
                let force = (maxDistance - distance) / maxDistance;
                let directionX = forceDirectionX * force * this.density;
                let directionY = forceDirectionY * force * this.density;

                if (distance < mouse.radius) {
                    this.x -= directionX;
                    this.y -= directionY;
                } else {
                    if (this.x !== this.baseX) {
                        let dx_ret = this.x - this.baseX;
                        this.x -= dx_ret / 15;
                    }
                    if (this.y !== this.baseY) {
                        let dy_ret = this.y - this.baseY;
                        this.y -= dy_ret / 15;
                    }
                    this.x += this.vx;
                    this.y += this.vy;
                    this.baseX += this.vx;
                    this.baseY += this.vy;
                    
                    if (this.baseX < 0 || this.baseX > canvas.width) this.vx *= -1;
                    if (this.baseY < 0 || this.baseY > canvas.height) this.vy *= -1;
                }
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = '#111827';
                ctx.fill();
            }
        }

        function init() {
            particles = [];
            for (let i = 0; i < 120; i++) {
                particles.push(new Particle());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach((p, i) => {
                p.update();
                p.draw();
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = p.x - particles[j].x;
                    const dy = p.y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 150) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(17, 24, 39, ${0.5 - dist / 150})`;
                        ctx.lineWidth = 1.2;
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            });
            requestAnimationFrame(animate);
        }

        init();
        animate();
    </script>

    <!-- Hero Section -->
    <header class="relative h-[600px] flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-black/40 z-10"></div>
        <div class="absolute inset-0 bg-[url('/public/assets/home-header.jpg')] bg-cover bg-center"></div>
        <div class="container mx-auto px-4 relative z-20 text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight">Ethiopia's Most Trusted <br><span class="text-brand-yellow">Real Estate Partner</span></h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl">Discover exceptional properties and build your future with Gift Real Estate PLC. From luxury villas to commercial spaces.</p>
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
                <div class="text-4xl font-bold text-brand-green" id="stats-phone">0921878641</div>
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

    <!-- Property Detail Modal -->
    <div id="property-modal" class="fixed inset-0 bg-black/80 z-[100] hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-6xl max-h-[90vh] rounded-3xl overflow-y-auto relative p-6 md:p-10">
            <button onclick="closePropertyModal()" class="absolute right-6 top-6 text-gray-400 hover:text-gray-600 transition z-50">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <div id="property-modal-content">
                <!-- Content injected via JS -->
            </div>
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
                <div class="flex space-x-2">
                    <button class="bg-white border p-2 rounded hover:bg-gray-50"><i class="fas fa-th-large"></i></button>
                    <button class="bg-white border p-2 rounded hover:bg-gray-50"><i class="fas fa-list"></i></button>
                </div>
            </div>

            <div id="property-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Properties will be loaded here dynamically -->
                <div class="text-center col-span-full py-10">
                    <p class="text-gray-500">Loading properties...</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <script>
                let allProperties = [];

                async function loadProperties() {
                    try {
                        const [propsRes, settingsRes] = await Promise.all([
                            fetch('/api/properties'),
                            fetch('/api/settings')
                        ]);
                        allProperties = await propsRes.json();
                        const settings = await settingsRes.json();
                        const contactPhone = settings.phone || '+251921878641';
                        
                        // Update UI with dynamic phone number
                        const topBarPhone = document.getElementById('top-bar-phone');
                        if (topBarPhone) topBarPhone.innerHTML = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${contactPhone}`;
                        
                        const navCallBtn = document.getElementById('nav-call-btn');
                        if (navCallBtn) navCallBtn.href = `tel:${contactPhone}`;
                        
                        const statsPhone = document.getElementById('stats-phone');
                        if (statsPhone) statsPhone.innerText = contactPhone;

                        displayProperties(allProperties, contactPhone);
                    } catch (error) {
                        console.error('Error loading properties:', error);
                    }
                }

                function displayProperties(properties, contactPhone) {
                    const grid = document.getElementById('property-grid');
                    if (properties.length === 0) {
                        grid.innerHTML = '<div class="text-center col-span-full py-10 text-gray-500">No properties found.</div>';
                        return;
                    }

                    grid.innerHTML = properties.map(p => {
                        let gallery = [];
                        try {
                            if (p.gallery_images) {
                                const parsed = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : p.gallery_images;
                                gallery = Array.isArray(parsed) ? parsed : [parsed];
                            } else {
                                gallery = [p.main_image];
                            }
                        } catch (e) {
                            console.error('Error parsing gallery images for property', p.id, e);
                            gallery = [p.main_image];
                        }
                        const images = gallery.filter(img => img).map(img => {
                            if (img.startsWith('/') || img.startsWith('http')) return img;
                            return '/uploads/' + img;
                        });
                        
                        const whatsappMsg = encodeURIComponent(`I am interested in this property: ${p.title} at ${p.location}`);
                        const whatsappLink = `https://wa.me/${contactPhone.replace(/\+/g, '').replace(/\s/g, '')}?text=${whatsappMsg}`;
                        
                        return `
                        <div class="group bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="relative h-64 overflow-hidden bg-gray-200 cursor-pointer" onclick="window.location.href='/property/${p.id}'">
                                <div class="property-slider h-full w-full flex transition-transform duration-500" id="slider-${p.id}">
                                    ${images.map(img => `
                                        <div class="w-full h-full flex-shrink-0">
                                            <img src="${img}" class="w-full h-full object-cover" alt="${p.title}" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80'">
                                        </div>
                                    `).join('')}
                                </div>
                                ${images.length > 1 ? `
                                    <button onclick="event.stopPropagation(); moveSlider(${p.id}, -1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white z-20">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button onclick="event.stopPropagation(); moveSlider(${p.id}, 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white z-20">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                ` : ''}
                                <div class="absolute top-4 left-4 flex gap-2 z-10">
                                    ${p.featured ? '<span class="bg-brand-green text-brand-yellow text-xs font-bold px-3 py-1 rounded">FEATURED</span>' : ''}
                                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded">${p.status ? p.status.toUpperCase() : 'FOR SALE'}</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="property-title text-xl font-bold text-gray-800 mb-2 cursor-pointer transition" onclick="window.location.href='/property/${p.id}'">${p.title}</h3>
                                <div class="inline-block bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg mb-3">Call for price</div>
                                <div class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                                    <i class="fas fa-ruler-combined text-gray-400"></i> ${p.area_sqft} sq ft
                                </div>
                                <div class="text-sm font-medium text-gray-700 mb-1">${p.title}</div>
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">${p.property_type || 'Property'}</div>
                                
                                <div class="flex gap-2 mb-4">
                                    <a href="tel:${contactPhone}" class="flex-1 bg-brand-green text-white text-center py-2 rounded-lg font-bold text-sm hover:bg-opacity-90 transition flex items-center justify-center gap-2">
                                        <i class="fas fa-phone-alt"></i> Call
                                    </a>
                                    <a href="${whatsappLink}" target="_blank" class="flex-1 bg-[#25D366] text-white text-center py-2 rounded-lg font-bold text-sm hover:bg-opacity-90 transition flex items-center justify-center gap-2">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                                <div class="flex justify-between border-t pt-4 text-sm text-gray-600">
                                    <span class="flex items-center"><i class="fas fa-bed mr-2 text-brand-green"></i> ${p.bedrooms} Beds</span>
                                    <span class="flex items-center"><i class="fas fa-bath mr-2 text-brand-green"></i> ${p.bathrooms} Baths</span>
                                </div>
                            </div>
                        </div>
                    `}).join('');
                }

                function showPropertyDetail(id) {
                    const p = allProperties.find(item => item.id == id);
                    if (!p) return;

                    let gallery = [];
                    try {
                        if (p.gallery_images) {
                            const parsed = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : p.gallery_images;
                            gallery = Array.isArray(parsed) ? parsed : [parsed];
                        } else {
                            gallery = [p.main_image];
                        }
                    } catch (e) {
                        gallery = [p.main_image];
                    }
                    const images = gallery.filter(img => img).map(img => {
                        if (img.startsWith('/') || img.startsWith('http')) return img;
                        return '/uploads/' + img;
                    });

                    const modal = document.getElementById('property-modal');
                    const content = document.getElementById('property-modal-content');
                    
                    const contactPhone = document.querySelector('a[href^="tel:"]')?.href.split(':')[1] || '+251921878641';

                    content.innerHTML = `
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="md:w-2/3">
                                <div class="relative h-[400px] rounded-2xl overflow-hidden mb-4 group">
                                    <div class="flex h-full transition-transform duration-500" id="modal-slider">
                                        ${images.map(img => `
                                            <img src="${img}" class="w-full h-full object-cover flex-shrink-0" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80'">
                                        `).join('')}
                                    </div>
                                    ${images.length > 1 ? `
                                        <button onclick="moveModalSlider(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg hover:bg-white z-10">
                                            <i class="fas fa-chevron-left text-brand-green"></i>
                                        </button>
                                        <button onclick="moveModalSlider(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg hover:bg-white z-10">
                                            <i class="fas fa-chevron-right text-brand-green"></i>
                                        </button>
                                        <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-sm font-bold">
                                            <span id="modal-current-slide">1</span> / ${images.length}
                                        </div>
                                    ` : ''}
                                </div>
                                <div class="grid grid-cols-4 gap-2 mb-8">
                                    ${images.map((img, i) => `
                                        <img src="${img}" onclick="setModalSlide(${i})" class="h-20 w-full object-cover rounded-lg cursor-pointer hover:opacity-80 transition border-2 ${i === 0 ? 'border-brand-green' : 'border-transparent'}" data-modal-thumb="${i}">
                                    `).join('')}
                                </div>

                                <div class="mb-8">
                                    <div class="text-sm font-bold text-gray-400 uppercase mb-2">${p.property_type}</div>
                                    <div class="flex justify-between items-start gap-4 mb-4">
                                        <h2 class="text-3xl font-bold text-gray-900">${p.title}</h2>
                                        <a href="tel:${contactPhone}" class="bg-brand-green text-white px-6 py-3 rounded-xl font-bold hover:bg-opacity-90 transition shadow-lg whitespace-nowrap">
                                            REQUEST INFO
                                        </a>
                                    </div>
                                    <div class="text-sm text-gray-500 mb-6">${p.title}</div>
                                    <div class="flex items-center gap-2 text-gray-400 mb-8">
                                        <i class="fas fa-ruler-combined"></i> ${p.area_sqft} sq ft
                                    </div>

                                    <div class="border-t border-b py-6 mb-8">
                                        <h3 class="text-xl font-bold mb-4">Basics</h3>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Date added</div>
                                                <div class="font-medium">${new Date(p.created_at).toLocaleDateString()}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Type</div>
                                                <div class="font-medium">${p.property_type}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Area</div>
                                                <div class="font-medium">${p.area_sqft} sq ft</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold mb-4">Description</h3>
                                        <div class="text-gray-600 leading-relaxed whitespace-pre-line">${p.description || 'No description available.'}</div>
                                    </div>

                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold mb-4">Amenities & Features</h3>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-snowflake text-brand-green"></i> Air conditioning
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-fire text-brand-green"></i> Barbeque
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-wind text-brand-green"></i> Dryer
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-elevator text-brand-green"></i> Elevator
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-dumbbell text-brand-green"></i> Gym
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-tshirt text-brand-green"></i> Laundry
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-wifi text-brand-green"></i> WiFi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="md:w-1/3">
                                <div class="bg-gray-50 rounded-2xl p-6 sticky top-24">
                                    <h3 class="text-xl font-bold mb-6">Ask an Agent About This Home</h3>
                                    <form id="modal-inquiry-form" class="space-y-4">
                                        <input type="hidden" name="property_id" value="${p.id}">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Name*</label>
                                            <input type="text" name="name" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Email*</label>
                                            <input type="email" name="email" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Phone</label>
                                            <input type="tel" name="phone" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Message*</label>
                                            <textarea name="message" required class="w-full p-3 border rounded-lg h-32 focus:ring-2 focus:ring-brand-green outline-none">I'm interested in "${p.title}"</textarea>
                                        </div>
                                        <button type="submit" class="w-full bg-brand-green text-white font-bold py-4 rounded-xl hover:bg-opacity-90 transition shadow-lg mt-4">
                                            REQUEST INFO
                                        </button>
                                        <p class="text-[10px] text-gray-400 mt-4 text-center">
                                            By clicking the "REQUEST INFO" button you agree to the Terms of Use and Privacy Policy
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;

                    window.modalSlide = 0;
                    window.modalSlidesCount = images.length;
                    
                    document.getElementById('modal-inquiry-form').onsubmit = handleModalInquiry;
                    
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }

                async function handleModalInquiry(e) {
                    e.preventDefault();
                    const form = e.target;
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());
                    
                    try {
                        const response = await fetch('/api/inquiries', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(data)
                        });
                        if (response.ok) {
                            alert('Thank you for your interest! An agent will contact you soon.');
                            form.reset();
                        } else {
                            alert('Sorry, something went wrong. Please try calling us directly.');
                        }
                    } catch (e) {
                        console.error('Inquiry error:', e);
                    }
                }

                function closePropertyModal() {
                    const modal = document.getElementById('property-modal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                }

                function moveModalSlider(dir) {
                    window.modalSlide = (window.modalSlide + dir + window.modalSlidesCount) % window.modalSlidesCount;
                    updateModalSlider();
                }

                function setModalSlide(index) {
                    window.modalSlide = index;
                    updateModalSlider();
                }

                function updateModalSlider() {
                    const slider = document.getElementById('modal-slider');
                    if (slider) slider.style.transform = `translateX(-${window.modalSlide * 100}%)`;
                    
                    const currentSpan = document.getElementById('modal-current-slide');
                    if (currentSpan) currentSpan.innerText = window.modalSlide + 1;
                    
                    document.querySelectorAll('[data-modal-thumb]').forEach((thumb, i) => {
                        thumb.classList.toggle('border-brand-green', i === window.modalSlide);
                        thumb.classList.toggle('border-transparent', i !== window.modalSlide);
                    });
                }

                function displayProperties(properties, contactPhone) {
                    const grid = document.getElementById('property-grid');
                    if (properties.length === 0) {
                        grid.innerHTML = '<div class="text-center col-span-full py-10 text-gray-500">No properties found.</div>';
                        return;
                    }

                    grid.innerHTML = properties.map(p => {
                        let gallery = [];
                        try {
                            if (p.gallery_images) {
                                const parsed = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : p.gallery_images;
                                gallery = Array.isArray(parsed) ? parsed : [parsed];
                            } else {
                                gallery = [p.main_image];
                            }
                        } catch (e) {
                            console.error('Error parsing gallery images for property', p.id, e);
                            gallery = [p.main_image];
                        }
                        const images = gallery.filter(img => img).map(img => {
                            if (img.startsWith('/') || img.startsWith('http')) return img;
                            return '/uploads/' + img;
                        });
                        
                        const whatsappMsg = encodeURIComponent(`I am interested in this property: ${p.title} at ${p.location}`);
                        const whatsappLink = `https://wa.me/${contactPhone.replace(/\+/g, '').replace(/\s/g, '')}?text=${whatsappMsg}`;
                        
                        return `
                        <div class="group bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="relative h-64 overflow-hidden bg-gray-200 cursor-pointer" onclick="window.location.href='/property/${p.id}'">
                                <div class="property-slider h-full w-full flex transition-transform duration-500" id="slider-${p.id}">
                                    ${images.map(img => `
                                        <div class="w-full h-full flex-shrink-0">
                                            <img src="${img}" class="w-full h-full object-cover" alt="${p.title}" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80'">
                                        </div>
                                    `).join('')}
                                </div>
                                ${images.length > 1 ? `
                                    <button onclick="event.stopPropagation(); moveSlider(${p.id}, -1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white z-20">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button onclick="event.stopPropagation(); moveSlider(${p.id}, 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white z-20">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                ` : ''}
                                <div class="absolute top-4 left-4 flex gap-2 z-10">
                                    ${p.featured ? '<span class="bg-brand-green text-brand-yellow text-xs font-bold px-3 py-1 rounded">FEATURED</span>' : ''}
                                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded">${p.status ? p.status.toUpperCase() : 'FOR SALE'}</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="property-title text-xl font-bold text-gray-800 mb-2 cursor-pointer transition" onclick="window.location.href='/property/${p.id}'">${p.title}</h3>
                                <div class="inline-block bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg mb-3">Call for price</div>
                                <div class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                                    <i class="fas fa-ruler-combined text-gray-400"></i> ${p.area_sqft} sq ft
                                </div>
                                <div class="text-sm font-medium text-gray-700 mb-1">${p.title}</div>
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">${p.property_type || 'Property'}</div>
                                
                                <div class="flex gap-2 mb-4">
                                    <a href="tel:${contactPhone}" class="flex-1 bg-brand-green text-white text-center py-2 rounded-lg font-bold text-sm hover:bg-opacity-90 transition flex items-center justify-center gap-2">
                                        <i class="fas fa-phone-alt"></i> Call
                                    </a>
                                    <a href="${whatsappLink}" target="_blank" class="flex-1 bg-[#25D366] text-white text-center py-2 rounded-lg font-bold text-sm hover:bg-opacity-90 transition flex items-center justify-center gap-2">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                                <div class="flex justify-between border-t pt-4 text-sm text-gray-600">
                                    <span class="flex items-center"><i class="fas fa-bed mr-2 text-brand-green"></i> ${p.bedrooms} Beds</span>
                                    <span class="flex items-center"><i class="fas fa-bath mr-2 text-brand-green"></i> ${p.bathrooms} Baths</span>
                                </div>
                            </div>
                        </div>
                    `}).join('');
                }

                function showPropertyDetail(id) {
                    const p = allProperties.find(item => item.id == id);
                    if (!p) return;

                    let gallery = [];
                    try {
                        if (p.gallery_images) {
                            const parsed = typeof p.gallery_images === 'string' ? JSON.parse(p.gallery_images) : p.gallery_images;
                            gallery = Array.isArray(parsed) ? parsed : [parsed];
                        } else {
                            gallery = [p.main_image];
                        }
                    } catch (e) {
                        gallery = [p.main_image];
                    }
                    const images = gallery.filter(img => img).map(img => {
                        if (img.startsWith('/') || img.startsWith('http')) return img;
                        return '/uploads/' + img;
                    });

                    const modal = document.getElementById('property-modal');
                    const content = document.getElementById('property-modal-content');
                    
                    const contactPhone = document.querySelector('a[href^="tel:"]')?.href.split(':')[1] || '+251921878641';

                    content.innerHTML = `
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="md:w-2/3">
                                <div class="relative h-[400px] rounded-2xl overflow-hidden mb-4 group">
                                    <div class="flex h-full transition-transform duration-500" id="modal-slider">
                                        ${images.map(img => `
                                            <img src="${img}" class="w-full h-full object-cover flex-shrink-0" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80'">
                                        `).join('')}
                                    </div>
                                    ${images.length > 1 ? `
                                        <button onclick="moveModalSlider(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg hover:bg-white z-10">
                                            <i class="fas fa-chevron-left text-brand-green"></i>
                                        </button>
                                        <button onclick="moveModalSlider(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg hover:bg-white z-10">
                                            <i class="fas fa-chevron-right text-brand-green"></i>
                                        </button>
                                        <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-sm font-bold">
                                            <span id="modal-current-slide">1</span> / ${images.length}
                                        </div>
                                    ` : ''}
                                </div>
                                <div class="grid grid-cols-4 gap-2 mb-8">
                                    ${images.map((img, i) => `
                                        <img src="${img}" onclick="setModalSlide(${i})" class="h-20 w-full object-cover rounded-lg cursor-pointer hover:opacity-80 transition border-2 ${i === 0 ? 'border-brand-green' : 'border-transparent'}" data-modal-thumb="${i}">
                                    `).join('')}
                                </div>

                                <div class="mb-8">
                                    <div class="text-sm font-bold text-gray-400 uppercase mb-2">${p.property_type}</div>
                                    <div class="flex justify-between items-start gap-4 mb-4">
                                        <h2 class="text-3xl font-bold text-gray-900">${p.title}</h2>
                                        <a href="tel:${contactPhone}" class="bg-brand-green text-white px-6 py-3 rounded-xl font-bold hover:bg-opacity-90 transition shadow-lg whitespace-nowrap">
                                            REQUEST INFO
                                        </a>
                                    </div>
                                    <div class="text-sm text-gray-500 mb-6">${p.title}</div>
                                    <div class="flex items-center gap-2 text-gray-400 mb-8">
                                        <i class="fas fa-ruler-combined"></i> ${p.area_sqft} sq ft
                                    </div>

                                    <div class="border-t border-b py-6 mb-8">
                                        <h3 class="text-xl font-bold mb-4">Basics</h3>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Date added</div>
                                                <div class="font-medium">${new Date(p.created_at).toLocaleDateString()}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Type</div>
                                                <div class="font-medium">${p.property_type}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase font-bold mb-1">Area</div>
                                                <div class="font-medium">${p.area_sqft} sq ft</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold mb-4">Description</h3>
                                        <div class="text-gray-600 leading-relaxed whitespace-pre-line">${p.description || 'No description available.'}</div>
                                    </div>

                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold mb-4">Amenities & Features</h3>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-snowflake text-brand-green"></i> Air conditioning
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-fire text-brand-green"></i> Barbeque
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-wind text-brand-green"></i> Dryer
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-elevator text-brand-green"></i> Elevator
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-dumbbell text-brand-green"></i> Gym
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-tshirt text-brand-green"></i> Laundry
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-600">
                                                <i class="fas fa-wifi text-brand-green"></i> WiFi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="md:w-1/3">
                                <div class="bg-gray-50 rounded-2xl p-6 sticky top-24">
                                    <h3 class="text-xl font-bold mb-6">Ask an Agent About This Home</h3>
                                    <form id="modal-inquiry-form" class="space-y-4">
                                        <input type="hidden" name="property_id" value="${p.id}">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Name*</label>
                                            <input type="text" name="name" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Email*</label>
                                            <input type="email" name="email" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Phone</label>
                                            <input type="tel" name="phone" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Message*</label>
                                            <textarea name="message" required class="w-full p-3 border rounded-lg h-32 focus:ring-2 focus:ring-brand-green outline-none">I'm interested in "${p.title}"</textarea>
                                        </div>
                                        <button type="submit" class="w-full bg-brand-green text-white font-bold py-4 rounded-xl hover:bg-opacity-90 transition shadow-lg mt-4">
                                            REQUEST INFO
                                        </button>
                                        <p class="text-[10px] text-gray-400 mt-4 text-center">
                                            By clicking the "REQUEST INFO" button you agree to the Terms of Use and Privacy Policy
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;

                    window.modalSlide = 0;
                    window.modalSlidesCount = images.length;
                    
                    document.getElementById('modal-inquiry-form').onsubmit = handleModalInquiry;
                    
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }

                async function handleModalInquiry(e) {
                    e.preventDefault();
                    const form = e.target;
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());
                    
                    try {
                        const response = await fetch('/api/inquiries', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(data)
                        });
                        if (response.ok) {
                            alert('Thank you for your interest! An agent will contact you soon.');
                            form.reset();
                        } else {
                            alert('Sorry, something went wrong. Please try calling us directly.');
                        }
                    } catch (e) {
                        console.error('Inquiry error:', e);
                    }
                }

                function closePropertyModal() {
                    const modal = document.getElementById('property-modal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                }

                function moveModalSlider(dir) {
                    window.modalSlide = (window.modalSlide + dir + window.modalSlidesCount) % window.modalSlidesCount;
                    updateModalSlider();
                }

                function setModalSlide(index) {
                    window.modalSlide = index;
                    updateModalSlider();
                }

                function updateModalSlider() {
                    const slider = document.getElementById('modal-slider');
                    if (slider) slider.style.transform = `translateX(-${window.modalSlide * 100}%)`;
                    
                    const currentSpan = document.getElementById('modal-current-slide');
                    if (currentSpan) currentSpan.innerText = window.modalSlide + 1;
                    
                    document.querySelectorAll('[data-modal-thumb]').forEach((thumb, i) => {
                        thumb.classList.toggle('border-brand-green', i === window.modalSlide);
                        thumb.classList.toggle('border-transparent', i !== window.modalSlide);
                    });
                }

                const sliderStates = {};
                function moveSlider(id, dir) {
                    if (!sliderStates[id]) sliderStates[id] = 0;
                    const slider = document.getElementById(`slider-${id}`);
                    const images = slider.querySelectorAll('img');
                    const dots = document.querySelectorAll(`.slider-dot-${id}`);
                    
                    sliderStates[id] = (sliderStates[id] + dir + images.length) % images.length;
                    slider.style.transform = `translateX(-${sliderStates[id] * 100}%)`;
                    
                    dots.forEach((dot, i) => {
                        dot.classList.toggle('bg-white', i === sliderStates[id]);
                        dot.classList.toggle('bg-white/50', i !== sliderStates[id]);
                    });
                }

                function filterProperties() {
                    const location = document.getElementById('search-location').value.toLowerCase();
                    const type = document.getElementById('filter-type').value;

                    const filtered = allProperties.filter(p => {
                        const matchLocation = !location || (p.location && p.location.toLowerCase().includes(location));
                        const matchType = !type || p.property_type === type;
                        return matchLocation && matchType;
                    });

                    const settingsBtn = document.getElementById('nav-call-btn');
                    const contactPhone = settingsBtn ? settingsBtn.href.replace('tel:', '') : '+251921878641';
                    displayProperties(filtered, contactPhone);
                }

                loadProperties();

                // Handle deep linking for section-based routes
                window.addEventListener('load', () => {
                    const path = window.location.pathname;
                    setTimeout(() => {
                        if (path === '/properties') document.getElementById('properties')?.scrollIntoView({ behavior: 'smooth' });
                        if (path === '/gallery') document.getElementById('gallery')?.scrollIntoView({ behavior: 'smooth' });
                        if (path === '/contact') document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' });
                    }, 500);
                });

                async function loadGallery() {
                    const grid = document.getElementById('gallery-grid');
                    if (!grid) return;
                    try {
                        const response = await fetch('/api/gallery');
                        const items = await response.json();
                        grid.innerHTML = items.map(item => `
                            <div class="relative group h-64 overflow-hidden rounded-xl">
                                <img src="${item.image_url}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6 text-white">
                                    <span class="text-xs font-bold text-brand-yellow uppercase mb-1">${item.category}</span>
                                    <h4 class="font-bold">${item.title}</h4>
                                </div>
                            </div>
                        `).join('');
                    } catch (e) {
                        console.error('Error loading gallery:', e);
                    }
                }

                async function loadNews() {
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
                }

                loadGallery();
                // loadNews(); (Removed from home page)
            </script>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-brand-green text-brand-yellow font-bold px-10 py-4 rounded hover:bg-opacity-90 transition">View All Properties</a>
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

    <!-- Services -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Residential Sales -->
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group cursor-pointer" onclick="window.location.href='/properties?type=Residential+Apartments'">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-home text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Residential Sales</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Find your perfect home from our extensive collection of villas, apartments, and family residences.</p>
                </div>

                <!-- Commercial Properties -->
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group cursor-pointer" onclick="window.location.href='/properties?type=Commercial+Properties'">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-users text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Commercial Properties</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Prime commercial spaces for your business needs, from retail shops to office complexes.</p>
                </div>

                <!-- Property Management -->
                <div class="bg-white p-10 rounded-[30px] border border-gray-100 service-card text-center group">
                    <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 transition-all duration-500 service-icon-container">
                        <i class="fas fa-handshake text-4xl text-[#008148] transition-all duration-500 service-icon"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-6 text-black">Property Management</h4>
                    <p class="text-gray-500 text-lg leading-relaxed">Comprehensive property management services to maximize your investment returns.</p>
                </div>

                <!-- Real Estate Developing -->
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

    <!-- Footer -->
    <section id="contact" class="bg-brand-green">
        <footer class="text-white pt-20 pb-10">
        <div class="container mx-auto px-4 text-center mb-12">
            <h3 class="text-3xl font-bold text-brand-yellow mb-8">Visit Our Office</h3>
            <div id="map-container" class="rounded-3xl overflow-hidden shadow-2xl h-96 border-4 border-brand-yellow/30 bg-white/5">
                <p class="pt-40 text-gray-400">Map location loading...</p>
            </div>
        </div>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div>
                    <div class="text-2xl font-black text-brand-yellow mb-6 uppercase">Gift Real Estate</div>
                    <p id="footer-about" class="text-gray-400 text-sm mb-6">For over 25 years, Gift Real Estate PLC has been Ethiopia’s trusted partner in building residential and commercial apartments.</p>
                    <div class="flex space-x-4">
                        <a id="social-facebook" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-facebook-f"></i></a>
                        <a id="social-telegram" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-telegram"></i></a>
                        <a id="social-instagram" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-instagram"></i></a>
                        <a id="social-linkedin" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow">Property Types</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/properties?type=Residential+Apartments" class="hover:text-white transition">Residential Apartments</a></li>
                        <li><a href="/properties?type=Commercial+Properties" class="hover:text-white transition">Commercial Properties</a></li>
                        <li><a href="/properties?type=Luxury+Villas" class="hover:text-white transition">Luxury Villas</a></li>
                        <li><a href="/properties?type=Office+Spaces" class="hover:text-white transition">Office Spaces</a></li>
                        <li><a href="/properties?type=Retail+Shops" class="hover:text-white transition">Retail Shops</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/about" class="hover:text-white transition">About Us</a></li>
                        <li><a href="/properties" class="hover:text-white transition">Our Properties</a></li>
                        <li><a href="/gallery" class="hover:text-white transition">Project Gallery</a></li>
                        <li><a href="/news" class="hover:text-white transition">Latest News</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for the latest updates.</p>
                    <div class="flex">
                        <input type="email" placeholder="Email" class="bg-white/10 border border-white/20 p-3 rounded-l w-full focus:outline-none">
                        <button class="bg-brand-yellow text-brand-green px-4 rounded-r font-bold">Join</button>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow">Contact Details</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-brand-yellow mt-1"></i> <span id="footer-address">Kazanchis, Black Gold Plaza, Addis Ababa</span></li>
                        <li class="flex items-center gap-3"><i class="fas fa-phone-alt text-brand-yellow"></i> <span id="footer-phone">+251 921878641</span></li>
                        <li class="flex items-center gap-3"><i class="fas fa-envelope text-brand-yellow"></i> <span id="footer-email">info@giftrealestate.com</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        async function loadSettings() {
            try {
                const response = await fetch('/api/settings');
                const settings = await response.json();
                if (settings.address) {
                    document.getElementById('footer-address').innerText = settings.address;
                    // Update top bar as well
                    const topBarAddress = document.querySelector('.bg-brand-green.text-white span');
                    if (topBarAddress) topBarAddress.innerHTML = `<i class="fas fa-map-marker-alt text-brand-yellow mr-2"></i>${settings.address}`;
                }
                if (settings.phone) {
                    document.getElementById('footer-phone').innerText = settings.phone;
                    const topBarPhone = document.querySelectorAll('.bg-brand-green.text-white span')[1];
                    if (topBarPhone) topBarPhone.innerHTML = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${settings.phone}`;
                }
                if (settings.email) document.getElementById('footer-email').innerText = settings.email;
                if (settings.facebook) document.getElementById('social-facebook').href = settings.facebook;
                if (settings.telegram) document.getElementById('social-telegram').href = settings.telegram;
                if (settings.instagram) document.getElementById('social-instagram').href = settings.instagram;
                if (settings.linkedin) document.getElementById('social-linkedin').href = settings.linkedin;
                
                if (settings.map_iframe) {
                    document.getElementById('map-container').innerHTML = `<iframe src="${settings.map_iframe}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
                }
            } catch (e) {
                console.error('Failed to load settings', e);
            }
        }
        loadSettings();
    </script>
</body>
</html>
