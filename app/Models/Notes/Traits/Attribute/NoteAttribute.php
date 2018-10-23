<?php

namespace App\Models\Notes\Traits\Attribute;

/**
 * Class BlogAttribute.
 */
trait NoteAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">'.
                $this->getEditButtonAttribute('edit-note', 'admin.notes.edit').
                $this->getDeleteButtonAttribute('delete-note', 'admin.notes.destroy').
                '</div>';
    }
}