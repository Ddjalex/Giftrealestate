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
    <title>Inquiries - Gift Real Estate PLC</title>
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
                <a href="/"><img src="/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green">
                <a href="/" class="hover:text-brand-yellow">Home</a>
                <a href="/about" class="hover:text-brand-yellow">About</a>
                <a href="/properties" class="hover:text-brand-yellow">Properties</a>
                <a href="/gallery" class="hover:text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/contact" class="text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <header class="relative py-32 bg-cover bg-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/uploads/contact_header.jpg');">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-6xl font-bold text-white mb-4">Contact Us</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow font-medium tracking-widest uppercase">We Love To Hear From You!</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </header>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Contact Info Side -->
                <div class="p-12 bg-brand-green text-white h-full relative overflow-hidden">
                    <div class="relative z-10">
                        <span class="text-brand-yellow font-bold uppercase tracking-widest text-sm">CONTACT US</span>
                        <h2 class="text-5xl font-bold mt-4 mb-8 leading-tight">Need Assistance?<br>Reach Out</h2>
                        
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-yellow/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone-alt text-brand-yellow"></i>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-sm font-bold uppercase mb-1">Our Phone:</p>
                                    <p class="text-xl font-bold text-white">+251 921878641 / +251 941530182</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-yellow/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-brand-yellow"></i>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-sm font-bold uppercase mb-1">Our Mail:</p>
                                    <p class="text-lg font-bold text-white">info@giftrealestateplc.com / giftrealestatemd@gmail.com / giftrealestateofficialmd@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-yellow/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-brand-yellow"></i>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-sm font-bold uppercase mb-1">Our Address:</p>
                                    <p class="text-lg font-bold text-white">Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative building background -->
                    <div class="absolute bottom-0 right-0 opacity-10 pointer-events-none transform translate-x-1/4 translate-y-1/4">
                        <i class="fas fa-city text-[300px]"></i>
                    </div>
                </div>

                <!-- Form Side -->
                <div class="p-12">
                    <form id="inquiry-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Name</label>
                                <input type="text" name="name" placeholder="Name" class="w-full p-4 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-brand-green" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Email</label>
                                <input type="email" name="email" placeholder="Email" class="w-full p-4 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-brand-green" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Message</label>
                            <textarea name="message" placeholder="Write your message here..." class="w-full p-4 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-brand-green h-48" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-brand-yellow text-brand-green font-bold py-5 rounded-xl hover:bg-yellow-500 transition shadow-xl uppercase tracking-widest text-sm">Let's Get Started</button>
                    </form>
                    <div id="form-status" class="mt-6 text-center hidden"></div>
                </div>
            </div>

            <!-- Offices Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="h-64 rounded-2xl overflow-hidden mb-6">
                        <img src="/uploads/properties_header.jpg" class="w-full h-full object-cover" alt="Office 1">
                    </div>
                    <h3 class="text-xl font-bold text-brand-green mb-4">Gift Real Estate PLC, Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia</h3>
                    <p class="text-gray-500 mb-2 font-bold uppercase text-xs">Our Phone:</p>
                    <p class="text-brand-green font-bold">+251 921878641</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="h-64 rounded-2xl overflow-hidden mb-6">
                        <img src="/uploads/gallery_header.jpg" class="w-full h-full object-cover" alt="Office 2">
                    </div>
                    <h3 class="text-xl font-bold text-brand-green mb-4">Gift Real Estate PLC, Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia</h3>
                    <p class="text-gray-500 mb-2 font-bold uppercase text-xs">Our Phone:</p>
                    <p class="text-brand-green font-bold">+251 921878641</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="h-64 rounded-2xl overflow-hidden mb-6">
                        <img src="/uploads/contact_header.jpg" class="w-full h-full object-cover" alt="Office 3">
                    </div>
                    <h3 class="text-xl font-bold text-brand-green mb-4">Gift Real Estate PLC, Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia</h3>
                    <p class="text-gray-500 mb-2 font-bold uppercase text-xs">Our Phone:</p>
                    <p class="text-brand-green font-bold">+251 921878641</p>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-20 rounded-3xl overflow-hidden shadow-2xl h-[500px]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.55132717833!2d38.7754399!3d9.0133469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b850029b35203%3A0x60edb20360edb203!2sGift%20Real%20Estate!5e0!3m2!1sen!2set!4v1642100000000!5m2!1sen!2set" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('inquiry-form').onsubmit = async (e) => {
            e.preventDefault();
            const status = document.getElementById('form-status');
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/inquiries', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    status.innerText = 'Thank you! Your inquiry has been sent.';
                    status.className = 'mt-6 text-center text-green-600 font-bold';
                    e.target.reset();
                } else {
                    status.innerText = 'Sorry, something went wrong. Please try again.';
                    status.className = 'mt-6 text-center text-red-600 font-bold';
                }
                status.classList.remove('hidden');
            } catch (err) {
                console.error(err);
            }
        };
    </script>
</body>
</html>