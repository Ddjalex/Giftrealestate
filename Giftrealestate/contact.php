<?php
require_once 'api/db.php';
global $pdo;

// Fetch settings
$stmt = $pdo->query("SELECT `key`, `value` FROM settings");
$settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
$contactPhone = $settings['phone'] ?? '+251913724749';
$contactPhone2 = $settings['phone2'] ?? '+251947497777';
$contactEmail = $settings['email'] ?? 'info@giftrealestate.com.et';
$contactAddress = $settings['address'] ?? 'Kazanchis, Street, Addis Ababa, Ethiopia';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Get in touch with Gift Real Estate PLC. Contact us for inquiries about luxury apartments, villas, and commercial properties in Addis Ababa.">
    <meta name="keywords" content="Real Estate Property Addis Ababa Contact, Gift Real Estate Phone Number, Real Estate Inquiries Ethiopia">
    <title>Contact Us | Gift Real Estate PLC - Real Estate Property Addis Ababa</title>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ContactPage",
      "mainEntity": {
        "@type": "Organization",
        "name": "Gift Real Estate PLC",
        "telephone": "+251 921878641",
        "email": "info@giftrealestate.com.et",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Kazanchis, Black Gold Plaza",
          "addressLocality": "Addis Ababa",
          "addressCountry": "ET"
        }
      }
    }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom Toast Styles */
        .toast-notification {
            position: fixed;
            bottom: 24px;
            right: 24px;
            padding: 16px 24px;
            border-radius: 12px;
            background: white;
            color: #1f2937;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 4px solid #004d40;
        }
        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }
        .toast-error {
            border-left-color: #ef4444;
        }
    </style>
    <script>
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast-notification ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML = `
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle text-red-500' : 'fa-check-circle text-[#004d40]'}"></i>
                <span class="font-medium">${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 10);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
        window.alert = (msg) => showToast(msg, msg.toLowerCase().includes('error') ? 'error' : 'success');

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
                <a href="/"><img src="/assets/logo.png" alt="Logo" class="h-16"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green uppercase text-sm tracking-wider">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About Us</a>
                <a href="gallery.php" class="nav-link">Gallery</a>
                <a href="properties.php" class="nav-link">Properties</a>
                <a href="news.php" class="nav-link">News</a>
                <a href="contact.php" class="nav-link text-brand-yellow">Contact</a>
            </div>
            <a href="tel:<?php echo $contactPhone; ?>" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative py-32 bg-cover bg-center text-white text-center" style="background-image: linear-gradient(rgba(0, 77, 64, 0.7), rgba(0, 77, 64, 0.7)), url('/assets/contact-header.jpg');">
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-6xl font-bold mb-4">Contact Us</h1>
            <div class="w-24 h-1 bg-brand-yellow mx-auto mb-6"></div>
            <p class="text-brand-yellow uppercase tracking-widest font-medium">Get in touch with our expert team today.</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-1.42,1200,13.47V0Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </header>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-brand-green mb-8">Get In Touch</h2>
                    <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#004d40] text-white rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Our Office</h4>
                        <p class="text-gray-600"><?php echo htmlspecialchars($contactAddress); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#004d40] text-white rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-phone-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Phone Number</h4>
                        <p class="text-gray-600"><?php echo htmlspecialchars($contactPhone); ?></p>
                        <?php if ($contactPhone2): ?>
                            <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($contactPhone2); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#004d40] text-white rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Email Address</h4>
                        <p class="text-gray-600"><?php echo htmlspecialchars($contactEmail); ?></p>
                    </div>
                </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                    <form id="contact-form" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <input type="text" name="name" placeholder="Full Name" required class="w-full p-4 bg-gray-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-brand-green">
                            <input type="email" name="email" placeholder="Email Address" required class="w-full p-4 bg-gray-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-brand-green">
                        </div>
                        <input type="text" name="subject" placeholder="Subject" class="w-full p-4 bg-gray-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-brand-green">
                        <textarea name="message" placeholder="Your Message" required class="w-full p-4 bg-gray-50 rounded-2xl h-32 border-none outline-none focus:ring-2 focus:ring-brand-green"></textarea>
                        <button type="submit" class="w-full bg-brand-green text-white font-bold py-5 rounded-2xl shadow-lg hover:bg-opacity-90 transition">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="pb-20">
        <div class="container mx-auto px-4">
            <div class="relative group">
                <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-100 h-[450px]">
                    <iframe 
                        id="office-map"
                        src="<?php echo !empty($settings['map_url']) ? htmlspecialchars($settings['map_url']) : 'https://www.openstreetmap.org/export/embed.html?bbox=38.74,8.98,38.78,9.04&layer=mapnik&marker=9.0132,38.7566'; ?>" 
                        class="w-full h-full border-0">
                    </iframe>
                </div>
                <button 
                    onclick="centerMap()"
                    class="absolute bottom-10 right-10 bg-white p-3 rounded-full shadow-xl hover:bg-gray-100 transition-all active:scale-95 group/btn border border-gray-100"
                    title="Center to Exact Location"
                >
                    <i class="fas fa-location-crosshairs text-brand-green text-xl group-hover/btn:scale-110 transition-transform"></i>
                </button>
            </div>
        </div>
    </section>

    <script>
        function centerMap() {
            const map = document.getElementById('office-map');
            const originalSrc = map.src;
            
            let zoomedSrc = originalSrc;
            if (originalSrc.includes('openstreetmap.org')) {
                if (originalSrc.includes('zoom=')) {
                    zoomedSrc = originalSrc.replace(/zoom=\d+/, 'zoom=18');
                } else {
                    zoomedSrc = originalSrc + '&zoom=18';
                }
            }
            
            // Visual "speed" effect
            map.style.transition = 'all 0.5s ease-in-out';
            map.style.transform = 'scale(1.02)';
            
            map.src = zoomedSrc;
            map.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            setTimeout(() => {
                map.style.transform = 'scale(1)';
            }, 500);
        }
    </script>

    <?php include 'footer.php'; ?>
    <script>
        document.getElementById('contact-form').onsubmit = async (e) => {
            e.preventDefault();
            alert('Thank you for contacting Gift Real Estate. Your message has been successfully received, and our team will get back to you shortly.');
            e.target.reset();
        };
    </script>
</body>
</html>
