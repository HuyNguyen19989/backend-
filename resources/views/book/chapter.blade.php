@extends('layout.head')
@section('content')

<h1><?php echo $book->book_name ?></h1>

<h2><?php
echo $chapter->title;
 ?></h2>
    <audio controls>
        <source src="<?php echo asset($chapter->url); ?>" type="audio/mpeg">
      </audio>
  <p>     
<?php if($prev){ ?>
  <a href= <?php echo "./".$prev->id  ?>>Chương trước</a>
<?php }?>      
<a href=<?php echo asset("books/".$book->id) ?>>Danh mục</a>
<?php if($next){ ?>
 <a href= <?php echo "./".$next->id  ?>>Chương sau</a>
<?php }?>
@endsection
