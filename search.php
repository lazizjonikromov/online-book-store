<?php 
    session_start();

    if(!isset($_GET['key']) || empty($_GET['key'])){
        header("Location: index.php");
        exit;
    }
    $key = $_GET['key'];
    
    include "db_conn.php";

    include "php/func-book.php";
    $books = search_books($conn, $key);

    include "php/func-author.php";
    $authors = get_all_author($conn);

    include "php/func-category.php";
    $categories = get_all_categories($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Online Book Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <a class="nav-link" href="admin.php">Admin</a>
                            <?php } else { ?>
                                <a class="nav-link" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <h4>Search result for <b>"<?=$key?>"</b></h4>

        <div class="d-flex pt-3">
            <?php if($books == 0){ ?>
                <div class="alert alert-warning text-center p-5 pdf-list" role="alert">
                    <img src="img/empty-search.png" width="50">
                    <br>
                    The key <b>"<?=$key?>"</b> didn't match to any record in the database
                </div>
            <?php }else{ ?>
                <div class="d-flex flex-wrap">
                    <?php foreach($books as $book) { ?>
                        <br>
                        <div class="d-flex m-1 col-md-12" id="search-books" style="border: 2px solid grey; padding:15px;">
                            <div class="col-md-2" id="search-img">
                                <img src="uploads/cover/<?=$book['cover']?>" class="card-img-top" height="300">
                            </div>
                            <div class="card-body col-md-10">
                                <h5 class="card-title"><?=$book['title']?></h5>
                                <p class="card-text">
                                    <i><b>
                                        By: 

                                        <?php foreach($authors as $author) {
                                                if($author['id'] == $book['author_id']){
                                                    echo $author['name'];
                                                    break;
                                                } 
                                        ?>

                                        <?php } ?>

                                    <br></b></i>

                                    <?=$book['description']?>
                                    
                                    <br>
                                    <i><b>
                                        Category: 

                                        <?php foreach($categories as $category) {
                                                if($category['id'] == $book['category_id']){
                                                    echo $category['name'];
                                                    break;
                                                } 
                                        ?>

                                        <?php } ?>

                                    </b></i>
                                </p>
                                <a href="uploads/files/<?=$book['file']?>" class="btn btn-success">Open</a>

                                <a href="uploads/files/<?=$book['file']?>" class="btn btn-primary" download="<?=$book['title']?>">Download</a>
                            </div>
                        </div>
                    <?php } ?>
                    <br><br>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>