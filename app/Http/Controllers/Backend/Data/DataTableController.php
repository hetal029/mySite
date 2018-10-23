<?php

namespace App\Http\Controllers\Backend\Data;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Data\DataRepository;
use App\Http\Requests\Backend\Data\ManageDataRequest;

/**
 * Class DataTableController.
 */
class DataTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var DataRepository
     */
    protected $data;

    /**
     * contructor to initialize repository object
     * @param DataRepository $data;
     */
    public function __construct(DataRepository $data)
    {
        $this->data = $data;
    }

    /**
     * This method return the data of the model
     * @param ManageDataRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageDataRequest $request)
    {
        return Datatables::of($this->data->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->toDateString();
            })
            ->addColumn('actions', function ($data) {
                return $data->action_buttons;
            })
            ->make(true);
    }
}
