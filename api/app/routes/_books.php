<?php

app()->group('/books', function () {
    app()->get('/', 'BooksController@index');
    app()->get('/content/(\d+)', 'BooksController@content');
    app()->get('/chapters/(\d+)', 'BooksController@chapters');
    app()->get('/tree', 'BooksController@tree');
});
