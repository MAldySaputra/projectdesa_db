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
        header("Location: ../../../login.php");
        exit();
    }

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Kartu Keluarga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Kartu Keluarga</li>
            </ol>
        </nav>
    </div><!-- Akhir Judul Halaman -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Kartu Keluarga</h5>
                        <p>
                            <a href="add_kepala_keluarga" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Kartu Keluarga</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No KK</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Alamat</th>
                                        <th>RT</th>
                                        <th>RW</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Sertakan konfigurasi database
                                    require '../../../config/db.php';

                                    // Ambil data keluarga dari database
                                    $kartu_keluarga = mysqli_query($db_connect, "SELECT * FROM tbl_kk");

                                    if (!$kartu_keluarga) {
                                        die('Error: ' . mysqli_error($db_connect));
                                    }

                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($kartu_keluarga)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['rt']; ?></td>
                                            <td><?= $row['rw']; ?></td>
                                            <td>

                                                <!-- Tautan Edit -->
                                                <a href="edit_keluarga?id=<?= $row['id_kk']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Formulir Hapus -->
                                                <form method="POST" action="del_keluarga.php">
                                                    <input type="hidden" name="id_kk" value="<?= $row['id_kk']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus keluarga ini?')">
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
</main><!-- Akhir #main -->

<?php
// Sertakan footer
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
