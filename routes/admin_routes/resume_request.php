<?php


Route::get('list-resume', array_merge(['uses' => 'Admin\ResumeController@indexResume'], $all_users))->name('list.resume');
Route::get('edit-resume/{user_id}', array_merge(['uses' => 'Admin\ResumeController@editResume'], $all_users))->name('edit.resume');
Route::post('update-resume', array_merge(['uses' => 'Admin\ResumeController@updateResume'], $all_users))->name('update.resume');



?>