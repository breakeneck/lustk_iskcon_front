<?php

app()->group('/api', function () {
    app()->get('/', 'AuthController@index');
    app()->post('/login', 'AuthController@login');
    app()->get('/logout', 'AuthController@logout');
});

