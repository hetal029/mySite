<?php

namespace App\Listeners\Backend\NoteCategories;

/**
 * Class BlogCategoryEventListener.
 */
class NoteCategoryEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'NoteCategory';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->notecategory->id)
            ->withText('trans("history.backend.notecategories.created") <strong>'.$event->notecategory->name.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->notecategory->id)
            ->withText('trans("history.backend.notecategories.updated") <strong>'.$event->notecategory->name.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->notecategory->id)
            ->withText('trans("history.backend.notecategories.deleted") <strong>'.$event->notecategory->name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\NoteCategories\NoteCategoryCreated::class,
            'App\Listeners\Backend\NoteCategories\NoteCategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\NoteCategories\NoteCategoryUpdated::class,
            'App\Listeners\Backend\NoteCategories\NoteCategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\NoteCategories\NoteCategoryDeleted::class,
            'App\Listeners\Backend\NoteCategories\NoteCategoryEventListener@onDeleted'
        );
    }
}
