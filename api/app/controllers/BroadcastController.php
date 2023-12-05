<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Broadcast;
use Leaf\Controller;

class BroadcastController extends Controller
{
    function index()
    {
        response()->json(Broadcast::with('pages.book')->get());
    }

    function create()
    {
        $broadcast = new Broadcast(request()->input());
        $broadcast->save();

        response()->json(Broadcast::with('pages.book')->find($broadcast->id));
    }

    function update()
    {
        $post = request()->input();
//        print_r($post);
        $broadcast = Broadcast::find($post['id']);
//        $broadcast = Broadcast();//::find(['id' => $post['id']]);
        $broadcast->fill($post);
        $broadcast->save();

        response()->json(Broadcast::with('pages.book')->find($broadcast->id));
    }

    function insertShloka()
    {
        $post = request()->input();
        db()->insert('broadcast_page')->params([
            'broadcast_id' => $post['broadcastId'],
            'page_id' => $post['pageId'],
        ])->execute();

        response()->json(Broadcast::with('pages.book')->find($post['broadcastId']));
    }

    function deleteShloka()
    {
        $post = request()->input();
        db()->delete('broadcast_page')->where([
            'broadcast_id' => $post['broadcastId'],
            'page_id' => $post['pageId'],
        ])->execute();

        response()->json(Broadcast::with('pages.book')->find($post['broadcastId']));
    }
}
