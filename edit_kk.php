<?php
$conn = mysqli_connect("localhost", "root", "", "bayukmeans");
    // editkk
    if(isset($_POST['editkepkel'])){
        $id_prov = $_GET['id_prov'];
        $namakk = $_POST['namakepkel'];
        $tahun_2019 = $_POST['tahun_2019'];
        $tahun_2020 = $_POST['tahun_2020'];
        $tahun_2021 = $_POST['tahun_2021'];
        $tahun_2022 = $_POST['tahun_2022'];

        $update = "UPDATE data_prov SET nama_kk='$namakk', tahun_2019='$tahun_2019', tahun_2020='$tahun_2020', tahun_2021='$tahun_2021', tahun_2022='$tahun_2022' WHERE id_prov='$id_prov'";
    
        // $addtotable = mysqli_query($conn, "INSERT into data_prov (nama_kk, tahun_2019, tahun_2020, tahun_2021, tahun_2022) values('$namakk', '$tahun_2019', '$tahun_2020', '$tahun_2021', '$tahun_2022')");
        if($update){
        header('location:index.php');
        } else {
        echo 'gagal!';
        header('location:index.php');
        }
    }
?>