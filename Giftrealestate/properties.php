<?php
// PHP Error Reporting (Remove or comment out these 3 lines before going live)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <style>
        .nav-link:hover { color: #fdd835; transition: color 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50">

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
                    <span>Call Us</span>
                </a>
            </div>
        </div>
    </nav>

    <header class="relative py-32 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/assets/properties-header.jpg');">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-4">Our Properties</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow font-medium tracking-widest uppercase">Premium residential and commercial spaces</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-white"></path>
            </svg>
        </div>
    </header>

    <section class="py-10 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row gap-4">
                <input type="text" id="search-location" placeholder="Search by location..." class="flex-1 p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                <select id="filter-type" class="p-3 border rounded-lg focus:ring-2 focus:ring-brand-green outline-none">
                    <option value="">All Types</option>
                    <option value="Residential Apartments">Residential Apartments</option>
                    <option value="Commercial Properties">Commercial Properties</option>
                    <option value="Luxury Villas">Luxury Villas</option>
                    <option value="Office Spaces">Office Spaces</option>
                    <option value="Retail Shops">Retail Shops</option>
                    <option value="Land and Plots">Land & Plots</option>
                </select>
                <button onclick="filterProperties()" class="bg-brand-green text-brand-yellow font-bold px-8 py-3 rounded-lg hover:bg-opacity-90 transition">Filter</button>
            </div>
        </div>
    </section>

    <section class="py-20 min-h-[400px]">
        <div class="container mx-auto px-4">
            <div id="tech-error" class="hidden max-w-4xl mx-auto mb-8 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm"></div>
            
            <div id="property-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="col-span-full text-center py-20">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-brand-green border-t-transparent mb-4"></div>
                    <p class="text-gray-500">Loading premium properties...</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        let allProperties = [];
        
        async function loadProperties() {
            const grid = document.getElementById('property-grid');
            const errorDiv = document.getElementById('tech-error');
            
            try {
                // Fetching both APIs
                const [pRes, sRes] = await Promise.all([
                    fetch('/api/properties.php'),
                    fetch('/api/settings.php')
                ]);

                // Check if API files exist and are working
                if (!pRes.ok) throw new Error(`API Error: properties.php returned status ${pRes.status}`);
                if (!sRes.ok) throw new Error(`API Error: settings.php returned status ${sRes.status}`);

                const data = await pRes.json();
                const settings = await sRes.json();
                
                // Update Phone Numbers from settings
                if (settings && settings.phone) {
                    const callBtns = document.querySelectorAll('a[href^="tel:"]');
                    callBtns.forEach(btn => {
                        btn.href = `tel:${settings.phone.replace(/\s/g, '')}`;
                    });
                }

                allProperties = Array.isArray(data) ? data : [];
                displayProperties(allProperties);

                // Handle URL Type Filter
                const urlParams = new URLSearchParams(window.location.search);
                const typeFilter = urlParams.get('type');
                if (typeFilter) {
                    document.getElementById('filter-type').value = typeFilter;
                    filterProperties();
                }

            } catch (error) {
                console.error('Detailed Error:', error);
                errorDiv.classList.remove('hidden');
                errorDiv.innerHTML = `<strong>System Notice:</strong> ${error.message}. Please ensure the /api/ folder and files exist in your cPanel.`;
                grid.innerHTML = '<div class="col-span-full text-center py-20 text-gray-500 italic">Unable to load properties at this moment.</div>';
            }
        }

        function displayProperties(properties) {
            const grid = document.getElementById('property-grid');
            
            if (!properties || properties.length === 0) {
                grid.innerHTML = '<div class="col-span-full text-center py-20 text-gray-500 font-medium">No properties found matching your criteria.</div>';
                return;
            }

            grid.innerHTML = properties.map(p => {
                const img = p.main_image ? (p.main_image.startsWith('http') ? p.main_image : '/uploads/' + p.main_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
                
                return `
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-xl transition duration-300 group flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        <img src="${img}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4 flex gap-1">
                            ${p.featured == 1 ? '<span class="bg-green-600 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm uppercase tracking-wider">Featured</span>' : ''}
                            <span class="bg-yellow-400 text-brand-green text-[9px] font-bold px-2 py-0.5 rounded shadow-sm uppercase tracking-wider">For Sale</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="mb-4">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">${p.property_type || 'Residential Apartments'}</span>
                            <h3 class="text-xl font-bold text-brand-green mb-3 line-clamp-1 group-hover:text-brand-yellow transition-colors">${p.title}</h3>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-6 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-brand-green"></i> ${p.location || 'Leghar'}
                        </p>
                        
                        <div class="flex items-center justify-between mb-6 text-gray-600 text-[13px]">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bed text-brand-green"></i>
                                <span class="font-bold">${p.bedrooms || 0}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bath text-brand-green"></i>
                                <span class="font-bold">${p.bathrooms || 0}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-vector-square text-brand-green"></i>
                                <span class="font-bold">${p.area_sqft || 0} sq ft</span>
                            </div>
                        </div>

                        <div class="mt-auto flex items-center justify-between pt-6 border-t border-gray-100">
                            <span class="bg-gray-50 text-gray-600 text-[11px] font-bold px-3 py-1.5 rounded">
                                Call for price
                            </span>
                            <a href="property.php?id=${p.id}" class="text-brand-green font-bold text-sm flex items-center gap-1 group-hover:text-brand-yellow transition-colors">
                                Details <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
                `;
            }).join('');
        }

        function filterProperties() {
            const location = document.getElementById('search-location').value.toLowerCase();
            const type = document.getElementById('filter-type').value;
            
            const filtered = allProperties.filter(p => {
                const matchLoc = !location || (p.location && p.location.toLowerCase().includes(location)) || (p.title && p.title.toLowerCase().includes(location));
                const matchType = !type || p.property_type === type;
                return matchLoc && matchType;
            });
            displayProperties(filtered);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', loadProperties);
    </script>
</body>
</html>