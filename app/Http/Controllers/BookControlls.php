<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Books;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookControlls extends Controller
{
    public function index(){
    $books =DB::select('select * from books',[1]); 
    return view('book.book')->withBooks($books);
    }
    public function info($id){
        $books =Books::where('id',$id)->first();
        //Xuất ra nhiều hàng nên dùng get() 
        $chapter= Chapter::where('bookId',$id)->get();
        return view('book.bookinfo')->withInfo($books)->withChapter($chapter);
    } 
    public function chapter($name,$chapterid){
        // chỉ nhận 1 hàng nên dùng first()
        $book= Books::where('book_name',$name)->firstOrFail();
        $bookid= $book->id;
        $chapters= Chapter::where('id',$chapterid)->where('bookID',$bookid);
        $chapter=$chapters->first();
        $next= Chapter::where('id',">",$chapterid)->where('bookID',$bookid)->first();
        $prev= Chapter::where('id',"<",$chapterid)->where('bookID',$bookid)->first();
        return view('book.chapter')->withChapter($chapter)->withBook($book)->withNext($next)->withPrev($prev);
        }
}   
