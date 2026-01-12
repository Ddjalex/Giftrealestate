<?php
require_once 'api/db.php';
global $pdo;

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->execute([$id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    header('Location: /');
    exit;
}

// Fetch settings for contact info
$stmt = $pdo->query("SELECT `key`, `value` FROM settings");
$settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
$contactPhone = $settings['phone'] ?? '';

$gallery = [];
if ($property['gallery_images']) {
    $parsed = json_decode($property['gallery_images'], true);
    $gallery = is_array($parsed) ? $parsed : [$parsed];
} else {
    $gallery = [$property['main_image']];
}

$images = array_map(function($img) {
    if (!$img) return 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80';
    if (strpos($img, '/') === 0 || strpos($img, 'http') === 0) return $img;
    return '/uploads/' . $img;
}, $gallery);

?>
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
    <meta name="description" content="<?php echo htmlspecialchars(substr($property['description'], 0, 160)); ?>">
    <meta name="keywords" content="Real Estate Property Addis Ababa, <?php echo htmlspecialchars($property['property_type']); ?>, <?php echo htmlspecialchars($property['title']); ?>, for sale Addis Ababa, Gift Real Estate Legehar, Leghar apartments">
    <link rel="canonical" href="https://realestatepropertyaddis.com/property.php?id=<?php echo $property['id']; ?>">
    <meta name="robots" content="index, follow">
    <title><?php echo htmlspecialchars($property['title']); ?> | Gift Real Estate PLC Addis Ababa</title>
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://realestatepropertyaddis.com/property.php?id=<?php echo $property['id']; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($property['title']); ?> | Gift Real Estate PLC">
    <meta property="og:description" content="<?php echo htmlspecialchars(substr($property['description'], 0, 160)); ?>">
    <meta property="og:image" content="https://realestatepropertyaddis.com/uploads/<?php echo $property['main_image']; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://realestatepropertyaddis.com/property.php?id=<?php echo $property['id']; ?>">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($property['title']); ?> | Gift Real Estate PLC">
    <meta property="twitter:description" content="<?php echo htmlspecialchars(substr($property['description'], 0, 160)); ?>">
    <meta property="twitter:image" content="https://realestatepropertyaddis.com/uploads/<?php echo $property['main_image']; ?>">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "RealEstateListing",
      "name": "<?php echo htmlspecialchars($property['title']); ?>",
      "description": "<?php echo htmlspecialchars(substr($property['description'], 0, 200)); ?>",
      "url": "https://realestatepropertyaddis.com/property.php?id=<?php echo $property['id']; ?>",
      "image": "https://realestatepropertyaddis.com/uploads/<?php echo $property['main_image']; ?>",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?php echo htmlspecialchars($property['location']); ?>",
        "addressCountry": "ET"
      },
      "offers": {
        "@type": "Offer",
        "priceCurrency": "ETB",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "Gift Real Estate PLC"
        }
      }
    }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --brand-green: #008148; --brand-yellow: #fdd835; }
        .bg-brand-green { background-color: var(--brand-green); }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-yellow { background-color: var(--brand-yellow); }

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
            border-left: 4px solid var(--brand-green);
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
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle text-red-500' : 'fa-check-circle text-brand-green'}"></i>
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
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Simple Nav -->
    <nav class="bg-white shadow-sm h-20 flex items-center">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/"><img src="/assets/logo.png" alt="Logo" class="h-12"></a>
            <a href="/" class="text-brand-green font-bold uppercase tracking-wider">Back to Home</a>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-2/3">
                <div class="relative h-[500px] rounded-3xl overflow-hidden mb-6 group bg-gray-200">
                    <div class="flex h-full transition-transform duration-500" id="main-slider">
                        <?php foreach ($images as $img): ?>
                            <img src="<?php echo $img; ?>" class="w-full h-full object-cover flex-shrink-0" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80'">
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($images) > 1): ?>
                        <button onclick="moveSlider(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 p-4 rounded-full shadow-xl hover:bg-white z-10">
                            <i class="fas fa-chevron-left text-brand-green"></i>
                        </button>
                        <button onclick="moveSlider(1)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 p-4 rounded-full shadow-xl hover:bg-white z-10">
                            <i class="fas fa-chevron-right text-brand-green"></i>
                        </button>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mb-10">
                    <?php foreach ($images as $i => $img): ?>
                        <div class="h-24 w-full relative group">
                            <img src="<?php echo $img; ?>" onclick="setSlide(<?php echo $i; ?>)" class="h-full w-full object-cover rounded-xl cursor-pointer hover:opacity-80 transition border-2 <?php echo $i === 0 ? 'border-brand-green' : 'border-transparent'; ?>" data-thumb="<?php echo $i; ?>" onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80'">
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm font-bold text-gray-400 uppercase"><?php echo htmlspecialchars($property['property_type']); ?></span>
                        <i class="fas fa-chevron-right text-xs text-gray-300"></i>
                        <span class="text-sm text-gray-500"><?php echo htmlspecialchars($property['title']); ?></span>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-6"><?php echo htmlspecialchars($property['title']); ?></h1>
                    <div class="text-brand-green text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="fas fa-tag"></i> Call for price
                    </div>

                    <div class="grid grid-cols-3 gap-6 py-6 border-y border-gray-50 mb-8 text-center">
                        <div>
                            <div class="text-gray-400 text-xs uppercase font-bold mb-1">Bedrooms</div>
                            <div class="text-xl font-bold text-gray-800"><?php echo $property['bedrooms']; ?></div>
                        </div>
                        <div>
                            <div class="text-gray-400 text-xs uppercase font-bold mb-1">Bathrooms</div>
                            <div class="text-xl font-bold text-gray-800"><?php echo $property['bathrooms']; ?></div>
                        </div>
                        <div>
                            <div class="text-gray-400 text-xs uppercase font-bold mb-1">Area</div>
                            <div class="text-xl font-bold text-gray-800"><?php echo $property['area_sqft']; ?> sq ft</div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex justify-between items-center mb-6 cursor-pointer group" onclick="toggleSection('description')">
                            <h3 class="text-2xl font-bold">Description</h3>
                            <span id="desc-toggle-text" class="text-brand-green font-bold text-sm flex items-center gap-2">
                                Hide description <i class="fas fa-chevron-up transition-transform duration-300" id="desc-chevron"></i>
                            </span>
                        </div>
                        <div id="description-content" class="text-gray-600 leading-relaxed whitespace-pre-line transition-all duration-300 overflow-hidden">
                            <?php echo nl2br(htmlspecialchars($property['description'])); ?>
                        </div>
                        <div class="border-b border-gray-100 mt-6"></div>
                    </div>

                    <div class="mb-10">
                        <div class="flex justify-between items-center mb-6 cursor-pointer group" onclick="toggleSection('amenities')">
                            <h3 class="text-2xl font-bold">Amenities & Features</h3>
                            <span id="amen-toggle-text" class="text-brand-green font-bold text-sm flex items-center gap-2">
                                Hide amenities <i class="fas fa-chevron-up transition-transform duration-300" id="amen-chevron"></i>
                            </span>
                        </div>
                        <div id="amenities-content" class="grid grid-cols-2 md:grid-cols-3 gap-4 transition-all duration-300 overflow-hidden">
                            <?php 
                            $amenities = json_decode($property['amenities'] ?? '[]', true);
                            if (empty($amenities)) {
                                $amenities = ['Air conditioning', 'Free WiFi', 'Elevator', 'Gym', 'Parking', 'Security'];
                            }
                            foreach ($amenities as $amenity): 
                                $icon = 'fa-check';
                                $lowerAmenity = strtolower($amenity);
                                if (strpos($lowerAmenity, 'air') !== false) $icon = 'fa-snowflake';
                                elseif (strpos($lowerAmenity, 'wifi') !== false || strpos($lowerAmenity, 'internet') !== false) $icon = 'fa-wifi';
                                elseif (strpos($lowerAmenity, 'elevator') !== false) $icon = 'fa-elevator';
                                elseif (strpos($lowerAmenity, 'gym') !== false) $icon = 'fa-dumbbell';
                                elseif (strpos($lowerAmenity, 'parking') !== false) $icon = 'fa-parking';
                                elseif (strpos($lowerAmenity, 'security') !== false) $icon = 'fa-shield-alt';
                                elseif (strpos($lowerAmenity, 'pool') !== false) $icon = 'fa-swimming-pool';
                                elseif (strpos($lowerAmenity, 'garden') !== false) $icon = 'fa-leaf';
                            ?>
                                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl text-gray-700">
                                    <i class="fas <?php echo $icon; ?> text-brand-green"></i> <?php echo htmlspecialchars($amenity); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/3">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 sticky top-24">
                    <h3 class="text-2xl font-bold mb-6">Inquire Property</h3>
                    <form id="inquiry-form" class="space-y-4">
                        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Full Name*</label>
                            <input type="text" name="name" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-brand-green outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Email*</label>
                            <input type="email" name="email" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-brand-green outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" name="phone" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-brand-green outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Message*</label>
                            <textarea name="message" required class="w-full p-4 bg-gray-50 border-none rounded-2xl h-32 focus:ring-2 focus:ring-brand-green outline-none">I am interested in "<?php echo htmlspecialchars($property['title']); ?>"</textarea>
                        </div>
                        <button type="submit" class="w-full bg-brand-green text-white font-bold py-5 rounded-2xl hover:bg-opacity-90 transition shadow-lg mt-4 text-lg">
                            SEND MESSAGE
                        </button>
                    </form>

                    <div class="mt-8 flex gap-4">
                        <a id="detail-call-btn" href="tel:<?php echo $contactPhone; ?>" class="flex-1 bg-gray-100 text-gray-800 text-center py-4 rounded-2xl font-bold hover:bg-gray-200 transition flex items-center justify-center gap-2">
                            <i class="fas fa-phone-alt"></i> <?php echo $contactPhone ? 'Call' : '...'; ?>
                        </a>
                        <a id="detail-whatsapp-btn" href="https://wa.me/<?php 
                            $waPhone = preg_replace('/[^0-9]/', '', $contactPhone);
                            if (strlen($waPhone) === 10 && $waPhone[0] === '0') {
                                $waPhone = '251' . substr($waPhone, 1);
                            } elseif (strlen($waPhone) === 9) {
                                $waPhone = '251' . $waPhone;
                            }
                            echo $waPhone; 
                        ?>" target="_blank" class="flex-1 bg-[#25D366] text-white text-center py-4 rounded-2xl font-bold hover:bg-opacity-90 transition flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        let currentSlide = 0;
        const slidesCount = <?php echo count($images); ?>;

        function moveSlider(dir) {
            currentSlide = (currentSlide + dir + slidesCount) % slidesCount;
            updateSlider();
        }

        function setSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function updateSlider() {
            const slider = document.getElementById('main-slider');
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            document.querySelectorAll('[data-thumb]').forEach((thumb, i) => {
                thumb.classList.toggle('border-brand-green', i === currentSlide);
                thumb.classList.toggle('border-transparent', i !== currentSlide);
            });
        }

        function toggleSection(section) {
            const content = document.getElementById(`${section}-content`);
            const chevron = document.getElementById(`${section === 'description' ? 'desc' : 'amen'}-chevron`);
            const toggleText = document.getElementById(`${section === 'description' ? 'desc' : 'amen'}-toggle-text`);
            const isHidden = content.classList.contains('hidden');

            if (isHidden) {
                content.classList.remove('hidden');
                chevron.classList.remove('rotate-180');
                toggleText.innerHTML = `Hide ${section} <i class="fas fa-chevron-up transition-transform duration-300" id="${section === 'description' ? 'desc' : 'amen'}-chevron"></i>`;
            } else {
                content.classList.add('hidden');
                chevron.classList.add('rotate-180');
                toggleText.innerHTML = `Show ${section} <i class="fas fa-chevron-up rotate-180 transition-transform duration-300" id="${section === 'description' ? 'desc' : 'amen'}-chevron"></i>`;
            }
        }

        document.getElementById('inquiry-form').onsubmit = async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            // Format WhatsApp Message
            const whatsappMessage = `New Property Inquiry:\n` +
                `Property: <?php echo addslashes($property['title']); ?>\n` +
                `Property Link: ${window.location.href}\n` +
                `Name: ${data.name}\n` +
                `Email: ${data.email}\n` +
                `Phone: ${data.phone || 'N/A'}\n` +
                `Message: ${data.message}`;
            
            const whatsappNumber = "<?php 
                $waPhone = preg_replace('/[^0-9]/', '', $contactPhone);
                if (strlen($waPhone) === 10 && $waPhone[0] === '0') {
                    $waPhone = '251' . substr($waPhone, 1);
                } elseif (strlen($waPhone) === 9) {
                    $waPhone = '251' . $waPhone;
                }
                echo $waPhone; 
            ?>";
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`;
            
            try {
                const res = await fetch('api/inquiries.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                if (res.ok) {
                    // Reverting to direct link method for reliability in "normal mode"
                    window.location.href = whatsappUrl;
                } else {
                    alert('We encountered an error while processing your inquiry. Please try contacting us via WhatsApp directly.');
                }
            } catch (err) {
                console.error('Network error:', err);
                window.location.href = whatsappUrl;
            }
        };
    </script>
</body>
</html>