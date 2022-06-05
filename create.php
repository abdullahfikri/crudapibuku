<?php
    include "db_connection.php";

    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $abstrak = $_POST['abstrak'];

    $jumlah = intval($jumlah);
//    $tanggal = date('Y-m-d', $tanggal);
$response= [];
$response['data'] = [$isbn, $judul, $pengarang, $jumlah, $tanggal, $abstrak];
try {

    if ($isbn != '' && $judul != '' && $pengarang !='' && $jumlah != null && $tanggal !='' && $abstrak != ''){
        $query = "INSERT INTO `table_buku`(`isbn`, `judul`, `pengarang`, `jumlah`, `tanggal`, `abstrak`) VALUES ('$isbn','$judul','$pengarang', $jumlah,'$tanggal','$abstrak')";


        if($con->exec($query)){
            $response['code']  = 1;
            $response['message'] = 'Data berhasil diinputkan';
        } else {
            $response['code'] = 0;
            $response['message'] = 'Gagal dalam menginputkan data';
        }


    } else{
        $response['code'] = 0;
        $response['message'] = 'Data tidak boleh kosong';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}catch (PDOException $e) {
    echo $e->getMessage();
}

