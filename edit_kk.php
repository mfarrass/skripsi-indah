<?php
$conn = mysqli_connect("localhost", "root", "", "bayukmeans");
    // editkk
    if(isset($_POST['editkepkel'])){
        $id_kk = $_GET['id_kk'];
        $namakk = $_POST['namakepkel'];
        $pendidikan = $_POST['pendidikan'];
        $pekerjaan = $_POST['pekerjaan'];
        $tanggungan = $_POST['tanggungan'];
        $pengeluaran = $_POST['pengeluaran'];

        $update = "UPDATE dt_kk SET nama_kk='$namakk', pendidikan='$pendidikan', pekerjaan='$pekerjaan', tanggungan='$tanggungan', pengeluaran='$pengeluaran' WHERE id_kk='$id_kk'";
    
        // $addtotable = mysqli_query($conn, "INSERT into dt_kk (nama_kk, pendidikan, pekerjaan, tanggungan, pengeluaran) values('$namakk', '$pendidikan', '$pekerjaan', '$tanggungan', '$pengeluaran')");
        if($update){
        header('location:index.php');
        } else {
        echo 'gagal!';
        header('location:index.php');
        }
    }
?>