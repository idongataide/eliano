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
use App\Models\loan_product;

Auth::routes();

Route::get('/', function () {
   // $product = loan_product::where('is_default',1)->first();
   // return view('home')
   // ->with('product',$product);
    return view('auth.login');
});
//Route::post('login', 'Auth\LoginController@authenticated');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return redirect('/');

});


Route::get('about-us', 'FrontController@aboutus');
Route::get('faqs', 'FrontController@faq');
Route::post('contact-us', 'FrontController@updateContactus');
Route::get('contact-us', 'FrontController@contactus');
Route::get('/testimonials', 'FrontController@testimonial');
Route::get('/privacy-policy', 'FrontController@policy');
Route::get('/terms-and-conditions', 'FrontController@tc');
Route::get('/getState/{id}', 'FrontController@getState');
Route::get('/interest-rate/{id}', 'FrontController@interestrate');
Route::get('/getCity/{id}', 'FrontController@getCity');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register/{reference}', 'FrontController@register')->name('refer.register');
});


Route::group(['prefix' => 'user'], function () {
    Route::get('verify', 'HomeController@authVerification')->name('user.verification');
    Route::post('send-email-code', 'HomeController@sendemailcode')->name('user.sendemailcode');
    Route::post('send-sms-code', 'HomeController@sendphonecode')->name('user.post-sms-code');

    Route::post('verify-sms', 'HomeController@phoneverify')->name('user.phone-verify');
    Route::post('verify-email', 'HomeController@emailverify')->name('user.email-verify');
    Route::post('verify-kyc', 'HomeController@kycverify')->name('user.include.kyc');
    

    Route::group(['middleware' => ['auth','CheckStatus']], function() {
        Route::get('/home', 'HomeController@index')->name('user.home');
        Route::get('/profile', 'HomeController@myprofile')->name('user.profile');
        Route::get('/security', 'HomeController@getsecurity')->name('user.security');
        Route::get('/logging-activity', 'HomeController@getactivity')->name('user.activity');
        Route::post('/security', 'HomeController@postsecurity')->name('user.security');
        Route::get('contributors','HomeController@refferals')->name('user.refferal');

        Route::get('/create-loan/{product_id}', 'LoanUserController@create')->name('user.loan.createloan');
        Route::post('/post-loan', 'LoanUserController@store')->name('user.post.loan');
        Route::get('/loan-overview','LoanUserController@index')->name('user.loan.index');
        Route::get('/loan-details/{loan_id}', 'LoanUserController@details')->name('user.loan.details');
        Route::post('/update-loan', 'LoanUserController@update')->name('user.update.loan');
        Route::resource('managepayment','UserPaymentController');
        
        

    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('admin','Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('logout', 'Auth\AdminAuthController@logout')->name('adminlogout');

Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
	// Admin Dashboard
	Route::get('dashboard','AdminController@dashboard')->name('dashboard');
    Route::get('loans/view','LoanController@index')->name('admin.loan.loan');
    Route::post('loans/details', 'LoanController@post_loan_task')->name('postloandetails');
    Route::get('loans/details/{loan_id}','LoanController@details')->name('admin.loan.details');
    Route::get('loan/repayment','LoanController@getRepayment')->name('admin.loan.repayment');
    Route::get('loan/repayment/details/{payment_id}','LoanController@getrepaymentdetail')->name('admin.loan.repaymentdetails');
    Route::post('loan/repayment/details','LoanController@storeRepayment')->name('postrepaymentdetails');
    Route::get('loans/pending/approval','LoanController@pendingapproval')->name('admin.loan.pendingapproval');
    Route::get('loans/awaiting/disburstment','LoanController@awaitingdisburstment')->name('admin.loan.awaitingdisburstment');
    Route::get('loan_product/get_charge_detail/{charge}', 'LoanProductController@get_charge_detail');
  
    Route::post('viewcontribution','ContributionController@viewcontribution')->name('viewcontribution');
    Route::get('contribution-ledger','ContributionController@getcontributionledger')->name('contributions.ledger');
    Route::post('contribution-ledger','ContributionController@postcontributionledger')->name('postcontributionledger');
       
});



Route::resource('manageprofile', 'ProfileController');
Route::resource('users', 'UserController');
Route::resource('priviledge','PriviledgeController');
Route::resource('dashboard','DashboardController');
Route::resource('managecompany', 'ManageCompanyController');
Route::resource('faq', 'FaqController');
Route::resource('managecontactus','ManageContactUsController');
Route::resource('manageloanproduct','LoanProductController');
Route::resource('country','CountryController');
Route::resource('managestate','StateController');
Route::resource('managecity','CityController');
Route::resource('managebank','BankController');
Route::resource('manageplan','PlanController');
Route::resource('securityquestion','securityquestionController');
Route::resource('adminusers','AdminUserController');
Route::resource('managecharge','ChargeController');
Route::resource('managebonustype','BonusTypeController');
Route::resource('merchant','MerchantController');
Route::resource('contributor','ContributorController');
Route::resource('contributions','ContributionController');




/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');

