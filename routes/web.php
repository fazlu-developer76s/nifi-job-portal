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
use App\Http\Controllers\VerificationController;
 

$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'front_routes' . DIRECTORY_SEPARATOR;

/* * ******** IndexController ************ */

Route::get('/', 'IndexController@index')->name('index');

Route::get('/check-time', 'IndexController@checkTime')->name('check-time');

Route::post('set-locale', 'IndexController@setLocale')->name('set.locale');



/* * ******** HomeController ************ */
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    

Route::middleware(['verified'])->group(function(){
    Route::get('home', 'HomeController@index')->name('home');
});


Route::get('all-categories', 'IndexController@allCategories')->name('all-categories');

/* * ******** TypeAheadController ******* */



Route::get('typeahead-currency_codes', 'TypeAheadController@typeAheadCurrencyCodes')->name('typeahead.currency_codes');



/* * ******** FaqController ******* */



Route::get('faq', 'FaqController@index')->name('faq');



/* * ******** CronController ******* */



Route::get('check-package-validity', 'CronController@checkPackageValidity');



/* * ******** Verification ******* */



Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::get('not-verified', 'Auth\RegisterController@notVerified')->name('not-verified');
Route::get('company-email-verification/error', 'Company\Auth\RegisterController@getVerificationError')->name('company.email-verification.error');
Route::get('company-email-verification/check/{token}', 'Company\Auth\RegisterController@getVerification')->name('company.email-verification.check');

/* * ***************************** */



// Sociallite Start



// OAuth Routes



Route::get('login/jobseeker/{provider}', 'Auth\LoginController@redirectToProvider');



Route::get('login/jobseeker/{provider}/callback', 'Auth\LoginController@handleProviderCallback');



Route::get('login/employer/{provider}', 'Company\Auth\LoginController@redirectToProvider');



Route::get('login/employer/{provider}/callback', 'Company\Auth\LoginController@handleProviderCallback');



// Sociallite End



/* * ***************************** */



Route::post('tinymce-image_upload-front', 'TinyMceController@uploadImage')->name('tinymce.image_upload.front');







Route::get('cronjob/send-alerts', 'AlertCronController@index')->name('send-alerts');







Route::post('subscribe-newsletter', 'SubscriptionController@getSubscription')->name('subscribe.newsletter');







/* * ******** OrderController ************ */



include_once($real_path . 'order.php');



/* * ******** CmsController ************ */



include_once($real_path . 'cms.php');



/* * ******** JobController ************ */



include_once($real_path . 'job.php');



/* * ******** ContactController ************ */



include_once($real_path . 'contact.php');



/* * ******** CompanyController ************ */



include_once($real_path . 'company.php');



/* * ******** AjaxController ************ */



include_once($real_path . 'ajax.php');



/* * ******** UserController ************ */



include_once($real_path . 'site_user.php');



/* * ******** User Auth ************ */



Auth::routes(['verify' => true]);



/* * ******** Company Auth ************ */



include_once($real_path . 'company_auth.php');



/* * ******** Admin Auth ************ */



include_once($real_path . 'admin_auth.php');











Route::get('blog', 'BlogController@index')->name('blogs');



Route::get('blog/search', 'BlogController@search')->name('blog-search');



Route::get('blog/{slug}', 'BlogController@details')->name('blog-detail');



Route::get('/blog/category/{blog}', 'BlogController@categories')->name('blog-category');



Route::get('/company-change-message-status', 'CompanyMessagesController@change_message_status')->name('company-change-message-status');

Route::get('/seeker-change-message-status', 'Job\SeekerSendController@change_message_status')->name('seeker-change-message-status');



Route::get('/sitemap', 'SitemapController@index');



Route::get('/sitemap/companies', 'SitemapController@companies');





Route::get('job8', 'Job8Controller@job8')->name('job8');

Route::get('cronjob/delete-jobs', 'Job8Controller@delete_jobs')->name('delete-jobs');

Route::get('cronjob/amend-jobs', 'Job8Controller@amend_jobs')->name('amend-jobs');

Route::get('cronjob/set-count-industry', 'Job8Controller@set_count_industry')->name('set_count_industry');

Route::get('cronjob/set-total-count', 'Job8Controller@set_total_count')->name('set_total_count');

Route::get('cronjob/set-total-country', 'Job8Controller@set_count_country')->name('set_count_country');

Route::get('cronjob/set-total-companies', 'Job8Controller@set_count_company')->name('set_count_company');

Route::get('cronjob/set-total-jobType', 'Job8Controller@set_count_jobType')->name('set_count_jobType');

Route::get('cronjob/remove-duplicates', 'Job8Controller@remove_duplicates')->name('remove_duplicates');

Route::get('cronjob/set-count-company', 'Job8Controller@set_count_company')->name('set_count_company');

Route::get('cronjob/remove-duplicate-companies', 'Job8Controller@remove_duplicates')->name('remove-duplicate-companies');

Route::get('recover-companies', 'Job8Controller@recover_companies')->name('recover-companies');

Route::get('cronjob/recover-jobs', 'Job8Controller@recover_jobs')->name('recover-jobs');



Route::get('set-location', 'Job8Controller@set_location')->name('set_location');



Route::post('ajax_upload_file','FilerController::class@upload')->name('filer.image-upload');

Route::post('ajax_remove_file','FilerController::class@fileDestroy')->name('filer.image-remove');
Route::get('/verify-otp', 'Auth\LoginController@verify_otp')->name('auth.verify_otp');
Route::post('/check-otp', 'Auth\LoginController@check_otp')->name('auth.check_otp');




Route::get('/clear-cache', function () {



  $exitCode = Artisan::call('config:clear');



  $exitCode = Artisan::call('cache:clear');



  $exitCode = Artisan::call('config:cache');



  return 'DONE'; //Return anything



});











