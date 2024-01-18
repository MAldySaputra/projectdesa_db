<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../../../login");
        exit();
    }

    // Periksa apakah pengguna memiliki peran super admin atau admin
    if ($_SESSION['role'] !== 'super admin' && $_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login");
        exit();
    }

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id="main">
    <div class="pagetitle">
        <h1>Data Berita</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Berita</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Berita</h5>
                        <p>
                            <a href="add_berita" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Berita</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Tanggal Uploud</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../../../config/db.php';

                                    $berita = mysqli_query($db_connect, "SELECT * FROM tbl_berita");
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($berita)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                                <td><?= $row['nama_judul']; ?></td>
                                                <td><?= $row['deskripsi_judul']; ?></td>
                                                <td><a href="image/<?= $row['gambar']; ?>" target="_blank">Unduh</a></td>
                                                <td><?= $row['tanggal_berita']; ?></td>
                                            <td>

                                                <!-- Formulir Hapus -->
                                                <form method="POST" action="del_berita.php">
                                                    <input type="hidden" name="id_berita" value="<?= $row['id_berita']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
