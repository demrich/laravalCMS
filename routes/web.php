<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');


Route::get('merch', [
        'uses' => 'ProductController@getMerch',
        'as' =>'merch'
    ]
);

Route::post('/', [
    'uses' => 'UserController@getWelcome',
    'as' => 'welcome'
]);

Route::group(['prefix' => 'user'], function() {  // BEGIN GROUP

    Route::group(['middleware' => 'roles','roles' => ['Admin']], function() {  // BEGIN GROUP

        Route::get('/admin', [
            'uses' => 'UserController@getAdmin',
            'as' => 'admin',
   
        ]);
        
        Route::post('/admin/assign-roles', [
            'uses' => 'UserController@postAdminAssignRoles',
            'as' => 'admin.assign',
        ]); 
        
        Route::get('/changeuser', [
            'uses' => 'UserController@getUserChange',
            'as' => 'changeuser',
    ]);
    });  // END GROUP

        Route::get('mycart', [
            'uses'=> 'UserController@myCart',
            'as' => 'mycart'
        ]);

        Route::get('login',[
            'uses' => 'UserController@getlogin',
            'as' => 'login'
        ]);

        Route::post('/signup', [
            'uses' => 'UserController@postSignUp',
            'as' => 'signup'
        ]);
        
        Route::post('/signin', [
            'uses' => 'UserController@postSignIn',
            'as' => 'signin'
        ]);
        
        Route::get('logout',[
            'uses' => 'UserController@getlogout',
            'as' => 'logout'
        ]);
        
    Route::group(['middleware' => 'auth'], function() { // BEGIN GROUP

        Route::get('/dashboard', [
            'uses' => 'UserController@getDashboard',
            'as' => 'dashboard',
            ]);
    }); //END GROUP

}); // END GROUP