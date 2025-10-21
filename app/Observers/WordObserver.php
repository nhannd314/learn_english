<?php

namespace App\Observers;

use App\Jobs\ProcessGttsPython;
use App\Models\Word;

class WordObserver
{
    /**
     * Handle the Word "created" event.
     */
    public function created(Word $word): void
    {
        ProcessGttsPython::dispatch($word->word);
    }

    /**
     * Handle the Word "updated" event.
     */
    public function updated(Word $word): void
    {
        //
    }

    /**
     * Handle the Word "deleted" event.
     */
    public function deleted(Word $word): void
    {
        //
    }

    /**
     * Handle the Word "restored" event.
     */
    public function restored(Word $word): void
    {
        //
    }

    /**
     * Handle the Word "force deleted" event.
     */
    public function forceDeleted(Word $word): void
    {
        //
    }
}
