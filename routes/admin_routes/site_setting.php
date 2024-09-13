<?php

/* * ******  SiteSetting Start ********** */
Route::get('edit-site-setting', array_merge(['uses' => 'Admin\SiteSettingController@editsiteSetting'], $all_users))->name('edit.site.setting');
Route::post('fetch-sms-setting', array_merge(['uses' => 'Admin\SiteSettingController@fetchsmsSetting'], $all_users))->name('fetch.sms.setting');
Route::get('sms-test-key', array_merge(['uses' => 'Admin\SiteSettingController@testKeySms'], $all_users))->name('sms.test.key');
Route::put('update-site-setting', array_merge(['uses' => 'Admin\SiteSettingController@updatesiteSetting'], $all_users))->name('update.site.setting');
Route::post('notification-update', array_merge(['uses' => 'Admin\SiteSettingController@updateNotification'], $all_users))->name('notification.update');

/* * ****** End SiteSetting ********** */
?>