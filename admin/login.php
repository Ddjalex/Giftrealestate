<?php
session_start();
require_once '../api/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $user['email'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Gift Real Estate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <div class="text-center mb-8">
            <img src="/public/assets/logo.png" alt="Logo" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
        </div>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-[#004d40] text-[#fdd835] font-bold py-3 rounded-lg hover:bg-opacity-90 transition">Login</button>
        </form>
    </div>
</body>
</html>
