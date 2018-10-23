<?php
/**
 * Data
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Data'], function () {
        Route::resource('data', 'DataController');
        //For Datatable
        Route::post('data/get', 'DataTableController')->name('data.get');
    });
    
});