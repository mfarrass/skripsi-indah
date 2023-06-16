<?php
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "bayukmeans");

// tambah barang
if(isset($_POST['addnewkepkel'])){
  $namakk = $_POST['namakepkel'];
  $pendidikan = $_POST['pendidikan'];
  $pekerjaan = $_POST['pekerjaan'];
  $tanggungan = $_POST['tanggungan'];
  $pengeluaran = $_POST['pengeluaran'];

  $addtotable = mysqli_query($conn, "INSERT into dt_kk (nama_kk, pendidikan, pekerjaan, tanggungan, pengeluaran) values('$namakk', '$pendidikan', '$pekerjaan', '$tanggungan', '$pengeluaran')");
  if($addtotable){
    header('location:input_kk.php');
  } else {
    echo 'gagal!';
    header('location:input_kk.php');
  }
}

// Edit Data KepKel
if(isset($_POST['editdata-kk'])){
  $idkk = $_POST['idkk'];
  $namakk = $_POST['namakepkel'];
  $pendidikan = $_POST['pendidikan'];
  $pekerjaan = $_POST['pekerjaan'];
  $tanggungan = $_POST['tanggungan'];
  $pengeluaran = $_POST['pengeluaran'];

  $update = mysqli_query ($conn, "UPDATE dt_kk SET nama_kk='$namakk', pendidikan='$pendidikan', pekerjaan='$pekerjaan', tanggungan='$tanggungan', pengeluaran='$pengeluaran' WHERE id_kk='$idkk'");
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
  $idkk = $_POST['idkk'];

  $hapus = mysqli_query($conn, "DELETE FROM dt_kk WHERE id_kk = '$idkk'");
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
  $id_kk = $_POST['idkk'];
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

  $addtomasuk = mysqli_query($conn, "INSERT INTO dt_lok (id_kk, alamat, lat, longit) values ('$namanya', '$alamat', '$lat', '$longit')");
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