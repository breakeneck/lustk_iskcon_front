<?php

app()->group('/api/books', function () {
    app()->get('/(\w+)', 'BooksController@index');
    app()->get('/contents/(\d+)', 'BooksController@contents');
    app()->get('/chapters/(\d+)', 'BooksController@chapters');
    app()->get('/page/(\d+)', 'BooksController@page');
    app()->get('/search/(.*)', 'BooksController@search');
    app()->get('/tree', 'BooksController@tree');
});
