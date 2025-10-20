<?php

namespace App\Jobs;

use App\Helpers\SlugHelper;
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
    public function __construct(string $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            //'Accept' => 'audio/mpeg',
        ])->post(config('services.api.gtts'), [
            'text' => $this->word,
            'lang' => 'en',
        ]);

        if ($response->failed()) return;

        Storage::disk('public')->put('words/' . SlugHelper::generateWordAudioUrl($this->word), $response->body());
    }
}
