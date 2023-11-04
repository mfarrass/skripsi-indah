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
        <title>Data Lokasi</title>
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
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
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
                        <h1 class="mt-4">Input Alamat</h1>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Input Alamat
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Kepala Keluarga</th>
                                                <th>Alamat</th>
                                                <th>Long</th>
                                                <th>Lat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM dt_lok m, dt_kk s WHERE s.id_kk = m.id_kk");
                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $idlok = $data['id_lok'];
                                                $id_kk = $data['id_kk'];
                                                $namakk = $data['nama_kk'];
                                                $alamat = $data['alamat'];
                                                $lat = $data['lat'];
                                                $longit = $data['longit'];
                                            ?>

                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $namakk ?></td>
                                                <td><?php echo $alamat ?></td>
                                                <td><?php echo $lat ?></td>
                                                <td><?php echo $longit ?></td>
                                                <td>
                                                <!-- Button trigger modal Edit-->
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modaledit-lok<?=$idlok?>">
                                                <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modaledit-lok<?=$idlok?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Alamat</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal Tambah Start -->
                                                    <!-- Modal Tambah body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    <br>
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" value="<?= $alamat?>" require>
                                                    <br>
                                                    <label for="lat">Latitude</label>
                                                    <input type="number" name="lat" class="form-control" value="<?= $lat?>" require>
                                                    <br>
                                                    <label for="longit">Longitude</label>
                                                    <input type="number" name="longit" class="form-control" value="<?= $longit?>" require>
                                                    <br>
                                                    <input type="hidden" name="idlok" value="<?=$idlok?>">
                                                    <input type="hidden" name="idkk" value="<?=$id_kk?>">
                                                    <button type="submit" class="btn btn-primary" name="editdata-lok">Submit</button>
                                                    </div>
                                                    </form>
                                                    
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                    <!-- Modal Edit End -->
                                                <!-- Button trigger modal Hapus-->
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalhapus<?= $id_kk ?>">
                                                <i class="fas fa-trash"></i>
                                                </button>
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
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Input Alamat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="post">
                <div class="modal-body">

                <select name="namanya" class="form-control">
                    <?php
                    $getdata = mysqli_query($conn,"SELECT * FROM dt_kk ORDER BY id_kk DESC");
                        while ($fetcharray = mysqli_fetch_array($getdata)){
                            $namakk = $fetcharray['nama_kk'];
                            $idkk = $fetcharray['id_kk'];
                    ?>

                        <option value="<?php echo $idkk ?>"><?php echo $namakk ?></option>

                    <?php
                    }
                    ?>
                </select>
                <br>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" require>
                <br>
                <input type="text" name="lat" class="form-control" placeholder="Latitude" require>
                <br>
                <input type="text" name="longit" class="form-control" placeholder="Longitude" require>
                <br>
                <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                </div>
                </form>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            </div>
        </div>
</html>
