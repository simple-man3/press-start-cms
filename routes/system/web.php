<?php

//region Installation CMS

Route::group(['prefix'=>'installation','namespace'=>'System\Installation'],function () {
    Route::get('/',['uses'=>'InstallationCms@index','as'=>'displayInstallationForm']);
    Route::post('/db-setup',['uses'=>'InstallationCms@setSettingDb','as'=>'setSettingDb']);
});

//endregion

//region Если тема не выбрана

//Если нет вообще шаблонов
Route::get('/null', ['uses'=>'IndexController@index','as'=>'qwerty']);

//endregion

//region AuthCustom

//Регистрация юзера, кастомное (Просто нужно!)
Route::group(['prefix'=>'/registration','namespace'=>'System\AuthCustom','middleware'=>'registrationCustom'],function (){
    Route::get('/',['uses'=>'RegistrationCustom@index','as'=>'displayRegistrationForm']);
    Route::post('/add_user',['uses'=>'RegistrationCustom@registUser','as'=>'registUser']);
});

//Авторизация юера, кастомное
//psс => press-start-cms
Route::group(['prefix'=>'/psc/sigin','namespace'=>'System\AuthCustom','middleware'=>'loginCustom'],function (){
    Route::get('/',['uses'=>'LoginCustom@index','as'=>'login_form']);
    Route::post('/',['uses'=>'LoginCustom@loginUser','as'=>'login_user']);
});

Route::get('/custom_logout',['uses'=>'System\AuthCustom\LoginCustom@customLogout','as'=>'custom_logout']);
//endregion

//region Админка
Route::group(['prefix'=>'psc','middleware'=>'auth_admin_page','namespace'=>'System\Admin'],function (){

    //Пользователь хочет авторизироваться
    Route::get('/',['uses'=>'AdminContent@index']);

    //Главное
    Route::get('/main',['uses'=>'AdminContent@show_main','as'=>'admin_main']);

    //region Контент
    Route::group(['prefix'=>'content'],function (){

        //Отображает список категорий
        Route::get('/list_categories',['uses'=>'AdminContent@displayListCategories','as'=>'list_categories']);

        //Отображает форму изменения категории
        Route::get('/update_category/{id}',['uses'=>'AdminContent@displayFormUpdateCategory','as'=>'update_category']);

        //Изменяет категорию
        Route::post('/update_category/{id}',['uses'=>'AdminContent@updateCategory','as'=>'update_category']);

        //Отображает список контента в зависимости от категории
        Route::get('/list_elements/{id}',['uses'=>'AdminContent@displayAllContent','as'=>'list_content']);

        //Отображение формы добавления контента
        Route::get('/display_from/{id}',['uses'=>'AdminContent@displayFormContent','as'=>'from_add_content']);

        //Добавление контента по нажатию кнопки
        Route::post('/display_from/add/{id}',['uses'=>'AdminContent@addContent','as'=>'add_content']);

        //Отображение контента детально
        Route::get('/detail_content/{idCategory}/{idContent}',['uses'=>'AdminContent@detailContent','as'=>'detail_content']);

        //Сохранение изменения контента в детальной странице
        Route::post('/detail_content/update/{idCategory}/{idContent}',['uses'=>'AdminContent@updateContent','as'=>'update_detail']);

        //Добавление категории
        Route::post('/add_content/add_category',['uses'=>'AdminContent@addCategory','middleware'=>'validationMiddleware','as'=>'addCategory']);

        //Выболнить действия с контентом
        Route::post('/list_elements/action/{id}',['uses'=>'AdminContent@actionListElements','as'=>'actionListElements']);

        //Выболнить действия с категориями
        Route::post('/list_categories/action/',['uses'=>'AdminContent@actionListCategories','as'=>'actionListCategories']);
    });
    //endregion

    //region security_policy
    Route::group(['prefix'=>'security_policy'],function (){

        //region Список пользоватлей

        //Отображение списка всех зареганных юзеров в cms
        Route::get('/',['uses'=>'SecurityPolicy@index','as'=>'admin_account']);

        //Отображение формы добавления нового юзера
        Route::get('/add_user_form',['uses'=>'SecurityPolicy@displayFormUser','as'=>'form_user']);

        //Добавление нового юзера
        Route::post('/add_user_form/add',['uses'=>'SecurityPolicy@addUser','as'=>'add_user']);

        //Отобразить юзера детально
        Route::get('/detail/{id}',['uses'=>'SecurityPolicy@displayDetailUser','as'=>'detail_user']);

        //Изменение поля юзера
        Route::post('/update/{id}',['uses'=>'SecurityPolicy@updateUser','as'=>'update_user']);

        //Выбор действия из списка "Действия" для юезеров
        Route::post('/action_user',['uses'=>'SecurityPolicy@actionUser','as'=>'action_user']);

        //endregion

        //region Список ролей

        //Отображение списка ролей
        Route::get('/all_roles',['uses'=>'SecurityPolicy@displayRoles','as'=>'all_roles']);

        //Роль детально
        Route::get('/detail_role/{id}',['uses'=>'SecurityPolicy@displayDetailRole','as'=>'detail_role']);

        //Изменение роли
        Route::post('/update_role/{id}',['uses'=>'SecurityPolicy@updateRole','middleware'=>'validationMiddleware','as'=>'update_role']);

        //Добавление новой роли
        Route::post('/add_role',['uses'=>'SecurityPolicy@addRole','middleware'=>'validationMiddleware','as'=>'add_role']);

        //Выбор действия из списка "Действия" для ролей
        Route::post('/action_role',['uses'=>'SecurityPolicy@actionRole','middleware'=>'validationMiddleware','as'=>'action_role']);

        //endregion
    });
    //endregion

    //region Настройки
    Route::get('/setting',['uses'=>'AdminContent@show_setting','as'=>'admin_setting']);

    Route::post('/setting/theme/change', 'AdminContent@change_theme')->name('admin.settings.change_theme');
    //endregion
});
//endregion


























//region Хз что это

// Маршруты авторизации / регистрации
//Auth::routes();

// CRUD маршруты для статей (постов)
Route::resource('/post', 'PostController');

// TODO
Route::get('/home', 'HomeController@index')->name('home');
//endregion
