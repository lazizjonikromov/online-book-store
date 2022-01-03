<?php

    function get_all_author($con){
        $sql = "select * from authors";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0 ){
            $authors = $stmt->fetchAll();
        }else{
            $authors = 0;
        }

        return $authors;
    }

    function get_author($con , $id){
        $sql = "select * from authors where id=?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0 ){
            $author = $stmt->fetch();
        }else{
            $author = 0;
        }

        return $author;
    }
    
?>