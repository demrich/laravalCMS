<?php
use Gloudemans\Shoppingcart\Facades\Cart;

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

Route::get('/vue', function () {
    return view('vue');
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

Route::get('cart', [
    'uses'=> 'CartController@mycart',
    'as' => 'cart'
]);

Route::post('cart', [
    'uses'=> 'CartController@store',
    'as' => 'cart.store'
]);

Route::get('empty', function(){
    Cart::destroy();
});

Route::delete('/cart/{product}','CartController@destroy')->name('cart.remove');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');

Route::post('/cart/wishList/{product}','WishlistController@wishList')->name('cart.wishList');
Route::post('/wishlist/cart','WishlistController@store')->name('wishlist.cart');
//Route::delete('/cart/wishList/{product}','CartController@removeWish')->name('wishList.remove');

Route::delete('/wishlist/{product}','WishlistController@removeWish')->name('wishList.remove');


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

        Route::get('uploadproduct', [
            'uses' => 'ProductController@uploadProduct',
            'as' => 'uploadproduct',
        ]);

        Route::post('uploadproduct', [
            'uses' => 'productController@uploadProductPost',
            'as' => 'uploadproduct',
        ]);



    });  // END GROUP


//User Group
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

        
        Route::get('checkout', [
            'uses' => 'CheckoutController@index',
            'as' => 'checkout'
        ]);

        Route::get('uploadprofilepic', [
            'uses' => 'UserController@uploadImage',
            'as' => 'uploadprofilepic',
        ]);

        Route::post('uploadprofilepic', [
            'uses' => 'UserController@uploadImagePost',
            'as' => 'uploadprofilepic',
        ]);
        
        
    Route::group(['middleware' => 'auth'], function() { // BEGIN GROUP

        Route::get('/dashboard', [
            'uses' => 'UserController@getDashboard',
            'as' => 'dashboard',
            ]);

        Route::get('beatdonation', [
            'uses' => 'MusicController@beatDonation',
            'as' => 'beatdonation',
            ]);

        Route::post('beatdonation', [
            'uses' => 'MusicController@uploadBeatDonation',
            'as' => 'beatdonation',
        ]);            
    

    }); //END GROUP

}); // END GROUP

