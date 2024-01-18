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
        <h1>Data Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Pengguna</h5>
                        <p>
                            <a href="adduser" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Pengguna</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../../../config/db.php';
                                    $products = mysqli_query($db_connect, "SELECT * FROM tbl_pengguna");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($products)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['jabatan']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['no_hp']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['role']; ?></td>
                                            <td>
                                                <!-- Tautan Edit -->
                                                <a href="edituser?id=<?= $row['id_admin']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Formulir Hapus -->
                                                <form method="POST" action="deleteuser.php">
                                                    <input type="hidden" name="id_admin" value="<?= $row['id_admin']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
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
