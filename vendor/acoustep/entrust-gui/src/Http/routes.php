<?php
Route::group(
    [
      'prefix' => Config::get("entrust-gui.route-prefix"),
      'middleware' => Config::get("entrust-gui.middleware")
    ],
    function () {
        Route::get('users', ['uses' => 'UsersController@index', 'as' => 'entrust-gui::users.index']);
        
        Route::delete('users/{id}', ['uses' => 'UsersController@destroy', 'as' => 'entrust-gui::users.destroy']);

        
        
        Route::delete('roles/{id}', ['uses' => 'RolesController@destroy', 'as' => 'entrust-gui::roles.destroy']);

        Route::get('permissions', ['uses' => 'PermissionsController@index', 'as' => 'entrust-gui::permissions.index']);
        Route::get(
            'permissions/create',
            [
                'uses' => 'PermissionsController@create',
                'as' => 'entrust-gui::permissions.create'
            ]
        );
        Route::post('permissions', ['uses' => 'PermissionsController@store', 'as' => 'entrust-gui::permissions.store']);
        Route::get(
            'permissions/{id}/edit',
            [
                'uses' => 'PermissionsController@edit',
                'as' => 'entrust-gui::permissions.edit'
            ]
        );
        Route::put(
            'permissions/{id}',
            [
                'uses' => 'PermissionsController@update',
                'as' => 'entrust-gui::permissions.update'
            ]
        );
        Route::delete(
            'permissions/{id}',
            [
                'uses' => 'PermissionsController@destroy',
                'as' => 'entrust-gui::permissions.destroy'
            ]
        );

    }
);
    Route::group(['middleware' => 'auth'], function () {
        Route::get('users', ['uses' => 'UsersController@index', 'as' => 'entrust-gui::users.index']);
        Route::get('users/create', ['uses' => 'UsersController@create', 'as' => 'entrust-gui::users.create'])->middleware('crear-usuario');
        Route::post('users', ['uses' => 'UsersController@store', 'as' => 'entrust-gui::users.store'])->middleware('crear-usuario');
        Route::get('users/{id}/edit', ['uses' => 'UsersController@edit', 'as' => 'entrust-gui::users.edit'])->middleware('editar-usuario');
        Route::put('users/{id}', ['uses' => 'UsersController@update', 'as' => 'entrust-gui::users.update'])->middleware('editar-usuario');
        
        Route::get('roles', ['uses' => 'RolesController@index', 'as' => 'entrust-gui::roles.index']);
        Route::get('roles/create', ['uses' => 'RolesController@create', 'as' => 'entrust-gui::roles.create'])->middleware('crear-rol');
        Route::post('roles', ['uses' => 'RolesController@store', 'as' => 'entrust-gui::roles.store'])->middleware('crear-rol');
        Route::get('roles/{id}/edit', ['uses' => 'RolesController@edit', 'as' => 'entrust-gui::roles.edit'])->middleware('editar-rol');
        Route::put('roles/{id}', ['uses' => 'RolesController@update', 'as' => 'entrust-gui::roles.update'])->middleware('editar-rol');
    });
