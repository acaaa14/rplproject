<?php
// Termasuk file koneksi database
include('db.php'); 

// Mendapatkan ID produk dari URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Jika ID produk tidak ditemukan, tampilkan pesan kesalahan
if (!$product_id) {
    echo "ID produk tidak ditemukan.";
    exit;
}

// Query untuk mendapatkan data produk berdasarkan ID
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

// Jika produk ditemukan, ambil data produk
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Produk tidak ditemukan.";
    exit;
}

// Query untuk mendapatkan produk terkait berdasarkan kategori yang sama
$related_query = "SELECT * FROM products WHERE category_id = (SELECT category_id FROM products WHERE product_id = $product_id) AND product_id != $product_id LIMIT 4";
$related_result = mysqli_query($conn, $related_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Cake Pop</title>
    <link rel="stylesheet" href="assets/css/stylesproduk.css">
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
                <?php if (isset($user) && $user): ?>
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

    <!-- Detail Produk -->
    <main>
        <section class="product-detail">
            <div class="container">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="product-detail-content">
                    <!-- Gambar Produk -->
                    <div class="product-image">
                        <img src="<?php echo !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : 'assets/images/default.jpg'; ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="product-image">
                    </div>
                    <!-- Informasi Produk -->
                    <div class="product-info">
                        <p class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-actions">
                            <button class="btn btn-green">Tambah ke Keranjang</button>
                            <button class="btn btn-orange">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <!-- Produk Terkait -->
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Anda Mungkin Juga Suka</h2>
            <div class="row">
                <?php
                if ($related_result && mysqli_num_rows($related_result) > 0):
                    while ($related_product = mysqli_fetch_assoc($related_result)):
                ?>
                    <div class="col-md-3 mb-4">
                        <div class="card related-product-card">
                            <!-- Menampilkan gambar produk -->
                            <img src="<?php echo !empty($related_product['image_url']) ? htmlspecialchars($related_product['image_url']) : 'assets/images/default.jpg'; ?>" 
                                alt="<?php echo htmlspecialchars($related_product['name']); ?>" 
                                class="related-product-img">
                            <!-- Menampilkan informasi produk -->
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($related_product['name']); ?></h5>
                                <p class="card-text text-success">Rp <?php echo number_format($related_product['price'], 0, ',', '.'); ?></p>
                                <a href="product_detail.php?id=<?php echo $related_product['product_id']; ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                else:
                    echo '<p class="text-center">Tidak ada produk terkait yang tersedia.</p>';
                endif;
                ?>
            </div>
        </div>
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
