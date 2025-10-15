<?php

namespace App\Jobs;

use App\Models\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
//        $scriptPath = base_path('app/Python/generate_gtts.py');
//        $word = escapeshellarg($this->word->word);
//        exec("python {$scriptPath} {$word}");
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.api.gtts') . '/tts', [
            'text' => $this->word->word,
            'lang' => 'en',
        ]);

        if ($response->failed()) return;

        $filename = $this->word->word . '.mp3';
        Storage::disk('public')->put('words/' . $filename, $response->body());
    }
}
