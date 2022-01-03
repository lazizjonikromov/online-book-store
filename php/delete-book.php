<?php 

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "../db_conn.php";

        if(isset($_GET['id']) )
        {
            $id = $_GET['id'];

            if(empty($id))
            {
                $em = "Error Occurred!";
                header("Location: ../admin.php?error=$em");
                exit;
            }
            else{
                $sql2 = "select * from books where id=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$id]);
                $the_book = $stmt2->fetch();

                if($stmt2->rowCount() > 0){
                    $sql = "delete from books where id=?";
                    $stmt = $conn->prepare($sql);
                    $res =  $stmt->execute([$id]);

                    if($res){

                        $cover = $the_book['cover'];
                        $file = $the_book['file'];

                        $c_b_c = "../uploads/cover/$cover";
                        $c_f = "../uploads/files/$file";

                        unlink($c_b_c);
                        unlink($c_f);
                        

                        $sm = "Successfully removed!";
                        header("Location: ../admin.php?success=$sm");
                        exit;
                    }else{
                        $em = "Unknown Error Occurred!";
                        header("Location: ../admin.php?error=$em");
                        exit;
                    }
                }else{
                    $em = "Error Occurred!";
                    header("Location: ../admin.php?error=$em");
                    exit;
                }

                
            }
        }
        else
        {
            header("Location: ../admin.php");
            exit;
        }


    } else {
        header("Location: ../login.php");
        exit;
    }

?>