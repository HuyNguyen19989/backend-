<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Books;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
class admin extends Controller
{
    public function index(){
        $books = Books::all();
        return view('admin.index')->withBooks($books);
    }
    //hàm tạo sách mới đã lưu
    public function newbook(Request $req){  
        if(!$req->book_name or !$req->author or !$req->book_category or !$req->description ){
            $req->session()->flash('alert-error','Vui lòng điền đầy đủ nội dung');
        }
        elseif(!$req->file('img')){
            $req->session()->flash('alert-img','Chưa tải ảnh bìa');
        }
        elseif($this->addimg($req)==false){
            $req->session()->flash('alert-format','Định dạng ảnh phải là  jpeg, jpg,png,gif');
        }
        
        else{
        $book = new Books();
        $book->book_name=$req->input('book_name');
        $book->author=$req->input('author');
        $book->description=$req->input('description');
        $book->book_category=$req->input('book_category');
        $book->img=$this->addimg($req);
        $book->save();
        }
        return back();
    }

    //hàm thêm ảnh
public function addimg(Request $req){
            if($req->hasFile('img')){
                //lấy đuôi
                $exten=$req->file('img')->guessClientExtension();
                if($exten !='jpef' and $exten !='jpg' and $exten and 'gif' and $exten !='png'){ 
                    return false;
                }
                else{
                //Lưu file vào thư mục
                $path=$req->file('img')->store('public/bookimg');
                // lấy tên file
                    $name=$req->file('img')->hashName();
                //lấy url 
                    $url='storage/bookimg/'.$name;
                    return $url;
                    }
                    
                }   

    }
    //hàm đi đến trang chỉnh sửa
    public function edit($id){
        $books =Books::where('id',$id)->first();
        //Xuất ra nhiều hàng nên dùng get() 
        $chapter= Chapter::where('bookId',$id)->get();
        return view('admin.bookedit')->withBook($books)->withChapter($chapter);
    }
    // Thay đổi info
    public function editinfo(Request $req){
        if (!$req->book_name ||!$req->author ||!$req->description ||!$req->category)
        $req->session()->flash('alert-error','Vui lòng điền đầy đủ thông tin');
        else{
        $info=Books::where('id',$req->id)->first();
        $info->description=$req->description;
        $info->author=$req->author;
        $info->book_name=$req->book_name;
        $info->book_category=$req->category;
        $info->save();
        $req->session()->flash('alert-success','Thay đổi thành công');
        }
        return back();
    }
 
    public function newchap(Request $req){
        //Lấy file
        if($req->hasFile('mp3')) {
            //lấy đuôi
                $exten=$req->file('mp3')->guessClientExtension();
                if($exten !='mp3'){
                    $req->session()->flash('alert-fileerror','Sai định dạng');
                    }
                else {
                //Lưu file vào thư mục
                    $path=$req->file('mp3')->store('public/chapaudio');
                // lấy tên file
                    $name=$req->file('mp3')->hashName();
                //lấy url 
                    $url='storage/chapaudio/'.$name;

                    $chap = new Chapter();
                    $chap->bookID =$req->bookID;
                    $chap->title=$req->title;
                    $chap->url=$url;
                    $chap->filename=$name;
                    $chap->save();
                }
            }
       
        return back();
    }
    public function deletechap(Request $req){
        $delete=Chapter::where('id',$req->id)->first();
        $file=$delete->filename;
        $delete->delete();
        Storage::delete('public/chapaudio/'.$file);
        return back();
    }
    public function deletebook(Request $req){
        $deletechaps=Chapter::where('bookID',$req->id)->get();

            foreach ($deletechaps as $file){
                $file->delete();
        Storage::delete('public/chapaudio/'.$file->filename);
        }
        
        $book=Books::where('id',$req->id)->first();
        // Storage::delete('storage/bookimg/XBYXFw1bwfnu2VnJfXvWQxcspqcwYY3Oh9q64WMH.png');  
        $book->delete();
        return back();
    }
   
   
}

