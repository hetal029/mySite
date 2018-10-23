<?php

namespace App\Http\Responses\Backend\Note;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return view('backend.notes.index')->with([
            'status'=> $this->status,
        ]);
    }
}
