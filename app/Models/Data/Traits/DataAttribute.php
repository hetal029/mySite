<?php

namespace App\Models\Data\Traits;

/**
 * Class DataAttribute.
 */
trait DataAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                '.$this->getEditButtonAttribute("edit-data", "admin.data.edit").'
                '.$this->getDeleteButtonAttribute("delete-data", "admin.data.destroy").'
                </div>';
    }
}
