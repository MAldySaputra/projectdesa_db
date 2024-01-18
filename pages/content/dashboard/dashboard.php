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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="dashboard"> Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <h1>Tabel Data Penduduk</h1>

<?php
    include('../../../config/db.php');

    $dataRealtimependuduk = mysqli_query($db_connect, "SELECT count(id_penduduk) AS jmlh_penduduk FROM tbl_penduduk");
    $viewpenduduk = mysqli_fetch_array($dataRealtimependuduk);

    $dataRealtimeKK = mysqli_query($db_connect, "SELECT count(id_kk) AS jmlh_kk FROM tbl_kk");
    $viewKK = mysqli_fetch_array($dataRealtimeKK);

    $jmlh_LakiLaki = 0; // Initialize the variable
    $jmlh_Perempuan = 0; // Initialize the variable

    $dataRealtimeJK = mysqli_query($db_connect, "SELECT jenis_kelamin, COUNT(jenis_kelamin) AS jmlh_JK FROM tbl_penduduk GROUP BY jenis_kelamin");
    while ($row = mysqli_fetch_assoc($dataRealtimeJK)) {
        if ($row['jenis_kelamin'] == 'Laki-laki') {
            $jmlh_LakiLaki = $row['jmlh_JK'];
        } elseif ($row['jenis_kelamin'] == 'Perempuan') {
            $jmlh_Perempuan = $row['jmlh_JK'];
        }
    }

    $dataRealtimelahir = mysqli_query($db_connect, "SELECT count(id_lahir) AS jmlh_lahir FROM tbl_kelahiran");
    $viewlahir = mysqli_fetch_array($dataRealtimelahir);

    $dataRealtimemeninggal = mysqli_query($db_connect, "SELECT count(id_meninggal) AS jmlh_meninggal FROM tbl_meninggal");
    $viewmeninggal = mysqli_fetch_array($dataRealtimemeninggal);

    $dataRealtimependatang = mysqli_query($db_connect, "SELECT count(id_datang) AS jmlh_pendatang FROM tbl_pendatang");
    $viewpendatang = mysqli_fetch_array($dataRealtimependatang);

    $dataRealtimepindah = mysqli_query($db_connect, "SELECT count(id_pindah) AS jmlh_pindah FROM tbl_pindah");
    $viewpindah = mysqli_fetch_array($dataRealtimepindah);
?>

    <!-- Left side columns -->
        <div class="row">

            <!-- Sales Card -->
            <div class="col-lg-3 col-6" >
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-person-fill-add display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Penduduk</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewpenduduk['jmlh_penduduk']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-2">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-person-vcard display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">KK</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewKK['jmlh_kk']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-gender-male display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Laki-Laki</h5>
                                <div class="ps-3">
                                    <h6><?php echo $jmlh_LakiLaki; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-gender-female display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Perempuan</h5>
                                <div class="ps-3">
                                    <h6><?php echo $jmlh_Perempuan; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-emoji-smile-fill display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Lahir</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewlahir['jmlh_lahir']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-emoji-frown-fill display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Meninggal</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewmeninggal['jmlh_meninggal']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>

            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-cloud-arrow-up-fill display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Pendatang</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewpendatang['jmlh_pendatang']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>
            
            <!-- Sales Card -->
            <div class="col-lg-3 col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-end justify-content-start me-1">
                                <!-- Add the 'bi' class for Bootstrap Icons and 'display-1' class for larger size -->
                                <i class="bi bi-cloud-arrow-down-fill display-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Pindah</h5>
                                <div class="ps-3">
                                    <h6><?php echo $viewpindah['jmlh_pindah']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
            </div>
        </div>
    </div><!-- End Left side columns -->
</main><!-- End #main -->

<!-- Add Bootstrap JS and Popper.js -->
<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
