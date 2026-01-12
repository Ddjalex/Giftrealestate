<?php
// Shared Footer Component
?>
<section id="contact" class="bg-[#32CD32]">
    <footer class="text-white pt-20 pb-10 relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="assets/aerial-view.jpg" class="w-full h-full object-cover" alt="Footer Background">
            <div class="absolute inset-0 bg-[#32CD32] opacity-60"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 items-start">
                <!-- Brand -->
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <img src="assets/logo.png" alt="Gift Real Estate Logo" class="h-24 object-contain mb-6 bg-white/10 p-2 rounded-xl">
                    <h4 class="text-lg font-bold mb-4 uppercase tracking-widest">Our Location</h4>
                    <p id="footer-address-brand" class="text-white text-sm mb-6 leading-relaxed">
                        Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia
                    </p>
                </div>
                
                <!-- Property Types -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest">Property Types</h4>
                    <ul class="space-y-4 text-white text-sm">
                        <li><a href="/properties?type=Residential+Apartments" class="hover:underline transition">Residential Apartments</a></li>
                        <li><a href="/properties?type=Commercial+Properties" class="hover:underline transition">Commercial Properties</a></li>
                        <li><a href="/properties?type=Luxury+Villas" class="hover:underline transition">Luxury Villas</a></li>
                        <li><a href="/properties?type=Office+Spaces" class="hover:underline transition">Office Spaces</a></li>
                        <li><a href="/properties?type=Retail+Shops" class="hover:underline transition">Retail Shops</a></li>
                        <li><a href="/properties?type=Land+%26+Plots" class="hover:underline transition">Land & Plots</a></li>
                    </ul>
                </div>
                
                <!-- Services Offered -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest">Services Offered</h4>
                    <ul class="space-y-4 text-white text-sm">
                        <li><a href="#" class="hover:underline transition">Property Sales</a></li>
                        <li><a href="#" class="hover:underline transition">Property Rental</a></li>
                        <li><a href="#" class="hover:underline transition">Property Management</a></li>
                        <li><a href="#" class="hover:underline transition">Investment Consultation</a></li>
                        <li><a href="#" class="hover:underline transition">Property Valuation</a></li>
                        <li><a href="#" class="hover:underline transition">Market Analysis</a></li>
                    </ul>
                </div>

                <!-- Contact Details -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest">Our Location</h4>
                    <ul class="space-y-6 text-white text-sm">
                        <li class="text-white">
                            Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia
                        </li>
                        <li class="flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone-alt"></i>
                                <span id="footer-phone">+251 913724749</span>
                            </div>
                            <div class="flex items-center gap-3 hidden">
                                <i class="fas fa-phone-alt"></i>
                                <span id="footer-phone2"></span>
                            </div>
                        </li>
                        <li class="relative">
                            <form id="newsletter-form" class="flex gap-0">
                                <input type="email" id="newsletter-email" placeholder="Enter your email" required class="flex-1 bg-white p-3 rounded-l-lg text-gray-800 focus:outline-none h-12">
                                <button type="submit" class="bg-[#5D5DFF] text-white px-6 py-3 rounded-r-lg font-bold hover:bg-blue-700 transition h-12 uppercase text-sm">SUBSCRIBE</button>
                            </form>
                            <div id="newsletter-msg" class="text-sm mt-3 text-white font-bold bg-[#008148] p-4 rounded-xl shadow-lg border-2 border-[#fdd835] hidden transition-all duration-300 transform scale-95 opacity-0"></div>
                        </li>
                        <li>
                            <p class="font-bold uppercase tracking-widest text-xs mb-4">Follow Us</p>
                            <div class="flex gap-4">
                                <a id="social-facebook" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-facebook-f"></i></a>
                                <a id="social-tiktok" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-tiktok"></i></a>
                                <a id="social-instagram" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-instagram"></i></a>
                                <a id="social-telegram" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-telegram"></i></a>
                                <a id="social-linkedin" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-linkedin-in"></i></a>
                                <a id="social-x" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-x-twitter"></i></a>
                                <a id="social-youtube" href="#" class="w-8 h-8 rounded border border-white flex items-center justify-center hover:bg-white hover:text-[#32CD32] transition"><i class="fab fa-youtube"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center gap-4 text-white text-sm">
                <p>Copyright &copy; <?php echo date('Y'); ?> Gift Real Estate PLC</p>
                <a href="https://neodigitalsolutions.com/" target="_blank" class="flex items-center gap-2 hover:opacity-80 transition">
                    <span class="text-xs uppercase tracking-widest opacity-80">Powered by</span>
                    <img src="assets/neo-logo.png" alt="Neo Digital Solutions" class="h-8 md:h-10 object-contain brightness-0 invert">
                </a>
            </div>
        </div>
    </footer>
