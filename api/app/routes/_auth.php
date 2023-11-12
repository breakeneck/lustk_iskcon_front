<?php

app()->get('/', 'AuthController@index');
app()->post('/login', 'AuthController@login');
app()->get('/logout', 'AuthController@logout');
