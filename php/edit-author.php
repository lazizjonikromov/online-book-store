<?php 

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "../db_conn.php";

        if(isset($_POST['author_name']) && isset($_POST['author_id']) )
        {
            $name = $_POST['author_name'];
            $id = $_POST['author_id'];

            if(empty($name))
            {
                $em = "The author name is required";
                header("Location: ../edit-author.php?error=$em&id=$id");
                exit;
            }
            else{
                $sql = "update authors set name=? where id=?";
                $stmt = $conn->prepare($sql);
                $res =  $stmt->execute([$name, $id]);

                if($res){
                    $sm = "Successfully updated!";
                    header("Location: ../edit-author.php?success=$sm&id=$id");
                    exit;
                }else{
                    $em = "Unknown Error Occurred!";
                    header("Location: ../edit-author.php?error=$em&id=$id");
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