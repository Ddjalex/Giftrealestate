<?php
// Shared Footer Component
?>
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
                <!-- Brand -->
                <div>
                    <div class="text-2xl font-black text-brand-yellow mb-6 uppercase">Gift Real Estate</div>
                    <p id="footer-about" class="text-gray-400 text-sm mb-6">
                        Gift Real Estate PLC is one of the pioneering real estate companies in Ethiopia, building dream homes since 2005.
                    </p>
                    <div class="flex space-x-4">
                        <a id="social-facebook" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-facebook-f"></i></a>
                        <a id="social-telegram" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-telegram"></i></a>
                        <a id="social-instagram" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-instagram"></i></a>
                        <a id="social-linkedin" href="#" class="text-white hover:text-brand-yellow transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <!-- Property Types -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow uppercase">Property Types</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/properties?type=Residential+Apartments" class="hover:text-brand-yellow transition">Residential Apartments</a></li>
                        <li><a href="/properties?type=Commercial+Properties" class="hover:text-brand-yellow transition">Commercial Properties</a></li>
                        <li><a href="/properties?type=Luxury+Villas" class="hover:text-brand-yellow transition">Luxury Villas</a></li>
                        <li><a href="/properties?type=Office+Spaces" class="hover:text-brand-yellow transition">Office Spaces</a></li>
                        <li><a href="/properties?type=Retail+Shops" class="hover:text-brand-yellow transition">Retail Shops</a></li>
                    </ul>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow uppercase">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/about" class="hover:text-brand-yellow transition">About Us</a></li>
                        <li><a href="/properties" class="hover:text-brand-yellow transition">Our Properties</a></li>
                        <li><a href="/gallery" class="hover:text-brand-yellow transition">Project Gallery</a></li>
                        <li><a href="/news" class="hover:text-brand-yellow transition">Latest News</a></li>
                    </ul>
                </div>

                <!-- Contact Details -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-yellow uppercase">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-brand-yellow"></i>
                            <span id="footer-address">Kazanchis, Black Gold Plaza, Addis Ababa</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-brand-yellow"></i>
                            <span id="footer-phone">+251 921 878 641</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-brand-yellow"></i>
                            <span id="footer-email">info@giftrealestate.com.et</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-white/10 text-center text-gray-400 text-sm">
                <p>&copy; <?php echo date('Y'); ?> Gift Real Estate PLC. All rights reserved.</p>
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
                if (mapContainer) mapContainer.innerHTML = `<iframe src="${settings.map_iframe}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            }
        } catch (e) {
            console.error('Failed to load settings', e);
        }
    }
    loadSettings();
</script>
