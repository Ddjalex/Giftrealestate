<?php
// Shared Footer Component
?>
<footer class="bg-brand-green text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-1">
                <img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain bg-white p-2 rounded mb-6">
                <p class="text-gray-300 text-sm leading-relaxed">
                    Gift Real Estate PLC is one of the pioneering real estate companies in Ethiopia, building dream homes since 2005.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-brand-yellow font-bold uppercase mb-6">Quick Links</h4>
                <ul class="space-y-4 text-gray-300">
                    <li><a href="/" class="hover:text-brand-yellow transition">Home</a></li>
                    <li><a href="/about" class="hover:text-brand-yellow transition">About Us</a></li>
                    <li><a href="/properties" class="hover:text-brand-yellow transition">Properties</a></li>
                    <li><a href="/gallery" class="hover:text-brand-yellow transition">Gallery</a></li>
                </ul>
            </div>
            
            <!-- Information -->
            <div>
                <h4 class="text-brand-yellow font-bold uppercase mb-6">Information</h4>
                <ul class="space-y-4 text-gray-300">
                    <li><a href="/news" class="hover:text-brand-yellow transition">News</a></li>
                    <li><a href="/contact" class="hover:text-brand-yellow transition">Contact Us</a></li>
                    <li><a href="/privacy" class="hover:text-brand-yellow transition">Privacy Policy</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h4 class="text-brand-yellow font-bold uppercase mb-6">Contact Us</h4>
                <ul class="space-y-4 text-gray-300">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-brand-yellow"></i>
                        <span>Addis Ababa, Ethiopia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-brand-yellow"></i>
                        <span>+251 921 878 641</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-brand-yellow"></i>
                        <span>info@giftrealestate.com.et</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-white/10 text-center text-gray-400 text-sm">
            <p>&copy; <?php echo date('Y'); ?> Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </div>
</footer>
