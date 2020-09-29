@extends('layout.head')
@section('content')

    <h1><?php echo $info->book_name; ?></h1>
    <p>Tác giả :<?php echo $info->author; ?> </p>
    <p>Thể loại :<?php echo $info->book_category; ?> </p>
    <p>Mô tả :<?php echo $info->description; ?> </p>
    <h3>Danh sách các chương </h3>
      <?php 

        foreach($chapter as $chap){
            $url='./'.$info->book_name.'/'.$chap->id;
         ?>
          <p><a href="<?php echo $url ?>"> <?php echo $chap->title; ?> </a></p>
       <?php }?>
    
@endsection
