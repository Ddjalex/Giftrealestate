<!DOCTYPE html>
<html lang="en">
<head>
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
                <a href="/"><img src="/public/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-brand-green">
                <a href="/" class="hover:text-brand-yellow">Home</a>
                <a href="/about" class="hover:text-brand-yellow">About</a>
                <a href="/properties" class="hover:text-brand-yellow">Properties</a>
                <a href="/gallery" class="hover:text-brand-yellow">Gallery</a>
                <a href="/news" class="hover:text-brand-yellow">News</a>
                <a href="/inquiries" class="text-brand-yellow">Inquiries</a>
                <a href="/contact" class="hover:text-brand-yellow">Contact</a>
            </div>
            <a href="tel:+251921878641" class="bg-brand-green text-brand-yellow font-bold px-6 py-2 rounded-full">Call Us</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-brand-green py-16 text-center">
        <h1 class="text-4xl font-bold text-white mb-4">Send Us an Inquiry</h1>
        <p class="text-brand-yellow">Interested in a property? Let us know and our agents will contact you.</p>
    </header>

    <section class="py-20">
        <div class="container mx-auto px-4 max-w-2xl">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form id="inquiry-form" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                        <input type="tel" name="phone" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Message</label>
                        <textarea name="message" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-brand-green h-32" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-brand-green text-brand-yellow font-bold py-4 rounded-lg hover:bg-opacity-90 transition shadow-lg">Submit Inquiry</button>
                </form>
                <div id="form-status" class="mt-6 text-center hidden"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-green text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Gift Real Estate PLC. All rights reserved.</p>
        </div>
    </footer>

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