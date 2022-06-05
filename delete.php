<?php

    include 'db_connection.php';
    $isbn = $_POST['isbn'];
    $response= [];

    try {
        // Cek apakah isbn tidak kosong
        if($isbn != '') {
                $queryselect = "SELECT * FROM table_buku WHERE `isbn`='$isbn'";
                
                $statement = $con->query($queryselect);
                $row = $statement->rowCount();

                // Mengecek apakah data ditemukan
                if($row){
                    // 
                    $query = "DELETE FROM `table_buku` WHERE `isbn`='$isbn'";
                    
                    // Mengecek apakah data berhasil didelete
                    if($con->exec($query)){
                        $response['code']  = 1;
                        $response['message'] = 'Data berhasil dihapus';
                    } else {
                        $response['code'] = 0;
                        $response['message'] = 'Gagal dalam menghapus data';
                    }

                } else {
                    $response['row'] =$row;
                    $response['rowstatus'] = 'ISBN salah';
                }
        }else {
            $response['message'] = 'Data isbn tidak boleh kosong';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }