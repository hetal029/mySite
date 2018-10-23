<?php

namespace App\Repositories\Backend\Notes;

use App\Events\Backend\Notes\NoteCreated;
use App\Events\Backend\Notes\NoteDeleted;
use App\Events\Backend\Notes\NoteUpdated;
use App\Events\Backend\Notes\NoteReplicated;
use App\Exceptions\GeneralException;
use App\Models\Notes\Note;
use App\Repositories\BaseRepository;
use App\Models\CategoriesMapNote\CategoryMapNote;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Events\Backend\Notes\NoteAllDeleted;

/**
 * Class BlogsRepository.
 */
class NotesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Note::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'note'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.notes.table').'.created_by')
            ->select([
                config('module.notes.table').'.id',
                config('module.notes.table').'.title',
                config('module.notes.table').'.publish_datetime',
                config('module.notes.table').'.status',
                config('module.notes.table').'.created_by',
                config('module.notes.table').'.created_at',
                config('access.users_table').'.first_name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $categoriesArray = $this->createCategories($input['categories']);
        unset($input['categories']);
        DB::transaction(function () use ($input, $categoriesArray) {
            $input['slug'] = str_slug($input['title']);
            $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
            $input = $this->uploadImage($input);
            $input['created_by'] = access()->user()->id;

            if ($note = Note::create($input)) {

                if (count($categoriesArray)) {
                    $note->categories()->sync($categoriesArray);
                }

                event(new NoteCreated($note));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notes.create_error'));
        });
    }

    /**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function update(Note $note, array $input)
    {
        $input['slug'] = str_slug($input['title']);
        $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
        $input['updated_by'] = access()->user()->id;
        $categoriesArray = $this->createCategories($input['categories']);
         unset($input['categories']);

        // Uploading Image
        if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($note);
            $input = $this->uploadImage($input);
        }

        DB::transaction(function () use ($note, $input, $categoriesArray) {
            if ($note->update($input)) {
                 // Inserting associated category's id in mapper table
                if (count($categoriesArray)) {
                    $note->categories()->sync($categoriesArray);
                }

                event(new NoteUpdated($note));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.notes.update_error')
            );
        });
    }
/**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function replica($note)
    {
        DB::transaction(function () use ($note) {
            $note = Note::find($note);
            $notes = $note->replicate();
            $categoriesArray = $note->categories->pluck('id')->toArray();
            if ($notes->save()) {

                if (count($categoriesArray)) {
                    $notes->categories()->sync($categoriesArray);
                }

                event(new NoteReplicated($notes));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notes.create_error'));
       });

    }

   
    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Note $note)
    {
        DB::transaction(function () use ($note) {
            if ($note->delete()) {
                CategoryMapNote::where('note_id', $note->id)->delete();
                event(new NoteDeleted($note));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notes.delete_error'));
        });
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function deleteAll($request)
    {
        $ids = $request->input('checkbox');
        $notes = Note::whereIn('id',$ids)->get();
            if(Note::whereIn('id',$ids)->delete())
            {
                event(new NoteAllDeleted($notes));
                 return true;
            }
        throw new GeneralException(trans('exceptions.backend.notes.delete_error'));
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        $avatar = $input['featured_image'];
        if (isset($input['featured_image']) && !empty($input['featured_image'])) {
            $fileName = time().$avatar->getClientOriginalName();
            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['featured_image' => $fileName]);
            return $input;
        }
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->featured_image;

        return $this->storage->delete($this->upload_path.$fileName);
    }

     /**
     * Creating Categories.
     *
     * @param Array($categories)
     *
     * @return array
     */
    public function createCategories($categories)
    {
        //Creating a new array for categories (newly created)
        $categories_array = [];

        foreach ($categories as $category) {
            if (is_numeric($category)) {
                $categories_array[] = $category;
            } else {
                $newCategory = BlogCategory::create(['name' => $category, 'status' => 1, 'created_by' => 1]);

                $categories_array[] = $newCategory->id;
            }
        }

        return $categories_array;
    }

}
