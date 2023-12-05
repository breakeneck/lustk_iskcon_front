<?php

app()->group('/api/users', function () {
    app()->get('/', 'UsersController@index');
    app()->post('/create', 'UsersController@create');
});
