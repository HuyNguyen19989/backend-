<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Danh sách</title>
</head>
<body>
    <h1>Danh sách những sách hiện có trong thư viện</h1>
        <?php
    foreach ($books as $book){
        $url='./books/'.$book->id;
        ?>
  <p> <a href="<?php echo $url;?>">  <?php echo $book->book_name;?> </a></p>
   <?php }   ?>
</body>
</html>