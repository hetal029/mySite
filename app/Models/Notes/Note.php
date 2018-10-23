<?php

namespace App\Models\Notes;

use App\Models\BaseModel;
use App\Models\Notes\Traits\Attribute\NoteAttribute;
use App\Models\Notes\Traits\Relationship\NoteRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        NoteAttribute,
        NoteRelationship {
            // BlogAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $fillable = [
        'title',
        'slug',
        'publish_datetime',
        'content',
        'status',
        'featured_image',
        'created_by',
    ];

    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.Notes.table');
    }
}
