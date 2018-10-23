<?php

namespace App\Repositories\Backend\NoteCategories;

use App\Events\Backend\NoteCategories\NoteCategoryCreated;
use App\Events\Backend\NoteCategories\NoteCategoryDeleted;
use App\Events\Backend\NoteCategories\NoteCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\NoteCategories\NoteCategory;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class BlogCategoriesRepository.
 */
class NoteCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = NoteCategory::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.note_categories.table').'.created_by')
            ->select([
                config('module.note_categories.table').'.id',
                config('module.note_categories.table').'.name',
                config('module.note_categories.table').'.status',
                config('module.note_categories.table').'.created_by',
                config('module.note_categories.table').'.created_at',
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
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.notecategories.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['created_by'] = access()->user()->id;

            if ($notecategory = NoteCategory::create($input)) {
                event(new NoteCategoryCreated($notecategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notecategories.create_error'));
        });
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogcategory
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(NoteCategory $notecategory, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $notecategory->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.notecategories.already_exists'));
        }

        DB::transaction(function () use ($notecategory, $input) {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['updated_by'] = access()->user()->id;

            if ($notecategory->update($input)) {
                event(new NoteCategoryUpdated($notecategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notecategories.update_error'));
        });
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory $blogcategory
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(NoteCategory $notecategory)
    {
        DB::transaction(function () use ($notecategory) {
            if ($notecategory->delete()) {
                event(new NoteCategoryDeleted($notecategory));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.notecategories.delete_error'));
        });
    }
}
