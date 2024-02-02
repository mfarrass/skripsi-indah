<?php
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "kmeans");

// tambah barang
if(isset($_POST['addnewkepkel'])){
  $namakk = $_POST['namakepkel'];
  $tahun_2019 = $_POST['tahun_2019'];
  $tahun_2020 = $_POST['tahun_2020'];
  $tahun_2021 = $_POST['tahun_2021'];
  $tahun_2022 = $_POST['tahun_2022'];

  $addtotable = mysqli_query($conn, "INSERT into data_prov (nama_kk, tahun_2019, tahun_2020, tahun_2021, tahun_2022) values('$namakk', '$tahun_2019', '$tahun_2020', '$tahun_2021', '$tahun_2022')");
  if($addtotable){
    header('location:input_kk.php');
  } else {
    echo 'gagal!';
    header('location:input_kk.php');
  }
}

// Edit Data KepKel
if(isset($_POST['editdata-kk'])){
  $idprov = $_POST['idprov'];
  $namakk = $_POST['namakepkel'];
  $tahun_2019 = $_POST['tahun_2019'];
  $tahun_2020 = $_POST['tahun_2020'];
  $tahun_2021 = $_POST['tahun_2021'];
  $tahun_2022 = $_POST['tahun_2022'];

  $update = mysqli_query ($conn, "UPDATE data_prov SET nama_kk='$namakk', tahun_2019='$tahun_2019', tahun_2020='$tahun_2020', tahun_2021='$tahun_2021', tahun_2022='$tahun_2022' WHERE id_prov='$idprov'");
  if($update){
    header ('Location:input_kk.php');
  } else {
    echo 'Gagal!';
    header ('Location.input_kk.php');
  }
}
// End Edit Kepkel

// Hapus Kepkel
if(isset($_POST['hapusdata-kk'])){
  $idprov = $_POST['idprov'];

  $hapus = mysqli_query($conn, "DELETE FROM data_prov WHERE id_prov = '$idprov'");
  if($hapus){
    header ('Location:input_kk.php');
  } else {
    echo 'Gagal!';
    header ('Location.input_kk.php');
  }
}
// End Kepkel

// Edit Data Lokasi
if(isset($_POST['editdata-lok'])){
  $idlok = $_POST['idlok'];
  $id_prov = $_POST['idprov'];
  $alamat = $_POST['alamat'];
  $lat = $_POST['lat'];
  $longit = $_POST['longit'];

  $updatelok = mysqli_query ($conn, "UPDATE dt_lok SET alamat='$alamat', lat='$lat', longit='$longit' WHERE id_lok='$idlok'");
  if($updatelok){
    header ('Location:masuk.php');
  } else {
    echo 'Gagal!';
    header ('Location.masuk.php');
  }
}
// End Edit Lokasi

// tambah barang masuk
if(isset($_POST['barangmasuk'])){
  $namanya = $_POST['namanya'];
  $alamat = $_POST['alamat'];
  $lat = $_POST['lat'];
  $longit = $_POST['longit'];

  $addtomasuk = mysqli_query($conn, "INSERT INTO dt_lok (id_prov, alamat, lat, longit) values ('$namanya', '$alamat', '$lat', '$longit')");
  if($addtomasuk){
    header('location:masuk.php');
  } else {
    echo 'gagal!';
    header('location:masuk.php');
  }
}

// tambah barang keluar
if(isset($_POST['addbarangkeluar'])){
  $barangnya = $_POST['barangnya'];
  $penerima = $_POST['penerima'];

  $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima) values ('$barangnya', '$penerima')");
  if($addtokeluar){
    header('location:keluar.php');
  } else {
    echo 'gagal!';
    header('location:keluar.php');
  }
}

?>