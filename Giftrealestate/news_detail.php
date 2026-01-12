<?php
require_once 'api/db.php';
global $pdo;

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: news.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    header('Location: news.php');
    exit;
}

// Fetch settings for contact info
$stmt = $pdo->query("SELECT `key`, `value` FROM settings");
$settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
$contactPhone = $settings['phone'] ?? '';
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
    <meta name="description" content="<?php echo htmlspecialchars(substr(strip_tags($article['content']), 0, 160)); ?>">
    <title><?php echo htmlspecialchars($article['title']); ?> | Gift Real Estate PLC News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        :root { --brand-green: #008148; --brand-yellow: #fdd835; }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-green { background-color: var(--brand-green); }
        .prose img { border-radius: 1.5rem; margin: 2rem 0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .text-brand-green { color: #008148 !important; }
        .bg-brand-green { background-color: #008148 !important; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center h-20">
            <div class="flex items-center shrink-0">
                <a href="/"><img src="/assets/logo.png" alt="Gift Real Estate Logo" class="h-16 w-auto max-w-[150px] object-contain"></a>
            </div>
            <div class="hidden md:flex space-x-8 font-semibold text-[#008148] uppercase text-sm tracking-wider">
                <a href="index.php" class="nav-link">Home</a>
                <a href="about.php" class="nav-link">About Us</a>
                <a href="gallery.php" class="nav-link">Gallery</a>
                <a href="properties.php" class="nav-link">Properties</a>
                <a href="news.php" class="nav-link text-brand-yellow">News</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="flex items-center">
                <a href="tel:<?php echo $contactPhone; ?>" class="bg-[#008148] text-white font-bold px-6 py-2 rounded-full text-sm whitespace-nowrap">
                    Call Us
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <a href="news.php" class="text-brand-green font-bold mb-8 inline-block hover:underline">
                <i class="fas fa-arrow-left mr-2"></i> Back to News
            </a>
            
            <article class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
                <?php if ($article['image_url']): ?>
                    <img src="<?php echo (strpos($article['image_url'], 'http') === 0) ? $article['image_url'] : '/uploads/' . $article['image_url']; ?>" class="w-full h-[500px] object-cover">
                <?php endif; ?>
                
                <div class="p-8 md:p-12">
                    <span class="text-xs text-gray-400 font-bold uppercase block mb-4"><?php echo date('F j, Y', strtotime($article['created_at'])); ?></span>
                    <h1 class="text-4xl md:text-5xl font-bold text-[#008148] mb-8 leading-tight"><?php echo htmlspecialchars($article['title']); ?></h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
                        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>