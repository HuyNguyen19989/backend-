@extends('layout.head')
@section('content')
<h1><?php echo $book->book_name; ?></h1>
<form action='info' method='post'>
    <p>Tên :<input type="text" name="book_name" value="<?php echo $book->book_name; ?>" ></p>
    <input type="hidden" name="id" value="<?php echo $book->id?>">
    <p>Tác giả :<input type="text" name="author" value="<?php echo $book->author; ?>" ></p>
    <p>Thể loại :<input type="text" name="category" value="<?php echo $book->book_category; ?>"> </p>
    <p>Mô tả :</p><textarea name="description" style="width:50%;height:100px"><?php echo $book->description; ?>  </textarea> 
    @csrf
    <br>
   <p> 
       {{--Phần hiện thông báo  --}}
    @foreach (['error', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}" style="color:red";>{{ Session::get('alert-' . $msg) }} </p>
    @endif
  @endforeach     
  
  
</p>  
    <button type="submit">Thay đổi</button>
</form>  
    
    
    <h3>Danh sách các chương </h3>
    <table>
        <tr>
        <th>Tên chương</th>
        <th>Tên file</th>
        </tr>
     <?php 
        foreach($chapter as $chap){
            $url='./'.$book->book_name.'/'.$chap->id;?>
        <tr>
          <td><?php echo $chap->title; ?></td>
          <td><a href=<?php echo asset($chap->url)?>><?php echo $chap->filename?></a></td>
          <td>
                <form action='delete' method='post'>
                    <input type="hidden" name="id" value="<?php echo $chap->id?>">
                    @csrf
                    <button type="submit">Xóa</button>
                </form>
          </td>
        </tr>
       <?php }?>
</table>
<h3>Thêm chương mới</h3>
{{--Phần hiện thông báo  --}}
@foreach (['fileerror', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))

<p class="alert alert-{{ $msg }}" style="color:red";>{{ Session::get('alert-' . $msg) }} </p>
@endif
@endforeach     
<p>
<form action="newchap" method="POST" enctype="multipart/form-data">
    <input type="hidden" value='<?php echo $book->id?>' name="bookID">
    Tên chương mới :<input type="text" name="title">
    Chọn file :<input type="file" name="mp3">
    @csrf
    <button type="submit" name="upload">Thêm chương mới</button>
</form>
@endsection
