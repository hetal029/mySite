<?php

namespace App\Listeners\Backend\Notes;

/**
 * Class BlogEventListener.
 */
class NoteEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Note';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->notes->id)
            ->withText('trans("history.backend.notes.created") <strong>'.$event->notes->title.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

     /**
     * @param $event
     */
    public function onReplicated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->notes->id)
            ->withText('trans("history.backend.notes.created") <strong>'.$event->notes->title.'</strong>')
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
            ->withEntity($event->notes->id)
            ->withText('trans("history.backend.notes.updated") <strong>'.$event->notes->title.'</strong>')
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
            ->withEntity($event->notes->id)
            ->withText('trans("history.backend.notes.deleted") <strong>'.$event->notes->title.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
        
    }

     /**
     * @param $event
     */
    public function onAllDeleted($event)
    {
       foreach ($event->notes as $note) {
           history()->withType($this->history_slug)
            ->withEntity($note->id)
            ->withText('trans("history.backend.notes.deleted") <strong>'.$note->title.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
       }
 
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Notes\NoteCreated::class,
            'App\Listeners\Backend\Notes\NoteEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Notes\NoteReplicated::class,
            'App\Listeners\Backend\Notes\NoteEventListener@onReplicated'
        );

        $events->listen(
            \App\Events\Backend\Notes\NoteUpdated::class,
            'App\Listeners\Backend\Notes\NoteEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Notes\NoteDeleted::class,
            'App\Listeners\Backend\Notes\NoteEventListener@onDeleted'
        );

         $events->listen(
            \App\Events\Backend\Notes\NoteAllDeleted::class,
            'App\Listeners\Backend\Notes\NoteEventListener@onAllDeleted'
        );
    }
}
