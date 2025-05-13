<?php
$nominallist = [
    ["diamond" => 5, "price" => 2000],
    ["diamond" => 10, "price" => 3000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
    ["diamond" => 20, "price" => 5000],
];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
    <div class="container my-4">
        <div class="rounded overflow-hidden shadow" style="height: 300px;">
            <img src="image/ml1.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="bannerml">
        </div>    
    </div>


    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pilih Nominal</h5>
                        <div class="d-flex flex-wrap gap-3">
                            <?php foreach ($nominallist as $item): ?>

                                <div class="border rounded p-3 text-center" style="width: 250px;">
                                    <strong><?=$item ['diamond'];?> Diamond </strong><br>
                                    Rp. <?= number_format($item['price'], 0,',', '.'); ?>,-
                                    
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>

                <div class="card my-5">
                    <div class="card-body">
                        <h5 class="card-title">Metode Pembayaran</h5>
                        <div class="list-group">
                            <a class="btn btn-light text-start my-2" data-bs-toggle="collapse" href="#Collapsee-money" role="button" aria-expanded="false" aria-controls="collapsee-money"> E-Money
                            <span class="float-end"><img src="img/emoney.png" alt="Logo" height="20"></span>
                            </a>
                            <div class="collapse my-2" id="Collapsee-money">
                                <div class="row row-cols-2 g-3">
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="emoney" class="form-check-input">
                                            <span>QRIS</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="emoney" class="form-check-input">
                                            <span>DANA</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="emoney" class="form-check-input">
                                            <span>OVO</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="emoney" class="form-check-input">
                                            <span>QRIS</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-light text-start my-2" data-bs-toggle="collapse" href="#CollapseVA" role="button" aria-expanded="false" aria-controls="CollapseVA"> Virtual Account / Bank
                            <span class="float-end"><img src="img/emoney.png" alt="Logo" height="20"></span>
                            </a>
                            <div class="collapse my-2" id="CollapseVA">
                                <div class="row row-cols-2 g-3">
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="VA" class="form-check-input">
                                            <span>BRI</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="VA" class="form-check-input">
                                            <span>BNI</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="VA" class="form-check-input">
                                            <span>BCA</span>
                                        </label>
                                    </div>
                                </div>
                            </div>    

                            <a class="btn btn-light text-start my-2" data-bs-toggle="collapse" href="#CollapseCV" role="button" aria-expanded="false" aria-controls="CollapseCV"> Convenience Store
                            <span class="float-end"><img src="img/emoney.png" alt="Logo" height="20"></span>
                            </a>
                            <div class="collapse my-2" id="CollapseCV">
                                <div class="row row-cols-2 g-3">
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="CV" class="form-check-input">
                                            <span>Indomaret</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="border rounded p-2 d-flex align-item-center gap-2">
                                            <input type="radio" name="CV" class="form-check-input">
                                            <span>Alfamart</span>
                                        </label>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="col-lg-4">
                <div class="position-sticky" style="top: 50px" >
                    <div class="card">
                        <div class="card boddy p-4">
                            <h5 class="card-title">Masukkan Data Akun</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="User ID">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Server ID">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Server ID">
                            </div>
                            <small class="text-muted d-block mb-3">*Status transaksi akan dikirim via whatsapp</small>
                            <button class="btn btn-warning">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



























    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>