<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use Leaf\Controller;

class BooksController extends Controller
{
    function index($lang = 'ua')
    {
        $response = [];
        /** @var Book $book */
        foreach(Book::language($lang)->get() as $book) {
            $response[] = [
                'id' => $book->id,
                'label' => $book->title,
//                'isLeaf' => false
            ];
        }
        response()->json($response);
    }


    function contents($bookId)
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
        $parent = Chapter::find($id);
        /** @var Chapter $chapter */
        foreach(Chapter::subchapters($parent)->get() as $chapter) {
            $isLeaf = $chapter->level === $parent->book->levels;
            $response[] = [
                'id' => $chapter->id,
                'label' => basename($chapter->path) .'. '. $chapter->title,
                'isLeaf' => $isLeaf,
                'abbr' => $isLeaf ? ($parent->book->alias . str_replace('/', '.', trim($chapter->path,'/'))) : null
            ];
        }
        response()->json($response);
    }

    function texts($id)
    {
        $pages = [];
        $response = [];
        $parent = Chapter::find($id);
        /** @var Chapter $chapter */
        foreach(Chapter::subchapters($parent)->get() as $chapter) {
            $page = Page::byChapter($chapter->id)->with('chapter')->first();
            if (isset($page->id)) {
                $pages[] = $page;
            }

//            $response[] = [
//                'id' => $chapter->id,
//                'label' => $chapter->title,
//            ];
        }
//        $pages = Page::byChapter($id)->get();
        /** @var Page $page */
        foreach($pages as $page) {
            $response[] = [
                'id' => $page->id,
                'label' => $page->chapter->title,
            ];
        }
        response()->json($response);
    }
    function page($id)
    {
        response()->json([
            'chapter' => Chapter::find($id),
            'page' => Page::with('book')->byChapter($id)->first()
        ]);
    }

    function search($lang, $query)
    {
        $pages = Page::with('book')
            ->where('search_sanskrit', 'LIKE', "%$query%")
            ->whereRelation('book', 'lang', $lang)
            ->limit(50)->get();
        response()->json($pages);
//        [
//            'pages' => $pages
//        ]);
    }

//    function tree($lang = 'ukr')
//    {
//        response()->json(array_map(fn($book) => [
//            'label' => $book['title'],
//            'children' => array_map(fn($chapter) => [
//                'label' => basename($chapter['path']) . '. ' . $chapter['title'],
//                'id' => $book['levels'] == 2 ? $chapter['id'] : null,
//                'children' => array_map(fn($subchapter) => [
//                    'label' => basename($subchapter['path']) . '. ' . $subchapter['title'],
//                    'id' => $subchapter['id'],
//                ], $book['levels'] == 2 ? []
//                    : db()->select('chapters')
//                        ->where('book_id', $book['id'])
//                        ->where('level', 2)
//                        ->where('path', 'LIKE', $chapter['path'] . '/%')
//                        ->get())
//            ], db()->select('chapters')
//                ->where('book_id', $book['id'])
//                ->where('level', 1)
//                ->get())
//        ], db()->select('books')
//            ->where('lang', $lang)
//            ->get()
//        ));
//    }
}
