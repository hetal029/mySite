<?php

namespace App\Http\Controllers\Backend\NoteCategories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NoteCategories\CreateNoteCategoriesRequest;
use App\Http\Requests\Backend\NoteCategories\DeleteNoteCategoriesRequest;
use App\Http\Requests\Backend\NoteCategories\EditNoteCategoriesRequest;
use App\Http\Requests\Backend\NoteCategories\ManageNoteCategoriesRequest;
use App\Http\Requests\Backend\NoteCategories\StoreNoteCategoriesRequest;
use App\Http\Requests\Backend\NoteCategories\UpdateNoteCategoriesRequest;
use App\Http\Responses\Backend\NoteCategory\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\NoteCategories\NoteCategory;
use App\Repositories\Backend\NoteCategories\NoteCategoriesRepository;

class NoteCategoriesController extends Controller
{
     protected $notecategory;

    /**
     * @param BlogCategoriesRepository $blogcategory
     */
    public function __construct(NoteCategoriesRepository $notecategory)
    {
        $this->notecategory = $notecategory;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageNoteCategoriesRequest $request)
    {
        return new ViewResponse('backend.notecategories.index');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateNoteCategoriesRequest $request)
    {
        return new ViewResponse('backend.notecategories.create');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreNoteCategoriesRequest $request)
    {
        $this->notecategory->create($request->all());

        return new RedirectResponse(route('admin.noteCategories.index'), ['flash_success' => trans('alerts.backend.notecategories.created')]);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                             $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\EditBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogCategory\EditResponse
     */
    public function edit(NoteCategory $noteCategory, EditNoteCategoriesRequest $request)
    {
        return new EditResponse($noteCategory);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(NoteCategory $noteCategory, UpdateNoteCategoriesRequest $request)
    {
        $this->notecategory->update($noteCategory, $request->all());

        return new RedirectResponse(route('admin.noteCategories.index'), ['flash_success' => trans('alerts.backend.notecategories.updated')]);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(NoteCategory $noteCategory, DeleteNoteCategoriesRequest $request)
    {
        $this->notecategory->delete($noteCategory);

        return new RedirectResponse(route('admin.noteCategories.index'), ['flash_success' => trans('alerts.backend.notecategories.deleted')]);
    }
}
