<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('homepage');
    });
    Route::get('/home', function () {
        return view('homepage');
    });
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('equipment', 'EquipmentController');
        Route::get('checkin/{id}', ['uses' => 'EquipmentController@checkin', 'as' => 'equipment.checkin']);
        Route::get('checkout/{id}', ['uses' => 'EquipmentController@checkout', 'as' => 'equipment.checkout']);

        Route::get('profile', function () {
            $user = Auth::user();
            return view('auth.profile', compact('user'));
        });
        Route::post('profile', ['uses' => 'Auth\AuthController@updateProfile', 'as' => 'auth.updateprofile']);

        Route::get('logout', [
            'uses' => 'Auth\AuthController@logout',
            'as' => 'auth.logout'
        ]);
    });

    Route::get('usercount', function () {
        $premium = \App\User::where('subscription', 'premium')->count();
        $total = \App\User::count();
        return view('auth.count', compact('premium', 'total'));
    });
});
