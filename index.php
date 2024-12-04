<?php
session_start();
include('db.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Ambil semua produk
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Jika gagal mengambil data
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Pop - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="assets/images/gambarlogo.png" alt="Logo CakePop" class="logo-img">
            <h1 class="logo">Cake <span>Pop</span></h1>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact Us</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="header-icons">
            <a href="profile.php" class="header-icon">
                <img src="assets/images/gambarlupi.png" alt="Profile" class="profile-icon">
            </a>
            <a href="cart.php" class="header-icon">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
    </header>

    <main class="main-content">
        <!-- Banner Section -->
        <section class="banner">
            <div class="banner-content">
                <h2>Indulge in Sweet Perfection - Freshly Baked Daily!</h2>
                <div class="banner-buttons">
                    <a href="#" class="btn btn-green">Products</a>
                    <a href="#" class="btn btn-orange">Services</a>
                </div>
            </div>
            <img src="assets/images/kueee.png" alt="Cake Banner" class="banner-img">
        </section>

        <!-- About Section -->
        <section class="about">
            <div class="about-content">
                <h3>Best Freshly Baked</h3>
                <p>Enjoy our freshly baked cakes made daily to ensure top quality and amazing flavors!</p>
                <ul>
                    <li>✅ Fresh ingredients daily</li>
                    <li>✅ Made with love and precision</li>
                    <li>✅ Perfect for all occasions</li>
                </ul>
                <a href="#" class="btn btn-green">Read More</a>
            </div>
            <img src="assets/images/kueultah.jpg" alt="Cake Display" class="about-img">
        </section>

        <!-- Features Section -->
        <section class="features">
            <h3>category</h3>
            <div class="features-container">
                <div class="feature">
                    <img src="assets/images/kueultah1.png" alt="Freshly Baked">
                    <h4>birthday cake</h4>
                    <p>Pesan sekarang dan dapatkan diskon spesial ulang tahun hingga 20%!</p>
                </div>
                <div class="feature">
                    <img src="assets/images/cookies.png" alt="Quality Ingredients">
                    <h4>cookies</h4>
                    <p>Kue kering premium untuk momen spesial dan hari-hari biasa.</p>
                </div>
                <div class="feature">
                    <img src="assets/images/custom.png" alt="Customer Service">
                    <h4>cake custom</h4>
                    <p>Kue spesial untuk momen spesial, didesain sesuai impianmu!</p>
                </div>
            </div>
        </section>
        <!-- Products Section -->
        <section class="products">
            <div class="container">
                <h3>Our Products</h3>
                <div class="products-container">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($product = mysqli_fetch_assoc($result)): ?>
                            <?php
                            // Gunakan gambar default jika image_path kosong atau NULL
                            $imagePath = !empty($product['image_path']) ? $product['image_path'] : 'assets/images/default.jpg';
                            $productName = !empty($product['name']) ? $product['name'] : 'Unknown Product';
                            ?>
                            <div class="product-card">
                            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">

                                <div class="product-info">
                                    <h4><?php echo htmlspecialchars($productName); ?></h4>
                                    <p>Rp <?php echo number_format(floatval($product['price']), 0, ',', '.'); ?></p>
                                    <a href="#" class="btn btn-green">Beli</a>
                                    <a href="product_detail.php?id=<?php echo $product['product_id']; ?>" class="btn btn-light">View Detail</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Tidak ada produk tersedia saat ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <h3>Cake <span>Pop</span></h3>
                <p>Delicious freshly baked cakes for every occasion.</p>
                <div class="social-links">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div class="newsletter">
                <h4>Newsletter</h4>
                <form>
                    <input type="email" placeholder="Your email">
                    <button type="submit" class="btn btn-green">Sign Up</button>
                </form>
            </div>
        </div>
        <p>&copy; 2024 Cake Pop. All Rights Reserved.</p>
    </footer>
</body>
</html>
