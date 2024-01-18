<?php
require 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Desa Pagadungan</title>
    <link href="assets/img/hero-img.png" rel="icon">
    <link rel="stylesheet" href="style-2.css">
</head>

<body>
<main id="main" class="main">
    <div class="pagetitle">
            <h1>Portal Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <button class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="index"> Home</a></button>
                    <button class="breadcrumb-item"><a href="berita">Data Berita</a></button>
                </ol>
            </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" style="display: flex; flex-direction: column; gap: 20px">
                <h5 class="card-title">Daftar Berita</h5>

                <!-- Display News -->
                <?php
                $select_query = "SELECT * FROM tbl_berita ORDER BY tanggal_berita DESC";
                $result = mysqli_query($db_connect, $select_query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="news-item" style="display: flex; justify-content: space-between; align-items: center; gap: 20px;">
                                <div>
                                    <h3><?= $row['nama_judul'] ?></h3>
                                    <p><?= $row['deskripsi_judul'] ?></p>
                                    <p>Tanggal Uploud: <?= $row['tanggal_berita'] ?></p>
                                </div>
                                <div>
                                    <?php
                                    $imagePath = $row['gambar'];
                                    $imageFileType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                    ?>
                                    <?php if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <img src="/projectdesa_db/pages/content/berita/image/<?= $imagePath ?>" style="width: 200px" alt="News Image">
    
                                    <?php else: ?>
                                        <p>Unsupported Image Format</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Tidak ada berita yang ditampilkan.";
                    }
                } else {
                    // Display MySQL error if query fails
                    echo "Error: " . mysqli_error($db_connect);
                }
                ?>
            </div>
        </div>
    </div>
</main>

</body>
</html>
