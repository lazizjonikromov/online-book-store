<?php
session_start();

include "db_conn.php";

include "php/func-book.php";
$books = get_all_books($conn);

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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($categories == 0) { ?>

                            <?php } else { ?>
                                <?php foreach ($categories as $category) { ?>
                                    <li>
                                        <a class="dropdown-item" href="category.php?id=<?= $category['id'] ?>"><?= $category['name'] ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Author
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($authors == 0) { ?>

                            <?php } else { ?>
                                <?php foreach ($authors as $author) { ?>
                                    <li>
                                        <a class="dropdown-item" href="author.php?id=<?= $author['id'] ?>"><?= $author['name'] ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            </ul>
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

        <form action="search.php" style="width: 100%; max-width:30rem;">
            <div class="input-group my-5">
                <input type="text" class="form-control" placeholder="Search Book..." aria-label="Search Book..." aria-describedby="basic-addon2" name="key">
                <button class="input-group-text btn btn-primary" id="basic-addon2">
                    <img src="img/search.png" alt="" width="25">
                </button>
            </div>
        </form>

        <div class="d-flex pt-3">
            <?php if ($books == 0) { ?>
                <div class="alert alert-warning text-center p-5" role="alert">
                    <img src="img/empty.jpg" width="100">
                    <br>
                    There is no book in the database
                </div>
            <?php } else { ?>
                <div class="d-flex flex-wrap">
                    <?php foreach ($books as $book) { ?>
                        <div class="d-flex m-1 col-md-12" id="store-books" style="border: 2px solid grey; padding:15px;">
                            <div class="col-md-3" id="store-img">
                                <img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top" height="300">
                            </div>
                            <div class="card-body col-md-9">
                                <h5 class="card-title"><?= $book['title'] ?></h5>
                                <p class="card-text">
                                    <i><b>
                                            By:

                                            <?php foreach ($authors as $author) {
                                                if ($author['id'] == $book['author_id']) {
                                                    echo $author['name'];
                                                    break;
                                                }
                                            ?>

                                            <?php } ?>

                                            <br></b></i>

                                    <?= $book['description'] ?>

                                    <br>
                                    <i><b>
                                            Category:

                                            <?php foreach ($categories as $category) {
                                                if ($category['id'] == $book['category_id']) {
                                                    echo $category['name'];
                                                    break;
                                                }
                                            ?>

                                            <?php } ?>

                                        </b></i>
                                </p>
                                <a href="uploads/files/<?= $book['file'] ?>" class="btn btn-success">Open</a>

                                <a href="uploads/files/<?= $book['file'] ?>" class="btn btn-primary" download="<?= $book['title'] ?>">Download</a>
                            </div>
                        </div>
                    <?php } ?>
                    <br><br>
                </div>
            <?php } ?>
            <div class="category" style="margin-left: 25px;" id="sidebar">
                <div class="list-group" style="width: 200px;">
                    <?php if ($categories == 0) { ?>

                    <?php } else { ?>
                        <a href="#" class="list-group-item list-group-item-action active">Category</a>
                        <?php foreach ($categories as $category) { ?>
                            <a href="category.php?id=<?= $category['id'] ?>" class="list-group-item list-group-item-action"><?= $category['name'] ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="list-group mt-5" style="width: 200px;">
                    <?php if ($authors == 0) { ?>

                    <?php } else { ?>
                        <a href="#" class="list-group-item list-group-item-action active">Author</a>
                        <?php foreach ($authors as $author) { ?>
                            <a href="author.php?id=<?= $author['id'] ?>" class="list-group-item list-group-item-action"><?= $author['name'] ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>