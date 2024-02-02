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
        <title>Hasil</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/proses.css" rel="stylesheet" />
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
            
            <?php
            // $query = $conn->query("SELECT * FROM dt_lok m, data_prov s WHERE s.id_prov = m.id_prov");
            $query = $conn->query("SELECT * FROM data_prov");
            
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $data=[];
            $nama_kk=[];
            while($row=$query->fetch_assoc()){
              $data[]=$row;
              $nama_kk[]=$row['nama_kk'];
            }
            //hitung Euclidean Distance Space
            function jarakEuclidean($data=array(),$centroid=array()){
              return sqrt(pow(($data[0]-$centroid[0]),2) + pow(($data[1]-$centroid[1]),2) + pow(($data[2]-$centroid[2]),2) + pow(($data[3]-$centroid[3]),2)); 
            }

            function jarakTerdekat($jarak_ke_centroid=array(),$centroid){
              foreach ($jarak_ke_centroid as $key => $value) {
                if(!isset($minimum)){
                  $minimum=$value;
                  $cluster=($key+1);
                  continue;
                }
                else if($value<$minimum){
                  $minimum=$value;
                  $cluster=($key+1);
                }
              }
              return array(
                'cluster'=>$cluster,
                'value'=>$minimum,
              );
            }

            function perbaruiCentroid($table_iterasi,&$hasil_cluster){
              $hasil_cluster=[];
              //looping untuk mengelompokan x dan y sesuai cluster
              foreach ($table_iterasi as $key => $value) {
                $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][0][]= $value['data'][0];//data x
                $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][1][]= $value['data'][1];//data y
                $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][2][]= $value['data'][2];//data y
                $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][3][]= $value['data'][3];//data y
              }
              $new_centroid=[];
              //looping untuk mencari nilai centroid baru dengan cara mencari rata2 dari masing2 data(0=x dan 1=y) 
              foreach ($hasil_cluster as $key => $value) {
                $new_centroid[$key]= [
                  array_sum($value[0])/count($value[0]),
                  array_sum($value[1])/count($value[1]),
                  array_sum($value[2])/count($value[2]),
                  array_sum($value[3])/count($value[3])
                ]; 
              }
              //sorting berdasarkan cluster
              ksort($new_centroid);
              return $new_centroid;
            }

            function centroidBerubah($centroid,$iterasi){
              $centroid_lama = flatten_array($centroid[($iterasi-1)]); //flattern array
              $centroid_baru = flatten_array($centroid[$iterasi]); //flatten array
              //hitbandingkan centroid yang lama dan baru jika berubah return true, jika tidak berubah/jumlah sama=0 return false
              $jumlah_sama=0;
              for($i=0;$i<count($centroid_lama);$i++){
                if($centroid_lama[$i]===$centroid_baru[$i]){
                  $jumlah_sama++;
                }
              }
              return $jumlah_sama===count($centroid_lama) ? false : true; 
            }

            function flatten_array($arg) {
              return is_array($arg) ? array_reduce($arg, function ($c, $a) { return array_merge($c, flatten_array($a)); },[]) : [$arg];
            }

            function pointingHasilCluster($hasil_cluster){
              $result=[];
              foreach ($hasil_cluster as $key => $value) {
                for ($i=0; $i<count($value[0]);$i++) { 
                  $result[$key][]=[$hasil_cluster[$key][0][$i],$hasil_cluster[$key][1][$i],$hasil_cluster[$key][2][$i],$hasil_cluster[$key][3][$i]];
                }
              }
              return ksort($result);
            }

            //start program
            // get data dari database
            // cek koneksi
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              exit;
            }
            // $query = $conn->query("SELECT * FROM dt_lok m, data_prov s WHERE s.id_prov = m.id_prov");
            $query = $conn->query("SELECT * FROM data_prov");
            $data=[];
            //masukan data ke array data
            while($row=$query->fetch_assoc()){
              $data[]=[$row['tahun_2019'],$row['tahun_2020'], $row['tahun_2021'], $row['tahun_2022']];
            }
            
            //jumlah cluster
            $cluster = 3;
            $variable_x = '2019';
            $variable_x1 = '2020';
            $variable_y = '2021';
            $variable_y1 = '2022';

            $pusat = 
            [
              [
                [2,3,3,2]
              ],
              [
                [2,3,2,2]
              ],
              [
                [1,2,4,1]
              ]
            ];
            $rand=[];
            //centroid awal ambil random dari data
            for($i=0;$i<$cluster;$i++){
              $temp = rand (0, count(($pusat))-1);
              while (in_array ($temp, $rand)){
                $temp = rand (0, count(($pusat))-1);
              }
              $rand[]=$temp;
              $centroid[0][]=[
                $data[$rand[$i]][0],
                $data[$rand[$i]][1],
                $data[$rand[$i]][2],
                $data[$rand[$i]][3]
              ];
            }
            
            $hasil_iterasi=[];
            $hasil_cluster=[];

            //iterasi
            $iterasi=0;
            while(true){
              $table_iterasi=array();
              //untuk setiap data ke i (x dan y)
              foreach ($data as $key => $value) {
                //untuk setiap table centroid pada iterasi ke i
                $table_iterasi[$key]['data']=$value;
                foreach ($centroid[$iterasi] as $key_c => $value_c) {
                  //hitung jarak euclidean 
                  $table_iterasi[$key]['jarak_ke_centroid'][]=jarakEuclidean($value,$value_c);	
                }
                //hitung jarak terdekat dan tentukan cluster nya
                $table_iterasi[$key]['jarak_terdekat']=jarakTerdekat($table_iterasi[$key]['jarak_ke_centroid'],$centroid);
              }
              array_push($hasil_iterasi, $table_iterasi);
              $centroid[++$iterasi]=perbaruiCentroid($table_iterasi,$hasil_cluster);
              $lanjutkan=centroidBerubah($centroid,$iterasi);
              $boolval = boolval($lanjutkan) ? 'ya' : 'tidak';
              // echo 'proses iterasi ke-'.$iterasi.' : lanjutkan iterasi ? '.$boolval.'<br>';
              if(!$lanjutkan)
                break;
              //loop sampai setiap nilai centroid sama dengan nilai centroid sebelumnya
            } 
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Proses K-Means</h1>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- <a class="btn btn-primary" href="#">
                                    PROSES
                                </a> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                  <h3>Inisialisasi</h3>
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th rowspan>Centroid</th>
                                            <th rowspan><?php echo $variable_x; ?></th>
                                            <th rowspan><?php echo $variable_x1; ?></th>
                                            <th rowspan><?php echo $variable_y; ?></th>
                                            <th rowspan><?php echo $variable_y1; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($centroid[0] as $key_c => $value_c) { ?>
                                            <tr>
                                              <td>C<?php echo ($key_c+1); ?></td>
                                              <td><?php echo $value_c[0]; ?></td>
                                              <td><?php echo $value_c[1]; ?></td>
                                              <td><?php echo $value_c[2]; ?></td>
                                              <td><?php echo $value_c[3]; ?></td>
                                            </tr>
                                            <?php 
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                  </div>
                            </div>

                            <?php
                            foreach ($hasil_iterasi as $key => $value) ?>
                            <div class="card-body">
                              <div class="table-responsive">
                                <h4>Iterasi Ke-<?php echo $key+1 ?></h4>
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th rowspan="1" class="text-center">Centroid</th>
                                      <th rowspan="1" class="text-center"><?php echo $variable_x; ?></th>
                                      <th rowspan="1" class="text-center"><?php echo $variable_x1; ?></th>
                                      <th rowspan="1" class="text-center"><?php echo $variable_y; ?></th>
                                      <th rowspan="1" class="text-center"><?php echo $variable_y1; ?></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($centroid[$key] as $key_c => $value_c) { ?>
                                    <tr>
                                      <td class="text-center">C<?php echo ($key_c+1); ?></td>
                                      <td class="text-center"><?php echo number_format($value_c[0],2); ?></td>
                                      <td class="text-center"><?php echo number_format($value_c[1],2); ?></td>
                                      <td class="text-center"><?php echo number_format($value_c[2],2); ?></td>
                                      <td class="text-center"><?php echo number_format($value_c[3],2); ?></td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="table-responsive">
                              <table class="table table-bordered" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th rowspan="2" class="text-center">Data ke i</th>
                                  <th rowspan="2" class="text-center">Nama</th>
                                  <th rowspan="2" class="text-center"><?php echo $variable_x; ?></th>
                                  <th rowspan="2" class="text-center"><?php echo $variable_x1; ?></th>
                                  <th rowspan="2" class="text-center"><?php echo $variable_y; ?></th>
                                  <th rowspan="2" class="text-center"><?php echo $variable_y1; ?></th>
                                  <th rowspan="1" class="text-center" colspan="<?php echo $cluster; ?>">Jarak ke centroid</th>
                                  <!-- <th rowspan="2" class="text-center" >Jarak terdekat</th> -->
                                  <th rowspan="2" class="text-center">Cluster</th>
                                </tr>
                                <tr>
                                <?php for ($i=1; $i <=$cluster ; $i++) { ?> 
                                  <th rowspan="1" class="text-center"><?php echo $i; ?></th>
                                <?php }?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($value as $key_data => $value_data) { ?>
                                <tr>
                                  <td class="text-center"><?php echo $key_data+1; ?></td>
                                  <td class="text-center"><?php echo $nama_kk[$key_data]; ?></td>
                                  <td class="text-center"><?php echo $value_data['data'][0]; ?></td>
                                  <td class="text-center"><?php echo $value_data['data'][1]; ?></td>
                                  <td class="text-center"><?php echo $value_data['data'][2]; ?></td>
                                  <td class="text-center"><?php echo $value_data['data'][3]; ?></td>
                                  <?php
                                  foreach ($value_data['jarak_ke_centroid'] as $key_jc => $value_jc) { ?>
                                    <td class="text-center"><?php echo number_format($value_jc,2); ?></td>
                                  <?php 
                                  }
                                  ?>
                                  <!-- <td class="text-center"><?php echo number_format($value_data['jarak_terdekat']['value'],2); ?></td> -->
                                  <td class="text-center">C<?php echo $value_data['jarak_terdekat']['cluster']; ?></td>
                                </tr>

                                <?php } ?>
                              </tbody>
                              </table>
                            
                            </div>
                            <?php
                            // }
                            
                            ?>
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

</html>
