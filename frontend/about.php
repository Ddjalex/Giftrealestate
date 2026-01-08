<?php
// About page for Gift Real Estate PLC
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gift Real Estate PLC</title>
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
        .timeline-container {
            position: relative;
            padding-left: 2rem;
        }
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }
        .timeline-dot {
            position: absolute;
            left: -5px;
            width: 12px;
            height: 12px;
            background: #fdd835;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/"><img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green">
                <a href="/" class="hover:text-brand-yellow">HOME</a>
                <a href="/about" class="text-brand-yellow">ABOUT US</a>
                <a href="/gallery" class="hover:text-brand-yellow">GALLERY</a>
                <a href="/properties" class="hover:text-brand-yellow">PROPERTYS</a>
                <a href="/news" class="hover:text-brand-yellow">NEWS</a>
                <a href="/contact" class="hover:text-brand-yellow">CONTACT</a>
            </div>
            <a href="tel:+251921878641" class="bg-green-600 text-white font-bold px-6 py-2 rounded flex items-center gap-2">
                Call Us <i class="fas fa-phone"></i>
            </a>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-12 items-start">
                <div class="flex-1">
                    <h1 class="text-5xl font-bold text-gray-900 mb-8">Gift Real Estate PLC</h1>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Gift Real Estate PLC is one of the core businesses of the Gift Business Group, and it is one of the pioneering real estate companies in Ethiopia. It was established in 2005. It has established a solid reputation as a result of its substantial contributions throughout the years to the growth of Ethiopia's real estate market. Its ambitious goal is to provide services to several cities in Ethiopia and other African nations.
                    </p>

                    <div class="space-y-12">
                        <div class="timeline-container">
                            <div class="timeline-dot" style="top: 0;"></div>
                            <h3 class="text-brand-yellow font-bold text-xl mb-2">2005</h3>
                            <h4 class="text-2xl font-bold text-gray-900 mb-4">Establishment and Foundation</h4>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                It has established a solid reputation as a result of its substantial contributions throughout the years to the growth of Ethiopia's real estate market. Its ambitious goal is to provide services to several cities in Ethiopia and other African nations.
                            </p>
                        </div>

                        <div class="timeline-container">
                            <div class="timeline-dot" style="top: 0;"></div>
                            <p class="text-gray-600 leading-relaxed">
                                Gift Real Estate is renowned for producing a broad variety of homes that cater to various target market segments. Its offerings to the Addis Ababa market comprise, but are not restricted to, opulent villas, villa apartments, row houses, and apartments that are renowned for being diverse, exquisitely designed, and equipped with all the amenities one could want. Its renown and popularity are mostly due to its emphasis on creating designs for lifestyles and future generations, as well as to fulfilling its promise to build dream homes in the most desirable and practical parts of the city, such the CMC and its environs.
                            </p>
                            <p class="text-gray-600 mt-4">
                                Medhanialem, Teklehaymanot, Atlas Urael, at the nearby Meklit building around 22, Figa, and Siddist Kilo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 relative">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800&q=80" class="w-full rounded-lg shadow-xl" alt="Professional Representative">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="relative py-24 bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
        <div class="container mx-auto px-4 relative z-10">
            <div class="bg-green-500/80 p-12 rounded-lg max-w-xl text-white">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-eye text-brand-yellow"></i>
                    <span class="font-bold tracking-widest uppercase">SEE</span>
                </div>
                <h2 class="text-4xl font-bold mb-6">Our Vision</h2>
                <p class="text-lg leading-relaxed mb-8">
                    Gift Real Estate aspires to be one of the leading real estate companies in East Africa's real estate industry in the next 20 years, known for delivering functionally versatile, esthetically desirable, offering high value for money, modern residential and commercial properties for top, middle, and lower class segments of society in the urban markets in which it will operate.
                </p>
                <a href="/contact" class="bg-brand-yellow text-brand-green font-bold px-8 py-3 rounded inline-block hover:bg-white transition">Contact Us</a>
            </div>
        </div>
        <!-- Logo Overlay -->
        <div class="absolute top-0 right-0 w-1/3 h-full flex items-center justify-center opacity-20 pointer-events-none">
            <img src="/public/assets/logo.png" class="w-2/3" alt="">
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-24 bg-white text-center">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-green-600 text-5xl mb-6">
                <i class="far fa-bookmark"></i>
            </div>
            <h2 class="text-5xl font-bold text-gray-900 mb-8">OUR MISSION</h2>
            <p class="text-gray-600 text-xl leading-relaxed">
                Gift Real Estate PLC's mission is to provide cutting-edge residential and commercial properties that are designed and built specifically to meet the needs of customers, transforming their lifestyle to a higher standard 21st-century lifestyle.
            </p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative py-24 bg-cover bg-center" style="background-image: linear-gradient(rgba(0,128,0,0.7), rgba(0,128,0,0.7)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 text-white">
                <h4 class="text-brand-yellow font-bold uppercase tracking-widest mb-4">GIFT REAL STATES STORY</h4>
                <h2 class="text-4xl font-bold mb-12">Interesting Facts About Our Company</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <div class="text-5xl font-bold mb-2">65</div>
                        <div class="text-gray-200 uppercase text-sm tracking-widest">Properties</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold mb-2">41</div>
                        <div class="text-gray-200 uppercase text-sm tracking-widest">Awards</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold mb-2">17</div>
                        <div class="text-gray-200 uppercase text-sm tracking-widest">Cities</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold mb-2">21</div>
                        <div class="text-gray-200 uppercase text-sm tracking-widest">Years</div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80" class="w-full max-w-md mx-auto rounded-lg shadow-2xl" alt="Founder/CEO">
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-5xl font-bold text-gray-900 text-center mb-16">Core Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Location -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/Google_Maps_icon_%282015-2020%29.svg" class="w-12" alt="Location">
                    </div>
                    <h3 class="text-xl font-bold mb-4">Location</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Discover properties tailored to your lifestyle, offering convenient access to amenities, schools, and transportation hubs.
                    </p>
                </div>
                <!-- Affordable -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2489/2489756.png" class="w-12" alt="Affordable">
                    </div>
                    <h3 class="text-xl font-bold mb-4">Affordable</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Find your dream home without breaking the bank. Our diverse portfolio ensures quality and affordability with transparent pricing and flexible options.
                    </p>
                </div>
                <!-- Quality -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                        <img src="/public/assets/logo.png" class="h-12 object-contain" alt="Quality">
                    </div>
                    <h3 class="text-xl font-bold mb-4">Quality</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Invest confidently in properties that prioritize safety, security, and durability. Rigorous inspections and reputable partnerships ensure lasting value.
                    </p>
                </div>
                <!-- Safety & Security -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2092/2092663.png" class="w-12" alt="Safety">
                    </div>
                    <h3 class="text-xl font-bold mb-4">Safety & Security</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Your safety is our top priority. Explore neighborhoods with excellent security records and properties equipped with essential safety features.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-600 py-6">
        <div class="container mx-auto px-4 text-center text-white">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
