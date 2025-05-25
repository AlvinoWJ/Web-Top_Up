<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container my-2">
        <a class="navbar-brand text-white" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 allign-item-center">
                <li class="nav-item">
                    <div class="position-relative mx-3">
                        <input type="text" class="form-control ps-5 rounded-pill search-input" placeholder="Cari Produk">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                    </div>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white" href="index.php">Beranda</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link text-white" href="riwayat_checkout.php">Riwayat</a>
                </li>
            </ul>
        </div>
        <?php if (isset($_SESSION['username'])) : ?>
            <a href="admin/logout.php" onclick="return confirm('Yakin ingin logout?')">
                <button type="button" class="btn text-white fw-bold" style="background-color: #dc3545;">LOGOUT</button>
            </a>
        <?php else : ?>
            <a href="login.php">
                <button type="button" class="btn text-white fw-bold" style="background-color: #d4af37;">MASUK / DAFTAR</button>
            </a>
        <?php endif; ?>

    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script>
    window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>