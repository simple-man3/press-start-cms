<?php

// Главная страница CMS
Route::get('/', ['uses'=>'UserController\ControllerWithHelper\PostController@index','middleware'=>['installationCms','nullTemplateMiddleware'],'as'=>'homeUser']);
