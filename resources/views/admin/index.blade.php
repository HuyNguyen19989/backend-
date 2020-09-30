<h1> Đây là trang của admin</h1>
<table>
<tr>
    <th>Tên sách</th>
    <th>Tác giả</th>
    <th>Thể loại</th>
  </tr>
<?php foreach($books as $book){ ?>
    <tr>
        <td><?php echo $book->book_name; ?></td>
        <td><?php echo $book->author; ?></td>
        <td><?php echo $book->book_category; ?></td>
        <td>
            <form action="./admin/edit/<?php echo $book->id ?>" method="POST">
            @csrf
            <button type="summit" name="edit">Sửa</button>
            </form>
        </td>
        <td>
            <form action='admin/delete' method='post'>
                <input type="hidden" name="id" value="<?php echo $book->id?>">
                @csrf
                <button type="submit">Xóa</button>
            </form>
      </td>
      </tr>


<?php } ?>
</table>
<p>Thêm sách mới
<table>
    <tr>
        <th>Tên sách</th>
        <th>Tác giả</th>
        <th>Thể loại</th>
        <th>Mô tả</th>
        <th>Bìa sách</th>
    </tr>
    <tr>
        <form method="POST" action="admin/newbook" enctype="multipart/form-data">
        <td><input type="text" name="book_name"></td>
        <td><input type="text" name="author"></td>
        <td><input type="text" name="book_category"></td>
        <td><input type="text" name="description"></td>
        <td><input type="file" name='img'></td>
        @csrf
        <td> <button type="submit" name="new">Thêm sách mới</button><td>
        </form>
    </tr>
</table>