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
        $response = [];
        /** @var Book $book */
        foreach(Book::language($lang)->get() as $book) {
            $response[] = [
                'id' => $book->id,
                'label' => $book->title,
            ];
        }
        response()->json($response);
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
    }

    function chapters($id)
    {
        $response = [];
        foreach(Chapter::subchapters(Chapter::find($id))->get() as $chapter) {
            $response[] = [
                'id' => $chapter->id,
                'label' => basename($chapter->path) .'. '. $chapter->title,
                'leaf' => $chapter->level === $chapter->book->levels
            ];
        }
        response()->json($response);
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
}
