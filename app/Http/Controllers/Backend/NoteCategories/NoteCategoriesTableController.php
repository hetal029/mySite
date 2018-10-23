<?php

namespace App\Http\Controllers\Backend\NoteCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NoteCategories\ManageNoteCategoriesRequest;
use App\Repositories\Backend\NoteCategories\NoteCategoriesRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogCategoriesTableController.
 */
class NoteCategoriesTableController extends Controller
{
    protected $notecategory;

    /**
     * @param \App\Repositories\Backend\BlogCategories\BlogCategoriesRepository $cmspages
     */
    public function __construct(NoteCategoriesRepository $notecategory)
    {
        $this->notecategory = $notecategory;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageNoteCategoriesRequest $request)
    {
        return Datatables::of($this->notecategory->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($notecategory) {
                return $notecategory->status_label;
            })
            ->addColumn('created_by', function ($notecategory) {
                return $notecategory->user_name;
            })
            ->addColumn('created_at', function ($notecategory) {
                return Carbon::parse($notecategory->created_at)->toDateString();
            })
            ->addColumn('actions', function ($notecategory) {
                return $notecategory->action_buttons;
            })
            ->make(true);
    }
}
