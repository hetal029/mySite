<?php

namespace App\Http\Responses\Backend\NoteCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\BlogCategories\BlogCategory
     */
    protected $noteCategory;

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogCategory
     */
    public function __construct($noteCategory)
    {
        $this->noteCategory = $noteCategory;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.notecategories.edit')
            ->with('notecategory', $this->noteCategory);
    }
}
