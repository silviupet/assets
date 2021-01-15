<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


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
//    return view('layouts.user_page');
    if(auth::user()) {
        return redirect()->route('assets.index');
    } else return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('assets', 'AssetsController');

Route::get('assets/indexbycategory/{category}', 'AssetsController@indexbycategory')->name('assets.indexbycategory');


Route::resource('categories', 'CategoriesController');

Route::resource('tags', 'TagsController');
Route::resource('atributes', 'AtributesController');
Route::get('{asset}/atributes/create' , 'AtributesController@createAtributeOfAnAsset')->name('atributes.createAtributeOfAnAsset');
Route::resource('documents', 'DocumentsController');
//Route::PATCH('documents/{documents}' , 'DocumentsController@update')->name('documents.update');
//Route::DELETE('documents/{documents}' , 'DocumentsController@destroy')->name('documents.destroy');
Route::POST('{atribute}/documents' , 'DocumentsController@storeDocumentOfAnAtribute')->name('documents.storeDocumentOfAnAtribute');
//Route::POST('{asset}/atributes/store' , 'AtributesController@storeAtributeOfAnAsset')->name('atributes.storeAtributeOfAnAsset');

//Route::get('/currentTeamName' , function(){
//
//return (Auth::user()->currentTeam->name);
//});
//Route::get('/test', function () {
//    return view('test.admin_layout');
//});
//Route::get('/tema ', function () {
//    return view('layouts.master_theme');
//});
Route::get('/addTag/{atribute}/{tag}', 'TagsController@addTag')->name('atribute.addTag');
Route::get('/deleteTag/{atribute}/{tag}', 'TagsController@deleteTag')->name('atribute.deleteTag');
Route::get('atributes/indexbytag/{tag}', 'AtributesController@indexbytag')->name('atributes.indexbytag');
ROUTE::get('/mail', function(){

    $data =['title'=>'hi this is testing mailgun',
        'content'=>'this is testing mail from asset site'
        ];
    Mail::send('email.test', $data, function($message){

        $message->to('silviupet@gmail.com', 'silviu')->subject('test maail from mailgun asset');
    });


});

Route::get('/atributesexpired', function(){
    $atributes =  \App\Models\Atribute::where('expiry_date',  \Carbon\carbon::now()->addDays(15)->format('Y-m-d') )->get();



    foreach($atributes as $atribute){

        $team_id = $atribute->team_id;
        $team = \App\Models\Team::findOrFail($team_id);
        $user =$team->owner()->first();

            $data = ['atribute'=>$atribute,
                    'user'=>$user
            ];
            Mail::send('email.atributesexpired', $data, function($message) use ($user){

                $message->to($user->email , $user->name)->subject('test mail from mailgun asset')->from('asset@asset.com','Asset Site');
            });



 }

    ;





//foreach ($atributes as $atribute){
    ;
//}
});
