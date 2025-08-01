<?php



/* * ******  Company Start ********** */

Route::get('list-companies', array_merge(['uses' => 'Admin\CompanyController@indexCompanies'], $all_users))->name('list.companies');

Route::get('list-payment-history', array_merge(['uses' => 'Admin\CompanyController@indexCompaniesHistory'], $all_users))->name('list.payment.hostory');
Route::get('public-job/{id}','AjaxController@jobdetail')->name('public.job');
Route::get('fetch-payment-history', array_merge(['uses' => 'Admin\CompanyController@fetchCompaniesHistory'], $all_users))->name('fetch.data.companiesHistory');

Route::get('create-company', array_merge(['uses' => 'Admin\CompanyController@createCompany'], $all_users))->name('create.company');
Route::post('update-kyc-status', array_merge(['uses' => 'Admin\CompanyController@update_kyc_status'], $all_users))->name('update.kyc_status');
Route::post('reject-kyc', array_merge(['uses' => 'Admin\CompanyController@reject_kyc'], $all_users))->name('reject.kyc');

Route::post('store-company', array_merge(['uses' => 'Admin\CompanyController@storeCompany'], $all_users))->name('store.company');

Route::get('edit-company/{id}', array_merge(['uses' => 'Admin\CompanyController@editCompany'], $all_users))->name('edit.company');

Route::put('update-company/{id}', array_merge(['uses' => 'Admin\CompanyController@updateCompany'], $all_users))->name('update.company');

Route::delete('delete-company', array_merge(['uses' => 'Admin\CompanyController@deleteCompany'], $all_users))->name('delete.company');

Route::get('fetch-companies', array_merge(['uses' => 'Admin\CompanyController@fetchCompaniesData'], $all_users))->name('fetch.data.companies');

Route::put('make-active-company', array_merge(['uses' => 'Admin\CompanyController@makeActiveCompany'], $all_users))->name('make.active.company');

Route::put('make-not-active-company', array_merge(['uses' => 'Admin\CompanyController@makeNotActiveCompany'], $all_users))->name('make.not.active.company');

Route::put('make-featured-company', array_merge(['uses' => 'Admin\CompanyController@makeFeaturedCompany'], $all_users))->name('make.featured.company');

Route::put('make-not-featured-company', array_merge(['uses' => 'Admin\CompanyController@makeNotFeaturedCompany'], $all_users))->name('make.not.featured.company');



Route::get('list-applied-users/{job_id}', 'Admin\CompanyController@listAppliedUsers')->name('admin.list.applied.users');


Route::post('kyc-autoapproved', 'Admin\CompanyController@approved_kyc')->name('kyc.autoapproved');


/* * ****** End Company ********** */