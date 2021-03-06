<?php

namespace App\Events\Backend\NoteCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCategoryCreated.
 */
class NoteCategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $notecategory;

    /**
     * @param $blogcategory
     */
    public function __construct($notecategory)
    {
        $this->notecategory = $notecategory;
    }
}
