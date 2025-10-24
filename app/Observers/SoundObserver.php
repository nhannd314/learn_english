<?php

namespace App\Observers;

use App\Jobs\CreateSoundFile;
use App\Models\Sound;

class SoundObserver
{
    /**
     * Handle the Sound "created" event.
     */
    public function created(Sound $sound): void
    {
        if (!$sound->file)
        CreateSoundFile::dispatch($sound);
    }

    /**
     * Handle the Sound "updated" event.
     */
    public function updated(Sound $sound): void
    {
        //
    }

    /**
     * Handle the Sound "deleted" event.
     */
    public function deleted(Sound $sound): void
    {
        //
    }

    /**
     * Handle the Sound "restored" event.
     */
    public function restored(Sound $sound): void
    {
        //
    }

    /**
     * Handle the Sound "force deleted" event.
     */
    public function forceDeleted(Sound $sound): void
    {
        //
    }
}
