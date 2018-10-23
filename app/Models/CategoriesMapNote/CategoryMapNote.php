<?php

namespace App\Models\CategoriesMapNote;

use App\Models\BaseModel;

class CategoryMapNote extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories_map_note';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
