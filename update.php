<?php 
    include 'db_connection.php';
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    $response= [];

    try {
        if($isbn != '' && $judul != '') {
                $queryselect = "SELECT * FROM table_buku WHERE `isbn`='$isbn'";
                
                $statement = $con->query($queryselect);
                $row = $statement->rowCount();
                // $response['data'] = $results;
                if($row){
                    $query = "UPDATE `table_buku` SET `judul`=? WHERE `isbn`=?";
                    $statement = $con->prepare($query);
                    $execute = $statement->execute([$judul, $isbn]);

                    if($execute){
                        $statement = $con->query($queryselect);
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        $results =$statement->fetchAll();

                        $response['data'] = $results;

                        $response['code']  = 1;
                        $response['message'] = 'Data berhasil diupdate';

                    } else {
                        $response['code'] = 0;
                        $response['message'] = 'Gagal dalam mengupdate data';
                    }

                } else {
                    $response['row'] =$row;
                    $response['rowstatus'] = 'ISBN salah';
                }

        } else {
            $response['code'] = 0;
            $response['message'] = 'Data isbn dan judul tidak boleh kosong';
            $response['data'] = [$isbn, $judul];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (PDOException $e) {
    echo $e->getMessage();
}