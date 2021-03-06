<?php

namespace App\Http\Controllers;
use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // secure api endpoint: exempt index() and show() methods from middleware
    // this way users can use index() and show() methods without being authenticated
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show', 'showImageByID', 'showByISBN']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function showImageByID($book_id) {
        $book = Book::findOrFail($book_id);

        $imgref = "<img src=$book->image><br><p>$book->image</p>";
        return $imgref;
    }

    public function showByISBN($isbn) {
        $book = Book::where('isbn', $isbn)->first();

        $book_attributes =
            "<p>
                Name: $book->name <br>
                ISBN: $book->isbn <br>
                Publication Year: $book->publication_year <br>
                Publisher: $book->publisher <br>
                <img src=$book->image> <br>
            </p>";

        return $book_attributes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // check if currently authenticated user is owner of the book
        if ($request->user()->id !== $book->user_id) {
            return response()->json(['error' => 'You can only edit your own books.'], 403);
        }

        $book->update($request->only(['title', 'description']));

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
