<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\WrittenBy;
use DB;
use App\Quotation;
class BookViewController extends Controller
{
    public function index()
    {
        return view('bookview');
    }
    /*
    public function postform(Request $request)
    {
        $data = $request->books;
        return Response::array(

                    'data'   => $data
                )); 
    }
    */
}