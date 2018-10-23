<?php

namespace App\Http\Controllers\Backend\Student;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Student\StudentRepository;
use App\Http\Requests\Backend\Student\ManageStudentRequest;

/**
 * Class StudentsTableController.
 */
class StudentsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var StudentRepository
     */
    protected $student;

    /**
     * contructor to initialize repository object
     * @param StudentRepository $student;
     */
    public function __construct(StudentRepository $student)
    {
        $this->student = $student;
    }

    /**
     * This method return the data of the model
     * @param ManageStudentRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageStudentRequest $request)
    {
        return Datatables::of($this->student->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($student) {
                return Carbon::parse($student->created_at)->toDateString();
            })
            ->addColumn('actions', function ($student) {
                return $student->action_buttons;
            })
            ->make(true);
    }
}
