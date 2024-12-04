<?php
if (isset($_POST['submit'])) {
    // Mendapatkan file yang diupload
    $image = $_FILES['image'];

    // Menyimpan nama file
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    
    // Memeriksa apakah ada error dalam upload
    if ($imageError === 0) {
        // Menentukan ekstensi gambar
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        
        // Membatasi ekstensi file yang diterima (misalnya jpg, jpeg, png)
        $allowedExt = ['jpg', 'jpeg', 'png'];

        if (in_array($imageExt, $allowedExt)) {
            // Menentukan nama file baru agar tidak ada duplikasi
            $imageNewName = uniqid('', true) . '.' . $imageExt;

            // Menentukan lokasi penyimpanan gambar
            $imageDestination = 'assets/images/imageProduk/' . $imageNewName;

            // Memindahkan file gambar ke folder yang ditentukan
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Menyimpan nama gambar dalam database
                include('db.php');
                $query = "INSERT INTO products (name, description, price, image_url) VALUES ('Product Name', 'Product Description', 100000, '$imageNewName')";
                if (mysqli_query($conn, $query)) {
                    echo "Gambar berhasil diupload dan produk berhasil ditambahkan.";
                } else {
                    echo "Gagal menambahkan produk ke database.";
                }
            } else {
                echo "Terjadi kesalahan saat mengupload gambar.";
            }
        } else {
            echo "Ekstensi gambar tidak valid. Gunakan jpg, jpeg, atau png.";
        }
    } else {
        echo "Gagal mengupload gambar. Coba lagi.";
    }
}
?>
