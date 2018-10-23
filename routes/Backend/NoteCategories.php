<?php

/*
 * Blogs Categories Management
 */
Route::group(['namespace' => 'NoteCategories'], function () {
    Route::resource('noteCategories', 'NoteCategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('noteCategories/get', 'NoteCategoriesTableController')
        ->name('noteCategories.get');
});