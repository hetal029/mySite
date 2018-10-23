<?php

namespace App\Models\Notes\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\NoteCategories\NoteCategory;
/**
 * Class BlogRelationship.
 */
trait NoteRelationship
{
	/**
     * Notes has many relationship with categories.
     */
    public function categories()
    {
        return $this->belongsToMany(NoteCategory::class, 'categories_map_note', 'note_id','category_id');
    }

    /**
     * Blogs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
