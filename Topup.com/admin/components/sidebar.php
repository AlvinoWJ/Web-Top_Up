<div class="d-flex">
  <div class="sidebar d-flex flex-column p-3" style="position: fixed; width: 250px; height: 100vh;">
    <h4 class="text-white">CincaAdmin</h4>
    <hr class="text-white">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link nav-link d-flex justify-content-between align-items-center text-white">Dashboard<i class="bi bi-chevron-right"></i></a>
      </li>
      <li>
        <a href="game.php" class="nav-link d-flex justify-content-between align-items-center text-white">Game<i class="bi bi-chevron-right"></i></a>
      </li>
      <li>
        <a href="package.php" class="nav-link d-flex justify-content-between align-items-center text-white">Package<i class="bi bi-chevron-right"></i></a>
      </li>
      <li>
        <a href="#" class="nav-link d-flex justify-content-between align-items-center text-white">Pengaturan<i class="bi bi-chevron-right"></i></a>
      </li>
    </ul>
  </div>

  <div class="content flex-grow-1" style="margin-left: 250px; overflow:auto">
    <nav class="navbar topbar px-4 py-2 d-flex justify-content-between align-items-center shadow">
      <input type="text" class="form-control w-50" placeholder="Search...">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light position-relative">
          🔔
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3
          </span>
        </button>
        <div class="text-end">
          <div>Alvino Wijaya</div>
          <small class="text-muted">Admin</small>
        </div>
      </div>
    </nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.sidebar .nav-link');
    const currentPath = window.location.pathname.split("/").pop(); // contoh: dashboard.php

    links.forEach(link => {
      const linkPath = link.getAttribute('href');
      if (linkPath === currentPath) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  });
</script>
