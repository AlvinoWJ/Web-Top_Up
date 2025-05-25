<div class="container mt-5">
    <div class="row row-cols-2 row-cols-md-6 g-3 mb-4">
    <?php foreach ($games as $index => $g): ?>
        <?php
            $shouldHide = !empty($showToggleButton) && $showToggleButton && $index >= 12;
        ?>
        <div class="col <?= $shouldHide ? 'extra-card hidden-card' : '' ?>">
            <div class="card bg-dark text-white rounded-4 overflow-hidden fade-card h-100 d-flex flex-column justify-content-between shadow-sm">
                <!-- Gambar Game -->
                <img src="admin/<?= $g['icon_game'] ?>" class="card-image rounded-4" alt="<?= htmlspecialchars($g['name']) ?>" style="object-fit: cover; height: 150px;">

                <!-- Nama Game dan Tombol -->
                <div class="p-2 text-center">
                    <h6 class="mt-2 mb-2"><?= htmlspecialchars($g['name']) ?></h6>
                    <a href="topup.php?id=<?= $g['id'] ?>" class="btn btn-outline-light btn-sm">Top Up</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>




    <?php if (!empty($showToggleButton) && $showToggleButton): ?>
    <div class="text-center my-3">
        <button class="btn btn-outline-light tampilkan-btn" id="toggleExtraBtn">Tampilkan Semua...</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleExtraBtn');
            const extraCards = document.querySelectorAll('.extra-card');
            let shown = false;

            toggleBtn.addEventListener('click', () => {
                shown = !shown;
                extraCards.forEach(card => {
                    card.classList.toggle('hidden-card', !shown);
                });
                toggleBtn.textContent = shown ? 'Sembunyikan' : 'Tampilkan Semua...';
            });
        });
    </script>
    <?php endif; ?>
</div>


<style>
    .tampilkan-btn {
        border-radius: 12px;
        font-weight: bold;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .tampilkan-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .fade-card {
        transition: all 0.4s ease;
    }

    .hidden-card {
        opacity: 0;
        transform: scale(0.95);
        max-height: 0;
        overflow: hidden;
        pointer-events: none;
        margin: 0 !important;
        padding: 0 !important;
        transition: all 0.4s ease;
    }
</style>

<script>
    const toggleBtn = document.getElementById('toggleExtraBtn');
    const extraCards = document.querySelectorAll('.extra-card');
    let shown = false;

    toggleBtn.addEventListener('click', () => {
        shown = !shown;
        extraCards.forEach(card => {
            if (shown) {
                card.classList.remove('hidden-card');
            } else {
                card.classList.add('hidden-card');
            }
        });
        toggleBtn.textContent = shown ? 'Sembunyikan' : 'Tampilkan Semua...';
    });
</script>
