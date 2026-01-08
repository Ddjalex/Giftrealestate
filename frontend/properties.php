<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - Gift Real Estate PLC</title>
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
                <a href="/properties" class="text-brand-yellow">Properties</a>
                <a href="/gallery" class="hover:text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/inquiries" class="hover:text-brand-yellow">Inquiries</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-brand-green py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Our Properties</h1>
            <p class="text-brand-yellow">Explore our wide range of premium residential and commercial spaces.</p>
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
    <footer class="bg-brand-green text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>

    <script>
        let allProperties = [];
        async function loadProperties() {
            const urlParams = new URLSearchParams(window.location.search);
            const typeFilter = urlParams.get('type');
            
            try {
                const response = await fetch('/api/properties');
                allProperties = await response.json();
                
                if (typeFilter) {
                    document.getElementById('filter-type').value = typeFilter;
                    filterProperties();
                } else {
                    displayProperties(allProperties);
                }
            } catch (error) {
                console.error('Error loading properties:', error);
            }
        }

        function displayProperties(properties) {
            const grid = document.getElementById('property-grid');
            grid.innerHTML = properties.map(p => `
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition cursor-pointer" onclick="window.location.href='/property/${p.id}'">
                    <img src="${p.main_image || 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80'}" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <div class="text-xs font-bold text-gray-400 uppercase mb-2">${p.property_type}</div>
                        <h3 class="text-xl font-bold text-brand-green mb-2">${p.title}</h3>
                        <p class="text-gray-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> ${p.location}</p>
                        <div class="text-brand-green font-bold text-lg mb-4">Call for price</div>
                        <div class="flex justify-between border-t pt-4 text-sm text-gray-600">
                            <span><i class="fas fa-bed mr-1"></i> ${p.bedrooms}</span>
                            <span><i class="fas fa-bath mr-1"></i> ${p.bathrooms}</span>
                            <span><i class="fas fa-ruler-combined mr-1"></i> ${p.area_sqft} sq ft</span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function filterProperties() {
            const location = document.getElementById('search-location').value.toLowerCase();
            const type = document.getElementById('filter-type').value;
            const filtered = allProperties.filter(p => {
                const matchLoc = !location || p.location.toLowerCase().includes(location);
                const matchType = !type || p.property_type === type;
                return matchLoc && matchType;
            });
            displayProperties(filtered);
        }
        loadProperties();
    </script>
</body>
</html>