<?php

namespace App\Http\Responses\Backend\Note;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $status;
    protected $noteCategories;

    public function __construct($status, $noteCategories)
    {
        $this->status = $status;
        $this->noteCategories = $noteCategories;
    }

    public function toResponse($request)
    {
        return view('backend.notes.create')->with([
            'noteCategories' => $this->noteCategories,
            'status'         => $this->status,
        ]);
    }
}
