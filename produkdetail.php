<?php
// Koneksi ke database
include('db.php');

// Query untuk mengambil produk
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<img src="assets/images/' . $product['image'] . '" alt="' . $product['name'] . '">';
        echo '<h3>' . $product['name'] . '</h3>';
        echo '<p>Rp ' . number_format($product['price'], 0, ',', '.') . '</p>';
        echo '<a href="product_detail.php?id=' . $product['id'] . '" class="btn btn-primary">Lihat Detail</a>';
        echo '</div>';
    }
} else {
    echo "Tidak ada produk untuk ditampilkan.";
}
?>
