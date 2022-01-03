<?php

    function get_all_books($con){
        $sql = "select * from books order by id desc";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $books = $stmt->fetchAll();
        }else{
            $books = 0;
        }

        return $books;
    }

    function get_book($con , $id){
        $sql = "select * from books where id=?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $book = $stmt->fetch();
        }else{
            $book = 0;
        }

        return $book;
    }

    function search_books($con, $key){
        $key = "%{$key}%";

        $sql = "select * from books where title like ? or description like ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$key, $key]);

        if($stmt->rowCount() > 0){
            $books = $stmt->fetchAll();
        }else{
            $books = 0;
        }

        return $books;
    }

    function get_books_by_category($con , $id){
        $sql = "select * from books where category_id=?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $books = $stmt->fetchAll();
        }else{
            $books = 0;
        }

        return $books;
    }

    function get_books_by_author($con , $id){
        $sql = "select * from books where author_id=?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $books = $stmt->fetchAll();
        }else{
            $books = 0;
        }

        return $books;
    }
?>