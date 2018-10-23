<?php

namespace App\Http\Controllers\Backend\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Notes\ManageNotesRequest;
use App\Repositories\Backend\Notes\NotesRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class NotesTableController extends Controller
{
    protected $notes;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $cmspages
     */
    public function __construct(NotesRepository $notes)
    {
        $this->notes = $notes;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageNotesRequest $request)
    {
        return Datatables::of($this->notes->getForDataTable())
            ->escapeColumns(['title','id'])
            ->editColumn('checkbox', function ($notes) {
                return '<input type="checkbox" id="'.$notes->id.'" name="id[]" class="sub_chk" value="'.$notes->id.'" />';
            })
            ->addColumn('status', function ($notes) {
                return $notes->status;
            })
            ->addColumn('publish_datetime', function ($notes) {
                return $notes->publish_datetime->format('d/m/Y h:i A');
            })
            ->addColumn('created_by', function ($notes) {
                return $notes->user_name;
            })
            ->addColumn('created_at', function ($notes) {
                return $notes->created_at->toDateString();
            })
            ->addColumn('actions', function ($notes) {
                return $notes->action_buttons;
            })
            ->make(true);
    }
}
