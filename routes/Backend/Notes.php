<?php

Route::group(['namespace' => 'Notes'], function(){
	Route::resource('notes', 'NotesController', ['except' => ['show']]);
	Route::post('notes/notesDeleteAll', 'NotesController@deleteAll')->name('notes.deleteAll');
	Route::post('notes/replica', 'NotesController@replica')->name('notes.replica');
	Route::post('notes/get', 'NotesTableController')
		->name('notes.get');
});

