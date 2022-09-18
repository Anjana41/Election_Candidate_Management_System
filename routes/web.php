<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationContoller;
use App\models\register;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\TehsilController;
use App\Http\Controllers\Admin\SamitiController;
use App\Http\Controllers\Admin\PanchayatController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\DB;
use App\models\city;
use App\models\state;



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

// Route::get('/demo/{name}/{id?}', function ($name,$id=null) {
//     echo $name."  ";
//     echo $id;
// });

Route::get('/', function () {
    return view('welcome');
});
// got to demo with data name and id
// Route::get('/demo/{name}/{id?}', function($name,$id=null){
//       $data=compact('name','id');
//       return view('demo')->with ($data);
// });

// Route::any('/test', function(){
//     echo "Route Testing";
// });

// Route::get('/register',[RegistrationContoller::class,'form'])->name('form');
// Route::any('/registerd',[RegistrationContoller::class,'store'])->name('formdata');
// Route::get('/register/view',[RegistrationContoller::class,'view']);

// Route::get('/rdata',function(){
//          $register= register::all();
//          echo"<pre>";
//          print_r($register->toArray());
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::any('/dashboard', function () {
        $users = DB::table('users')->count();
        $state = DB::table('states')->count();
        $dist = DB::table('districts')->count();
        $teh = DB::table('tehsils')->count();
        $pan = DB::table('panchayats')->count();
        $sam = DB::table('samitis')->count();
        $vill = DB::table('villages')->count();
        $role = DB::table('roles')->count();
        return view("admin.dashboard",compact('users','state','dist','teh','pan','sam','vill','role'));
    });
    Route::get('/role-register', [DashboardController::class, 'registered'])->name('role');
    Route::get('/role-edit/{id}', [DashboardController::class, 'registeredit'])->name('edit');
    Route::post('/role-register-update', [DashboardController::class, 'registerupdate'])->name('update');
    Route::delete('/role-delete/{id}', [DashboardController::class, 'registerdelete'])->name('delete');
    Route::get('/add-member', [DashboardController::class, 'addmember'])->name('add');
    Route::post('/store', [DashboardController::class, 'store'])->name('store');
    // Route::get('/city', [DashboardController::class, 'city'])->name('city');
    Route::get('/view/{id}', [DashboardController::class, 'view'])->name('view');
    Route::get('/status-update/{id}', [DashboardController::class, 'status'])->name('status');
    Route::get('/dropdown', [DashboardController::class, 'dropdown'])->name('dropdown');
    Route::get('/reset', [DashboardController::class, 'reset'])->name('reset');
    Route::get('/viewrecord', [DashboardController::class, 'viewrecord'])->name('viewrecord');
    Route::get('/profile/{id}', [DashboardController::class, 'profile'])->name('profile');



    //Statecontroller
    Route::get('/addstate', [StateController::class, 'addstate'])->name('addstate');
    Route::post('/storestate', [StateController::class, 'storestate'])->name('storestate');
    Route::get('/allstates', [StateController::class, 'allstates'])->name('allstates');
    Route::get('/edit-state/{id}', [StateController::class, 'editstate'])->name('editstate');
    Route::post('/updatae-state', [StateController::class, 'updatestate'])->name('updatestate');
    Route::get('/statestatus/{id}', [StateController::class, 'statestatus'])->name('statestatus');

    //districtcontroller
     Route::get('/adddistrict', [DistrictController::class, 'adddist'])->name('adddist');
     Route::post('/storedistrict', [DistrictController::class, 'storedist'])->name('storedist');
     Route::get('/alldistrict', [DistrictController::class, 'alldist'])->name('alldist');
     Route::get('/edit-district/{id}', [DistrictController::class, 'editdist'])->name('editdist');
     Route::post('/updatae-district', [DistrictController::class, 'updatedist'])->name('updatedist');
     Route::get('/districtstatus/{id}', [DistrictController::class, 'diststatus'])->name('diststatus');

     //tehsilcontroller
     Route::get('/addtehsil', [TehsilController::class, 'addteh'])->name('addteh');
     Route::post('/storetehsil', [TehsilController::class, 'storeteh'])->name('storeteh');
     Route::get('/alltehsil', [TehsilController::class, 'allteh'])->name('allteh');
     Route::get('/edit-tehsil/{id}', [TehsilController::class, 'editteh'])->name('editteh');
     Route::post('/updatae-tehsil', [TehsilController::class, 'updateteh'])->name('updateteh');
     Route::get('/tehsilstatus/{id}', [TehsilController::class, 'tehstatus'])->name('tehstatus');
     Route::post('/getdistrict', [TehsilController::class, 'getdist'])->name('getdist');


     //Samiticontroller
     Route::get('/addsamiti', [SamitiController::class, 'addsam'])->name('addsam');
     Route::post('/storesamiti', [SamitiController::class, 'storesam'])->name('storesam');
     Route::get('/allsamiti', [SamitiController::class, 'allsam'])->name('allsam');
     Route::get('/edit-samiti/{id}', [SamitiController::class, 'editsam'])->name('editsam');
     Route::post('/update-samiti', [SamitiController::class, 'updatesam'])->name('updatesam');
     Route::get('/samitistatus/{id}', [SamitiController::class, 'samstatus'])->name('samstatus');
     Route::post('/gettehsil', [SamitiController::class, 'getteh'])->name('getteh');

     //panchayatcontroller
     Route::get('/addpanchayat', [PanchayatController::class, 'addpan'])->name('addpan');
     Route::post('/storepanchayat', [PanchayatController::class, 'storepan'])->name('storepan');
     Route::get('/allpanchayat', [PanchayatController::class, 'allpan'])->name('allpan');
     Route::get('/edit-panchayat/{id}', [PanchayatController::class, 'editpan'])->name('editpan');
     Route::post('/update-panchayat', [PanchayatController::class, 'updatepan'])->name('updatepan');
     Route::get('/panchayatstatus/{id}', [PanchayatController::class, 'panstatus'])->name('panstatus');
     Route::post('/getsamiti', [PanchayatController::class, 'getsam'])->name('getsam');


      //villagecontroller
      Route::get('/addvillage', [VillageController::class, 'addvill'])->name('addvill');
      Route::post('/storevillage', [VillageController::class, 'storevill'])->name('storevill');
      Route::get('/allvillage', [VillageController::class, 'allvill'])->name('allvill');
      Route::get('/edit-village/{id}', [VillageController::class, 'editvill'])->name('editvill');
      Route::post('/update-village', [VillageController::class, 'updatevill'])->name('updatevill');
      Route::get('/villagestatus/{id}', [VillageController::class, 'villstatus'])->name('villstatus');
      Route::post('/getpanchayat', [VillageController::class, 'getpan'])->name('getpan');
      Route::post('/getvillage', [VillageController::class, 'getvill'])->name('getvill');



      //Rolecontroller
      Route::get('/addrole', [RoleController::class, 'addrole'])->name('addrole');
      Route::post('/storerole', [RoleController::class, 'storerole'])->name('storerole');
      Route::get('/allrole', [RoleController::class, 'allrole'])->name('allrole');
      Route::get('/edit-role/{id}', [RoleController::class, 'editrole'])->name('editrole');
      Route::post('/updatae-role', [RoleController::class, 'updaterole'])->name('updaterole');
      Route::get('/rolestatus/{id}', [RoleController::class, 'rolestatus'])->name('rolestatus');


     // Forgot password controller
    //  Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    //  Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    //  Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    //  Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');















    Route::get('/sample', [DashboardController::class, 'sample'])->name('sample');




    // Route::get('change-status/{id}', [DashboardController::class,  'changestatus']);
    // Route::get('/userdata', [DashboardController::class,  'userdata']);




    //  Route::get('/role-register','App\Http\Controllers\Admin\DashboardController@registered');

    //  Route::get('/role-edit/{id}','App\Http\Controllers\Admin\DashboardController@registeredit');

    //  Route::put('/role-register-update/{id}','App\Http\Controllers\Admin\DashboardController@registerupdate');

    //  Route::delete('/role-delete/{id}','App\Http\Controllers\Admin\DashboardController@registerdelete');

    //  Route::post('/add-member','App\Http\Controllers\Admin\DashboardController@addmember');


});
