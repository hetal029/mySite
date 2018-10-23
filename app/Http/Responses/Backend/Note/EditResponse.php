<?php

namespace App\Http\Responses\Backend\Note;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $note;
    protected $status;
    protected $noteCategories;

    public function __construct($note, $status, $noteCategories)
    {
        $this->note = $note;
        $this->status = $status;
        $this->noteCategories = $noteCategories;
    }

    public function toResponse($request)
    {
        $selectedCategories = $this->note->categories->pluck('id')->toArray();
        return view('backend.notes.edit')->with([
            'note'               => $this->note,
            'status'             => $this->status,
            'selectedCategories' => $selectedCategories,
            'noteCategories'     => $this->noteCategories,
        ]);
    }
}