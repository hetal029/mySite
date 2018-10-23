<?php

namespace App\Models\NoteCategories\Traits\Relationship;

use App\Models\Access\User\User;

/**
 * Class BlogCategoryRelationship.
 */
trait NoteCategoryRelationship
{
    /**
     * BlogCategories belongs to relationship with state.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
