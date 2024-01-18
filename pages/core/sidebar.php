<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="../dashboard/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav-data" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Kelola Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-data" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="../penduduk/penduduk">
            <i class="bi bi-circle"></i><span>Data Penduduk</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav 1-->

    <li class="nav-item">
      <?php if ($_SESSION['role'] === 'super admin'): ?>
        <a class="nav-link collapsed" data-bs-target="#forms-nav-sirkulasi" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart-line"></i><span>Sirkulasi Penduduk</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-sirkulasi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../kartu keluarga/kk">
              <i class="bi bi-circle"></i><span>Data Kartu Keluarga</span>
            </a>
          </li>
          <li>
            <a href="../kelahiran/kelahiran">
              <i class="bi bi-circle"></i><span>Data Kelahiran</span>
            </a>
          </li>
          <li>
            <a href="../meninggal/meninggal">
              <i class="bi bi-circle"></i><span>Data Kematian</span>
            </a>
          </li>
          <li>
            <a href="../pendatang/pendatang">
              <i class="bi bi-circle"></i><span>Data Pendatang</span>
            </a>
          </li>
          <li>
            <a href="../pindah/pindah">
              <i class="bi bi-circle"></i><span>Data Pindah</span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </li><!-- End Forms Nav 2 -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav-surat" data-bs-toggle="collapse" href="#">
        <i class="bi bi-envelope"></i><span>Kelola Surat</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-surat" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="../surat/suket_domisili">
            <i class="bi bi-circle"></i><span>Surat Keterangan Domisili</span>
          </a>
        </li>
        <li>
          <a href="../surat/suket_lahir">
            <i class="bi bi-circle"></i><span>Surat Keterangan Kelahiran</span>
          </a>
        </li>
        <li>
          <a href="../surat/suket_mati">
            <i class="bi bi-circle"></i><span>Surat Keterangan Kematian</span>
          </a>
        </li>
        <li>
          <a href="../surat/suket_datang">
            <i class="bi bi-circle"></i><span>Surat Keterangan Pendatang</span>
          </a>
        </li>
        <li>
          <a href="../surat/suket_pindah">
            <i class="bi bi-circle"></i><span>Surat Keterangan Pindah</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav 3 -->

    <li class="nav-item">
      <?php if ($_SESSION['role'] === 'super admin'): ?>
        <a class="nav-link collapsed" data-bs-target="#forms-nav-berita" data-bs-toggle="collapse" href="#">
          <i class="bi bi-newspaper"></i><span>Berita</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-berita" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../berita/berita">
              <i class="bi bi-circle"></i><span>Data Berita</span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </li><!-- End Forms Nav 4 -->

    <!-- End Tables Nav -->
    <li class="nav-item">
      <?php if ($_SESSION['role'] === 'super admin'): ?>
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../users/datauser">
              <i class="bi bi-circle"></i><span>Data Pengguna</span>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </li>

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="../profile/profile">
        <i class="bi bi-person-circle"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="../../../index">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Logout</span>
      </a>
    </li><!-- End Login Page Nav -->

  </ul>

</aside><!-- End Sidebar-->
