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
        <h1>Data Pendatang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Pendatang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Pendatang</h5>
                        <p>
                            <a href="add_pendatang" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Pendatang</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK Pendatang</th>
                                        <th>Nama Pendatang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Datang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../../../config/db.php';

                                    $pendatang = mysqli_query($db_connect, "SELECT * FROM tbl_pendatang");
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($pendatang)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                                <td><?= $row['nik_pendatang']; ?></td>
                                                <td><?= $row['nama_pendatang']; ?></td>
                                                <td><?= $row['jenis_kelamin']; ?></td>
                                                <td><?= $row['tanggal_datang']; ?></td>
                                            <td>
                                                <!-- Tautan Edit -->
                                                <a href="edit_pendatang?id=<?= $row['id_datang']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Formulir Hapus -->
                                                <form method="POST" action="del_pendatang.php">
                                                    <input type="hidden" name="id_datang" value="<?= $row['id_datang']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pendatang ini?')">
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
