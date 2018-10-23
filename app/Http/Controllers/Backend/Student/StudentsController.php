<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\Student\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Student\StudentRepository;
use App\Http\Requests\Backend\Student\ManageStudentRequest;
use App\Http\Requests\Backend\Student\CreateStudentRequest;
use App\Http\Requests\Backend\Student\StoreStudentRequest;
use App\Http\Requests\Backend\Student\EditStudentRequest;
use App\Http\Requests\Backend\Student\UpdateStudentRequest;
use App\Http\Requests\Backend\Student\DeleteStudentRequest;

/**
 * StudentsController
 */
class StudentsController extends Controller
{
    /**
     * variable to store the repository object
     * @var StudentRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param StudentRepository $repository;
     */
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Student\ManageStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ManageStudentRequest $request)
    {
        return view('backend.students.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateStudentRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateStudentRequest $request)
    {
        return view('backend.students.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return redirect()->route('admin.students.index')->withFlashSuccess(trans('alerts.backend.students.created'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Student\Student  $student
     * @param  EditStudentRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, EditStudentRequest $request)
    {
        return view('backend.students.edit', compact('student'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentRequestNamespace  $request
     * @param  App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $student, $input );
        //return with successfull message
        return redirect()->route('admin.students.index')->withFlashSuccess(trans('alerts.backend.students.updated'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteStudentRequestNamespace  $request
     * @param  App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, DeleteStudentRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($student);
        //returning with successfull message
        return redirect()->route('admin.students.index')->withFlashSuccess(trans('alerts.backend.students.deleted'));
    }
    
}
