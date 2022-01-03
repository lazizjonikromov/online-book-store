<?php 

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    
        include "../db_conn.php";

        if(isset($_POST['category_name']))
        {
            $name = $_POST['category_name'];
            if(empty($name))
            {
                $em = "The category name is required";
                header("Location: ../add-category.php?error=$em");
                exit;
            }
            else{
                $sql = "insert into categories (name) values(?)";
                $stmt = $conn->prepare($sql);
                $res =  $stmt->execute([$name]);

                if($res){
                    $sm = "Successfully created!";
                    header("Location: ../add-category.php?success=$sm");
                    exit;
                }else{
                    $em = "Unknown Error Occurred!";
                    header("Location: ../add-category.php?error=$em");
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