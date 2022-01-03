<?php

    function get_all_categories($con){
        $sql = "select * from categories";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0 ){
            $categories = $stmt->fetchAll();
        }else{
            $categories = 0;
        }

        return $categories;
    }

    function get_category($con , $id){
        $sql = "select * from categories where id=?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0 ){
            $category = $stmt->fetch();
        }else{
            $category = 0;
        }

        return $category;
    }


?>