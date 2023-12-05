<?php

app()->group('/api/broadcast', function () {
    app()->get('/', 'BroadcastController@index');
    app()->post('/create', 'BroadcastController@create');
    app()->post('/update', 'BroadcastController@update');
    app()->post('/insert-shloka', 'BroadcastController@insertShloka');
    app()->post('/delete-shloka', 'BroadcastController@deleteShloka');
});
