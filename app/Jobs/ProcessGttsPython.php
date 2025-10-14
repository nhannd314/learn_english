<?php

namespace App\Jobs;

use App\Models\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessGttsPython implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $word;
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $scriptPath = base_path('app/Python/generate_gtts.py');
        $word = escapeshellarg($this->word->word);
        exec("python {$scriptPath} {$word}");

    }
}
