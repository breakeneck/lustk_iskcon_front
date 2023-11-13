<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
use Leaf\Controller;

class BooksController extends Controller
{
    function index($lang = 'rus')
    {
        response()->json(array_map(fn($book) => [
            'label' => $book['id'] .' ' .$book['title'],
            'id' => $book['id'],
            'levels' => $book['levels'],
        ], db()->select('books')->where('lang', $lang)->get()));
    }


    function content($bookId)
    {
        $response = [];
        foreach(Chapter::content($bookId)->get() as $chapter) {
            $response[] = [
                'id' => $chapter->id,
                'label' => basename($chapter->path) .'. '. $chapter->title
            ];
        }
        response()->json($response);

//        /** @var Book $book */
//        $book = Book::where('id', $bookId)->first();
//
//        $chapters = db()->select('chapters')
//            ->where('book_id', $book->id)
//            ->where('level', 1)
//            ->get();
//
//        response()->json(array_map(fn($chapter) => [
//            'label' => basename($chapter['path']) . '. ' . $chapter['title'],
//            'id' => $chapter['id'],
//        ], $chapters));
    }

    function chapters($id)
    {
        /** @var Chapter $selected */
        $selected = Chapter::where('id',$id)->first();
        /** @var Book $book */
        $book = Book::where('id', $selected->book_id)->first();

        $chapters = db()->select('chapters')
            ->where('book_id', $book->id)
            ->where('level', $selected->level + 1)
            ->where('path', 'LIKE', $selected->path . '/%')
            ->get();


        response()->json(array_map(fn($chapter) => [
            'label' => basename($chapter['path']) . '. ' . $chapter['title'],
            'id' => $book['levels'] == 2 ? $chapter['id'] : null,
            'isLeaf' => $book['levels'] == 2
        ], $chapters));
    }

    function tree($lang = 'ukr')
    {
        response()->json(array_map(fn($book) => [
            'label' => $book['title'],
            'children' => array_map(fn($chapter) => [
                'label' => basename($chapter['path']) . '. ' . $chapter['title'],
                'id' => $book['levels'] == 2 ? $chapter['id'] : null,
                'children' => array_map(fn($subchapter) => [
                    'label' => basename($subchapter['path']) . '. ' . $subchapter['title'],
                    'id' => $subchapter['id'],
                ], $book['levels'] == 2 ? []
                    : db()->select('chapters')
                        ->where('book_id', $book['id'])
                        ->where('level', 2)
                        ->where('path', 'LIKE', $chapter['path'] . '/%')
                        ->get())
            ], db()->select('chapters')
                ->where('book_id', $book['id'])
                ->where('level', 1)
                ->get())
        ], db()->select('books')
            ->where('lang', $lang)
            ->get()
        ));
    }
    function tree2($lang = 'rus')
    {
        response()->json(array_map(fn($book) => [
            'label' => $book['title'],
            'children' => array_map(fn($chapter) => [
                'label' => basename($chapter['path']) . '. ' . $chapter['title'],
                'path' => $chapter['path'],
                'children' => array_map(fn($subchapter) => [
                    'label' => basename($subchapter['path']) . '. ' . $subchapter['title'],
                    'path' => $subchapter['path'],
                ], $book['levels'] == 2 ? []
                    : db()->select('chapters')
                        ->where('book_id', $book['id'])
                        ->where('level', 2)
                        ->where('path', 'LIKE', $chapter['path'] . '/%')
                        ->get())
            ], db()->select('chapters')
                ->where('book_id', $book['id'])
                ->where('level', 1)
                ->get())
        ], db()->select('books')
            ->where('lang', $lang)
            ->get()
        ));
    }
    function test($lang = 'rus')
    {
        $books = Book::where('lang', $lang)->get();
        response()->json($books);
    }
}
