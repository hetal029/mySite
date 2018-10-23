<?php

namespace App\Http\Controllers\Backend\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Notes\ManageNotesRequest;
use App\Http\Requests\Backend\Notes\StoreNotesRequest;
use App\Http\Requests\Backend\Notes\UpdateNotesRequest;
use App\Http\Responses\Backend\Note\CreateResponse;
use App\Http\Responses\Backend\Note\EditResponse;
use App\Http\Responses\Backend\Note\IndexResponse;
use App\Http\Responses\RedirectResponse;
use App\Models\Notes\Note;
use App\Repositories\Backend\Notes\NotesRepository;
use App\Models\NoteCategories\NoteCategory;

/**
 * Class BlogsController.
 */
class NotesController extends Controller
{
    /**
     * Blog Status.
     */ 
    protected $status = [
        'Published' => 'Published',
        'Draft'     => 'Draft',
        'InActive'  => 'InActive',
        'Scheduled' => 'Scheduled',
    ];

    /**
     * @var BlogsRepository
     */
    protected $note;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(NotesRepository $note)
    {
        $this->note = $note;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\IndexResponse
     */
    public function index(ManageNotesRequest $request)
    {
        return new IndexResponse($this->status);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageNotesRequest $request)
    {
        $noteCategories = NoteCategory::getSelectData();
        return new CreateResponse($this->status,$noteCategories);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreNotesRequest $request)
    {
        $this->note->create($request->except('_token'));

        return new RedirectResponse(route('admin.notes.index'), ['flash_success' => trans('alerts.backend.notes.created')]);
    }

     /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function replica(ManageNotesRequest $request)
    {
        $this->note->replica($request->note);
        return json_encode(['success'=>trans('alerts.backend.notes.created')]);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Note $note, ManageNotesRequest $request)
    {
        $noteCategories = NoteCategory::getSelectData();
        return new EditResponse($note, $this->status, $noteCategories);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Note $note, UpdateNotesRequest $request)
    {
        $input = $request->all();

        $this->note->update($note, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.notes.index'), ['flash_success' => trans('alerts.backend.notes.updated')]);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Note $note, ManageNotesRequest $request)
    {
        $this->note->delete($note);

        return new RedirectResponse(route('admin.notes.index'), ['flash_success' => trans('alerts.backend.notes.deleted')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(ManageNotesRequest $request)
    {
        $this->note->deleteAll($request);
        return json_encode(['success'=>trans('alerts.backend.notes.deleted')]);
    }
}
