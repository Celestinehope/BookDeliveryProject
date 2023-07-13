<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FormController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

//vendor dashboard
 //Route::get('/vendordashboard', function () {
 //   return view('vendordashboard');
//});

Route::get('/vendordashboard', [BookController::class, 'show']);
// ->middleware('auth');
/*Route::get('/userdashboard', function () {
    return view('sample');
});*/
Route::get('/view', function () {
    return view('viewproduct');
});
Route::get('/product', [ProductsController::class, 'index']);

Route::post('/submit-order', [FormController::class, 'submitHire'])->name('submit-order');


//edit book information
Route::get('/book/{book}/edit', [BookController::class, 'bookedit']);

//update book information
Route::put('/book/{book}/update', [BookController::class, 'bookupdate']);

//delete book information
Route::delete('/book/{book}/delete',[BookController::class, 'delete']);

//login as different users
Route::get('/dashboard', function (Request $request) {
    $user = $request->user();
   // if $user= 'user';
    return view('dashboard');
   // elseif 
    
})->middleware(['auth', 'verified'])->name('dashboard');



//adding category by admin
Route::get('/addcategoryform', function () {
    return view('admin.addnewcategory');
})->middleware('auth');

Route::post('/addedcategory', [BookController::class, 'addcategory'])->middleware('auth');

//display category view
Route::get('/displaycategories', function () {
    return view('admin/displaycategory');
});
Route::get('/displaycategories', [BookController::class, 'displaycategories']);
//edit category information
Route::get('/category/{category}/edit', [BookController::class, 'categoryedit']);
//update book information
Route::put('/category/{category}/update', [BookController::class, 'categoryupdate']);

//  login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  //provider log in
Route::get('/auth/{provider}/redirect',[ProviderController::class,'redirect']);
 
Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);
 
//Route::get('/auth/google/redirect', function () {
 //  return Socialite::driver('google')->redirect();
//});
 
//Route::get('/auth/google/callback', function () {
  //$user = Socialite::driver('google')->user();
 
    
//});


Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
//Route::get('/vendordashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
require __DIR__.'/auth.php'; 
