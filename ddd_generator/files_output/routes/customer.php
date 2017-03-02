<?php

// routes for Customer

$app->post('customers/create', [
    'uses' => 'customerController@create',
]);

$app->get('customers/getByPage/{page}/{limit}', [
    'uses' => 'customerController@getByPage',
]);

$app->post('customers/filter/', [
    'uses' => 'customerController@getByFilter',
]);

$app->put('customers/update/', [
    'uses' => 'customerController@update',
]);

$app->delete('customers/delete/', [
    'uses' => 'customerController@delete',
]);
