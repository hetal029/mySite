<?php

namespace App\Http\Controllers\Backend\Data;

use App\Models\Data\Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Data\DataRepository;
use App\Http\Requests\Backend\Data\ManageDataRequest;
use App\Http\Requests\Backend\Data\CreateDataRequest;
use App\Http\Requests\Backend\Data\StoreDataRequest;
use App\Http\Requests\Backend\Data\EditDataRequest;
use App\Http\Requests\Backend\Data\UpdateDataRequest;
use App\Http\Requests\Backend\Data\DeleteDataRequest;

/**
 * DataController
 */
class DataController extends Controller
{
    /**
     * variable to store the repository object
     * @var DataRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param DataRepository $repository;
     */
    public function __construct(DataRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Data\ManageDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ManageDataRequest $request)
    {
        return view('backend.data.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateDataRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateDataRequest $request)
    {
        return view('backend.data.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDataRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return redirect()->route('admin.data.index')->withFlashSuccess(trans('alerts.backend.data.created'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Data\Data  $data
     * @param  EditDataRequestNamespace  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data, EditDataRequest $request)
    {
        return view('backend.data.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDataRequestNamespace  $request
     * @param  App\Models\Data\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataRequest $request, Data $data)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $data, $input );
        //return with successfull message
        return redirect()->route('admin.data.index')->withFlashSuccess(trans('alerts.backend.data.updated'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteDataRequestNamespace  $request
     * @param  App\Models\Data\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Data $data, DeleteDataRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($data);
        //returning with successfull message
        return redirect()->route('admin.data.index')->withFlashSuccess(trans('alerts.backend.data.deleted'));
    }
    
}