</section>
<script>
    async function loadSettings() {
        try {
            const response = await fetch('/api/settings.php');
            const settings = await response.json();
            
            // Shared Data Updates
            const phone = settings.phone || '+251913724749';
            const phone2 = settings.phone2;
            const address = settings.address || 'Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia';
            const whatsapp = settings.whatsapp || settings.phone || '+251913724749';

            // Update Header/Top Bar (if elements exist)
            const topBarAddr = document.getElementById('top-bar-address');
            if (topBarAddr) topBarAddr.innerHTML = `<i class="fas fa-map-marker-alt text-brand-yellow mr-2"></i>${address}`;
            
            const topBarPhone = document.getElementById('top-bar-phone');
            if (topBarPhone) {
                let html = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${phone}`;
                if (phone2) html += ` | <i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${phone2}`;
                topBarPhone.innerHTML = html;
            }

            const statsPhone = document.getElementById('stats-phone');
            if (statsPhone) statsPhone.innerText = phone;

            // Update Socials
            const socialMapping = {
                'facebook': ['social-facebook', 'top-social-facebook'],
                'telegram': ['social-telegram', 'top-social-telegram'],
                'instagram': ['social-instagram', 'top-social-instagram'],
                'linkedin': ['social-linkedin', 'top-social-linkedin'],
                'tiktok': ['social-tiktok'],
                'youtube': ['social-youtube'],
                'x': ['social-x']
            };

            Object.entries(socialMapping).forEach(([key, ids]) => {
                if (settings[key]) {
                    ids.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.href = settings[key];
                            el.classList.remove('hidden');
                        }
                    });
                } else {
                    // Hide icons if not set in admin
                    ids.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('hidden');
                    });
                }
            });

            // Update Footer
            const footerAddr = document.getElementById('footer-address');
            if (footerAddr) footerAddr.innerText = address;
            
            const footerAddrBrand = document.getElementById('footer-address-brand');
            if (footerAddrBrand) footerAddrBrand.innerText = address;
            
            const footerPhone = document.getElementById('footer-phone');
            if (footerPhone) footerPhone.innerText = phone;
            
            const footerPhone2 = document.getElementById('footer-phone2');
            if (footerPhone2 && phone2) {
                footerPhone2.innerText = phone2;
                footerPhone2.parentElement.classList.remove('hidden');
            }

            // Update Contact Detail Links (Call & WhatsApp)
            const detailCall = document.getElementById('detail-call-btn');
            if (detailCall) detailCall.href = `tel:${phone}`;
            
            const detailWhatsapp = document.getElementById('detail-whatsapp-btn');
            if (detailWhatsapp) {
                const cleanWA = whatsapp.replace(/\+/g, '').replace(/\s/g, '');
                detailWhatsapp.href = `https://wa.me/${cleanWA}`;
            }

            // Update Nav/Mobile Call Buttons
            const navCall = document.getElementById('nav-call-btn');
            if (navCall) navCall.href = `tel:${phone}`;
            
            const mobileCall = document.querySelector('a[href^="tel:"]'); // First tel link usually mobile call
            if (mobileCall && mobileCall.classList.contains('bg-brand-green')) {
                mobileCall.href = `tel:${phone}`;
            }

            // Update stats phone on index
            const statsPhone = document.getElementById('stats-phone');
            if (statsPhone) statsPhone.innerText = phone;
            
            const statsPhoneLink = document.getElementById('stats-phone-link');
            if (statsPhoneLink) statsPhoneLink.href = `tel:${phone}`;

            // Newsletter Logic
            const newsForm = document.getElementById('newsletter-form');
            if (newsForm) {
                newsForm.onsubmit = async (e) => {
                    e.preventDefault();
                    const email = document.getElementById('newsletter-email').value;
                    const msgEl = document.getElementById('newsletter-msg');
                    
                    try {
                        const res = await fetch('/api/subscribe.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ email })
                        });
                        const data = await res.json();
                        
                        msgEl.innerText = data.success ? "Thanks for subscribing! Now you can get any updates by email." : data.message;
                        msgEl.classList.remove('hidden');
                        // Force reflow
                        msgEl.offsetHeight;
                        msgEl.classList.add('scale-100', 'opacity-100');
                        
                        if (data.success) {
                            newsForm.style.display = 'none';
                            newsForm.reset();
                        }
                    } catch (err) {
                        msgEl.innerText = 'Something went wrong. Please try again.';
                        msgEl.classList.remove('hidden');
                        msgEl.classList.add('scale-100', 'opacity-100', 'bg-red-600');
                    }
                    
                    setTimeout(() => {
                        msgEl.classList.remove('scale-100', 'opacity-100');
                        setTimeout(() => msgEl.classList.add('hidden'), 300);
                    }, 5000);
                };
            }

        } catch (e) {
            console.error('Failed to load settings', e);
        }
    }
    loadSettings();
</script>
