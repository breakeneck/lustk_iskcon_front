<?php

app()->group('/api', function () {
    app()->get('/', 'BroadcastController@index');
});
