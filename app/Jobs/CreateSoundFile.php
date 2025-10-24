<?php

namespace App\Jobs;

use App\Helpers\CrawlHelper;
use App\Models\Sound;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateSoundFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $sound;
    public function __construct(Sound $sound)
    {
        $this->sound = $sound;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $html = CrawlHelper::crawl($this->sound->title);
        $file = CrawlHelper::getFile($html);
        $path = 'sounds/' . Str::slug($this->sound->title) . '.mp3';

        $this->sound->update([
            'file' => $path,
        ]);
        Storage::disk('public')->put($path, $file);
    }
}
