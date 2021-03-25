<?php
$router->post('/registration',['middleware'=>'checkheader','uses'=>'RegistrationController@registration']);
$router->post('/login',['middleware'=>'checkheader','uses'=>'RegistrationController@login']);

//phonebook crud with jwt auth
$router->post('/insert',['middleware'=>['checkheader','auth'],'uses'=>'PhonebookController@insert']);
$router->post('/select',['middleware'=>['checkheader','auth'],'uses'=>'PhonebookController@select']);
$router->post('/delete',['middleware'=>['checkheader','auth'],'uses'=>'PhonebookController@delete']);
$router->post('/edit',['middleware'=>['checkheader','auth'],'uses'=>'PhonebookController@edit']);