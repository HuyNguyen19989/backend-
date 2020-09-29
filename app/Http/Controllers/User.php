<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class User extends Controller
{
    //Tham số trược truyền trực tiếp từ router
    public function index($name,$password){
        return view('user')->withName($name)->withPassword($password);
    }
    public function chap($name,$id){
        echo $name;
    }
}
