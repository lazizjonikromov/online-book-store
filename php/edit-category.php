<?php 

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "../db_conn.php";

        if(isset($_POST['category_name']) && isset($_POST['category_id']) )
        {
            $name = $_POST['category_name'];
            $id = $_POST['category_id'];

            if(empty($name))
            {
                $em = "The category name is required";
                header("Location: ../edit-category.php?error=$em&id=$id");
                exit;
            }
            else{
                $sql = "update categories set name=? where id=?";
                $stmt = $conn->prepare($sql);
                $res =  $stmt->execute([$name, $id]);

                if($res){
                    $sm = "Successfully updated!";
                    header("Location: ../edit-category.php?success=$sm&id=$id");
                    exit;
                }else{
                    $em = "Unknown Error Occurred!";
                    header("Location: ../edit-category.php?error=$em&id=$id");
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