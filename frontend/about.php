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
                <a href="/about" class="text-brand-yellow">About</a>
                <a href="/properties" class="hover:text-brand-yellow">Properties</a>
                <a href="/gallery" class="hover:text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/inquiries" class="hover:text-brand-yellow">Inquiries</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-brand-green py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About Gift Real Estate PLC</h1>
            <p class="text-xl text-brand-yellow max-w-3xl mx-auto">Building the future of Ethiopia with integrity, innovation, and excellence for over 25 years.</p>
        </div>
    </header>

    <!-- Content -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-brand-green mb-6">Our Legacy</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Gift Real Estate PLC is one of the leading real estate developers in Ethiopia. For more than two decades, we have been dedicated to providing high-quality residential and commercial properties that meet the evolving needs of our customers.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Our commitment to excellence has made us a household name in the Ethiopian real estate market. We pride ourselves on our professional approach, timely delivery, and the superior quality of our constructions.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-4 bg-white rounded-lg shadow-sm border-l-4 border-brand-yellow">
                            <div class="text-2xl font-bold text-brand-green">25+</div>
                            <div class="text-sm text-gray-500">Years Experience</div>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm border-l-4 border-brand-yellow">
                            <div class="text-2xl font-bold text-brand-green">3000+</div>
                            <div class="text-sm text-gray-500">Happy Homeowners</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80" class="rounded-2xl shadow-2xl" alt="Modern Building">
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-brand-yellow/10 rounded-full -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission/Vision -->
    <section class="py-20 bg-brand-green text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div>
                    <div class="w-16 h-16 bg-brand-yellow/20 text-brand-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                    <p class="text-gray-300">To be the most preferred and reliable real estate developer in Ethiopia and beyond, setting new standards in the industry.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-brand-yellow/20 text-brand-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                    <p class="text-gray-300">To provide quality residential and commercial buildings at competitive prices while ensuring maximum satisfaction for our clients.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-brand-yellow/20 text-brand-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Our Values</h3>
                    <p class="text-gray-300">Integrity, Quality, Commitment, and Customer Satisfaction are the cornerstones of everything we do at Gift Real Estate.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-green text-white py-12 border-t border-white/10">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>