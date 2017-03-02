<?php

// routes for Manager

$app->post('managers/create', [
    'uses' => 'managerController@create',
]);

$app->get('managers/getByPage/{page}/{limit}', [
    'uses' => 'managerController@getByPage',
]);

$app->post('managers/filter/', [
    'uses' => 'managerController@getByFilter',
]);

$app->put('managers/update/', [
    'uses' => 'managerController@update',
]);

$app->delete('managers/delete/', [
    'uses' => 'managerController@delete',
]);
