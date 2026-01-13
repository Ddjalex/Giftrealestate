<?php
// Shared Footer Component
?>
<section id="contact" class="bg-[#32CD32]">
    <footer class="text-white pt-20 pb-10 relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="/uploads/footer_bg_new.jpg" class="w-full h-full object-cover" alt="Footer Background">
            <div class="absolute inset-0 bg-[#32CD32] opacity-60"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 items-start">
                <!-- Brand -->
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-24 object-contain mb-6 bg-white/10 p-2 rounded-xl">
                    <h4 class="text-lg font-bold mb-4 uppercase tracking-widest">Our Location</h4>
                    <p id="footer-address" class="text-white text-sm mb-6 leading-relaxed">
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
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-8 text-white uppercase tracking-widest">Quick Links</h4>
                    <ul class="space-y-4 text-white text-sm">
                        <li><a href="/about.php" class="hover:underline transition">About Us</a></li>
                        <li><a href="/properties.php" class="hover:underline transition">Properties</a></li>
                        <li><a href="/gallery.php" class="hover:underline transition">Project Gallery</a></li>
                        <li><a href="/news.php" class="hover:underline transition">Latest News</a></li>
                        <li><a href="/contact.php" class="hover:underline transition">Contact Us</a></li>
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
                                <span id="footer-phone">+251 921878641</span>
                            </div>
                            <div class="flex items-center gap-3 hidden">
                                <i class="fas fa-phone-alt"></i>
                                <span id="footer-phone2"></span>
                            </div>
                        </li>
                        <li>
                            <div class="flex gap-0">
                                <input type="email" placeholder="Enter your email" class="flex-1 bg-white p-3 rounded-l-lg text-gray-800 focus:outline-none h-12">
                                <button class="bg-[#5D5DFF] text-white px-6 py-3 rounded-r-lg font-bold hover:bg-blue-700 transition h-12 uppercase text-sm">SUBSCRIBE</button>
                            </div>
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
            
            <div class="mt-12 pt-8 border-t border-white/20 text-center text-white text-sm">
                <p>Copyright &copy; <?php echo date('Y'); ?> Gift Real Estate PLC</p>
            </div>
        </div>
    </footer>
</section>
<script>
    async function loadSettings() {
        try {
            const response = await fetch('/api/settings.php');
            const settings = await response.json();
            if (settings.address) {
                const footerAddr = document.getElementById('footer-address');
                if (footerAddr) footerAddr.innerText = settings.address;
                const contactAddr = document.querySelector('li.text-white');
                if (contactAddr) contactAddr.innerText = settings.address;
                const topBarAddress = document.querySelector('.sm\\:inline');
                if (topBarAddress) topBarAddress.innerHTML = `<i class="fas fa-map-marker-alt text-brand-yellow mr-2"></i>${settings.address}`;
            }
            if (settings.phone) {
                const footerPhone = document.getElementById('footer-phone');
                if (footerPhone) footerPhone.innerText = settings.phone;
                const topBarPhone = document.getElementById('top-bar-phone');
                if (topBarPhone) {
                    let phoneHtml = `<i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${settings.phone}`;
                    if (settings.phone2) {
                        phoneHtml += ` | <i class="fas fa-phone-alt text-brand-yellow mr-2"></i>${settings.phone2}`;
                    }
                    topBarPhone.innerHTML = phoneHtml;
                }
                
                // Update all tel: links
                const cleanPhone = settings.phone.replace(/\s/g, '');
                document.querySelectorAll('a[href^="tel:"]').forEach(btn => {
                    btn.href = `tel:${cleanPhone}`;
                });
                
                // Specifically update property card buttons
                document.querySelectorAll('.call-for-price-btn').forEach(btn => {
                    btn.href = `tel:${cleanPhone}`;
                });
                
                // Update stats phone if exists
                const statsPhone = document.getElementById('stats-phone');
                if (statsPhone) statsPhone.innerText = settings.phone;
            }
            if (settings.phone2) {
                const footerPhone2 = document.getElementById('footer-phone2');
                if (footerPhone2) {
                    footerPhone2.innerText = settings.phone2;
                    footerPhone2.parentElement.classList.remove('hidden');
                }
            }
            if (settings.facebook) document.querySelectorAll('[id^="social-facebook"]').forEach(a => a.href = settings.facebook);
            if (settings.telegram) document.querySelectorAll('[id^="social-telegram"]').forEach(a => a.href = settings.telegram);
            if (settings.instagram) document.querySelectorAll('[id^="social-instagram"]').forEach(a => a.href = settings.instagram);
            if (settings.linkedin) document.querySelectorAll('[id^="social-linkedin"]').forEach(a => a.href = settings.linkedin);
        } catch (e) {
            console.error('Failed to load settings', e);
        }
    }
    loadSettings();
</script>
