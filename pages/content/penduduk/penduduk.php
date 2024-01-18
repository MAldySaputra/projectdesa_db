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
        <h1>Data Penduduk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Penduduk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Penduduk</h5>
                        <p>
                            <a href="add_penduduk" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Penduduk</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Penduduk</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>RT</th>
                                        <th>RW</th>
                                        <th>Pekerjaan</th>
                                        <th>Status Perkawinan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../../../config/db.php';

                                    $penduduk = mysqli_query($db_connect, "SELECT * FROM tbl_penduduk");
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($penduduk)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['tanggal']; ?></td>
                                            <td><?= $row['agama']; ?></td>
                                            <td><?= $row['jenis_kelamin']; ?></td>
                                            <td><?= $row['rt']; ?></td>
                                            <td><?= $row['rw']; ?></td>
                                            <td><?= $row['pekerjaan']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td>
                                                <!-- Tautan Edit -->
                                                <a href="edit_penduduk?id=<?= $row['id_penduduk']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Formulir Hapus -->
                                                <form method="POST" action="del_penduduk.php">
                                                    <input type="hidden" name="id_penduduk" value="<?= $row['id_penduduk']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penduduk ini?')">
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
