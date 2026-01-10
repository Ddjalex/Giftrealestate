<?php
// Shared Footer Component
?>
<section id="contact" class="bg-brand-green">
    <footer class="text-white pt-20 pb-10 relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 opacity-20">
            <img src="/uploads/contact_header.jpg" class="w-full h-full object-cover" alt="Footer Background">
            <div class="absolute inset-0 bg-brand-green"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-24 object-contain mb-6 bg-white p-2 rounded-xl">
                    <p id="footer-about" class="text-gray-200 text-sm mb-6 leading-relaxed">
                        Gift Real Estate PLC is one of the pioneering real estate companies in Ethiopia, building dream homes since 2005.
                    </p>
                    <div class="flex space-x-4">
                        <a id="social-facebook" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-facebook-f"></i></a>
                        <a id="social-tiktok" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-tiktok"></i></a>
                        <a id="social-instagram" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-instagram"></i></a>
                        <a id="social-telegram" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-telegram"></i></a>
                        <a id="social-linkedin" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-linkedin-in"></i></a>
                        <a id="social-x" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-x-twitter"></i></a>
                        <a id="social-youtube" href="#" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-yellow hover:text-brand-green transition"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Property Types -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest border-b border-brand-yellow/30 pb-2">Property Types</h4>
                    <ul class="space-y-4 text-gray-200 text-sm">
                        <li><a href="/properties?type=Residential+Apartments" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Residential Apartments</a></li>
                        <li><a href="/properties?type=Commercial+Properties" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Commercial Properties</a></li>
                        <li><a href="/properties?type=Luxury+Villas" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Luxury Villas</a></li>
                        <li><a href="/properties?type=Office+Spaces" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Office Spaces</a></li>
                        <li><a href="/properties?type=Retail+Shops" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Retail Shops</a></li>
                        <li><a href="/properties?type=Land+%26+Plots" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Land & Plots</a></li>
                    </ul>
                </div>
                
                <!-- Services Offered -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest border-b border-brand-yellow/30 pb-2">Services Offered</h4>
                    <ul class="space-y-4 text-gray-200 text-sm">
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Property Sales</a></li>
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Property Rental</a></li>
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Property Management</a></li>
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Investment Consultation</a></li>
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Property Valuation</a></li>
                        <li><a href="#" class="hover:text-brand-yellow transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-yellow"></i> Market Analysis</a></li>
                    </ul>
                </div>

                <!-- Contact Details -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest border-b border-brand-yellow/30 pb-2">Our Location</h4>
                    <ul class="space-y-6 text-gray-200 text-sm">
                        <li class="flex items-start gap-4">
                            <i class="fas fa-map-marker-alt mt-1 text-brand-yellow"></i>
                            <span id="footer-address">Kazanchis, Black Gold Plaza, Guinea Conakry Street, Addis Ababa, Ethiopia</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-phone-alt text-brand-yellow"></i>
                                    <span id="footer-phone">+251 921878641</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-phone-alt text-brand-yellow"></i>
                                    <span>+251 941530182</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex gap-2">
                                <input type="email" placeholder="Enter your email" class="flex-1 bg-white p-3 rounded-lg text-gray-800 focus:outline-none">
                                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition">SUBSCRIBE</button>
                            </div>
                        </li>
                        <li>
                            <p class="font-bold uppercase tracking-widest text-xs mb-4">Follow Us</p>
                            <div class="flex gap-3">
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-tiktok"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-telegram"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-x-twitter"></i></a>
                                <a href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-youtube"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-white/10 text-center text-gray-300 text-sm">
                <p>Copyright &copy; <?php echo date('Y'); ?> Gift Real Estate PLC</p>
            </div>
        </div>
    </footer>
</section>
<script>
    async function loadSettings() {
        try {
            const response = await fetch('/api/settings');
            const settings = await response.json();
            if (settings.address) {
                const footerAddr = document.getElementById('footer-address');
                if (footerAddr) footerAddr.innerText = settings.address;
                const topBarAddress = document.querySelector('.bg-brand-green.text-white span');
                if (topBarAddress) topBarAddress.innerHTML = `<i class="fas fa-map-marker-alt text-brand-yellow mr-2"></i>${settings.address}`;
            }
            if (settings.phone) {
                const footerPhone = document.getElementById('footer-phone');
                if (footerPhone) footerPhone.innerText = settings.phone;
                const topBarPhone = document.querySelectorAll('.bg-brand-green.text-white span')[1];
                if (topBarPhone) topBarPhone.innerHTML = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${settings.phone}`;
            }
            if (settings.email) {
                const footerEmail = document.getElementById('footer-email');
                if (footerEmail) footerEmail.innerText = settings.email;
            }
            if (settings.facebook) {
                const socialFB = document.getElementById('social-facebook');
                if (socialFB) socialFB.href = settings.facebook;
            }
            if (settings.telegram) {
                const socialTG = document.getElementById('social-telegram');
                if (socialTG) socialTG.href = settings.telegram;
            }
            if (settings.instagram) {
                const socialIG = document.getElementById('social-instagram');
                if (socialIG) socialIG.href = settings.instagram;
            }
            if (settings.linkedin) {
                const socialLI = document.getElementById('social-linkedin');
                if (socialLI) socialLI.href = settings.linkedin;
            }
            
            if (settings.map_iframe) {
                const mapContainer = document.getElementById('map-container');
                if (mapContainer) {
                    let mapUrl = settings.map_iframe;
                    // Handle Google Maps share links (maps.app.goo.gl)
                    if (mapUrl.includes('goo.gl')) {
                        // We can't easily convert short links to embed links client-side without an API
                        // but we can try to wrap it in an iframe or suggest the user use the embed code
                        mapContainer.innerHTML = `<iframe src="${mapUrl}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
                    } else {
                        mapContainer.innerHTML = `<iframe src="${mapUrl}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
                    }
                }
            }
        } catch (e) {
            console.error('Failed to load settings', e);
        }
    }
    loadSettings();
</script>
