<?php

namespace App\Models\NoteCategories;

use App\Models\BaseModel;
use App\Models\NoteCategories\Traits\Attribute\NoteCategoryAttribute;
use App\Models\NoteCategories\Traits\Relationship\NoteCategoryRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteCategory extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        NoteCategoryAttribute,
        NoteCategoryRelationship {
            // BlogCategoryAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ['name', 'status', 'created_by', 'updated_by'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.note_categories.table');
    }
}
