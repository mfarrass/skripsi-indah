<?php
require 'koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KMEANS SKRIPSI</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav style="background:#A3C1AD;" class="sb-topnav navbar navbar-expand navbar-dark">
            <a class="navbar-brand" href="index.php">Kmeans</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Input Variabel</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Input Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="input_kk.php">Data Kepala Keluarga</a>
                                    <a class="nav-link" href="masuk.php">Data Lokasi</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                K-Means Clustering
                            </a>

                            <a class="nav-link" href="hasil.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Hasil
                            </a>

                            <a class="nav-link" href="login.php">
                                Log Out
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kepala Keluarga</h1>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                                    Tambah Data Kepala Keluarga
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Kepala Keluarga</th>
                                                <th>Pendidikan</th>
                                                <th>Pekerjaan</th>
                                                <th>Tanggungan</th>
                                                <th>Pengeluaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM dt_kk");
                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $namakk = $data['nama_kk'];
                                                $pendidikan = $data['pendidikan'];
                                                $pekerjaan = $data['pekerjaan'];
                                                $tanggungan = $data['tanggungan'];
                                                $pengeluaran = $data['pengeluaran'];
                                                $idkk = $data['id_kk'];
                                            ?>

                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $namakk ?></td>
                                                <td><?php echo $pendidikan ?></td>
                                                <td><?php echo $pekerjaan ?></td>
                                                <td><?php echo $tanggungan ?></td>
                                                <td><?php echo $pengeluaran ?></td>
                                                <td>
                                                <!-- Button trigger modal Edit-->
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaledit<?= $idkk ?>">
                                                <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modaledit<?= $idkk ?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data Kepala Keluarga</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal Tambah Start -->
                                                    <!-- Modal Tambah body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    <label for="namakepkel">Nama Kepala Keluarga</label>
                                                    <input type="text" name="namakepkel" value="<?= $namakk?>" class="form-control" require>
                                                    <br>
                                                    <label for="pendidikan">Pendidikan</label>
                                                    <input type="number" name="pendidikan" class="form-control" value="<?= $pendidikan?>" require>
                                                    <br>
                                                    <label for="pekerjaan">Pekerjaan</label>
                                                    <input type="number" name="pekerjaan" class="form-control" value="<?= $pekerjaan?>" require>
                                                    <br>
                                                    <label for="tanggungan">Tanggungan</label>
                                                    <input type="number" name="tanggungan" class="form-control" value="<?= $tanggungan?>" require>
                                                    <br>
                                                    <label for="pengeluaran">Pengeluaran</label>
                                                    <input type="number" name="pengeluaran" class="form-control" value="<?= $pengeluaran?>" require>
                                                    <br>
                                                    <input type="hidden" name="idkk" value="<?=$idkk?>">
                                                    <button type="submit" class="btn btn-primary" name="editdata-kk">Submit</button>
                                                    </div>
                                                    </form>
                                                    
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    <!-- Modal Edit End -->

                                                    
                                                </div>
                                                </div>
                                                </div>

                                                <!-- button trigger modal hapus -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalhapus<?= $idkk ?>">
                                                <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="modal fade" id="modalhapus<?= $idkk ?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Data Kepala Keluarga</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal Tambah Start -->
                                                    <!-- Modal Tambah body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        <h5>
                                                            Data 
                                                            <?=$namakk?> Akan Terhapus
                                                            <br>
                                                            Anda Yakin?
                                                        </h5>
                                                        <br>
                                                        <br>
                                                    <input type="hidden" name="idkk" value="<?=$idkk?>">
                                                    <button type="submit" class="btn btn-primary" name="hapusdata-kk">Submit</button>
                                                    </div>
                                                    </form>
                                                    
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    <!-- Modal Tambah End -->

                                                    
                                                </div>
                                                </div>
                                                </div>
                                                </td>
                                            </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2023 Indah Tri Nur Azizah</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
    <!-- The Modal Tambah-->
        <div class="modal fade" id="tambah">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kepala Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal Tambah Start -->
                <!-- Modal Tambah body -->
                <form method="post">
                <div class="modal-body">
                <input type="text" name="namakepkel" placeholder="Nama Kepala Keluarga" class="form-control" require>
                <br>
                <!-- <input type="text" name="deskripsi" placeholder="Pekerjaan" class="form-control" require> -->
                <input type="number" name="pendidikan" class="form-control" placeholder="Pendidikan (1/2/3/4)" require>
                <br>
                <input type="number" name="pekerjaan" class="form-control" placeholder="Pekerjaan (1/2/3/4)" require>
                <br>
                <input type="number" name="tanggungan" class="form-control" placeholder="Tanggungan" require>
                <br>
                <input type="number" name="pengeluaran" class="form-control" placeholder="Pengeluaran (1/2/3/4)" require>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewkepkel">Submit</button>
                </div>
                </form>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <!-- Modal Tambah End -->

                
            </div>
            </div>
        </div>
</html>
