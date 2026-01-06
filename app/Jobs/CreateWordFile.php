<?php

namespace App\Jobs;

use App\Helpers\CrawlHelper;
use App\Models\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class CreateWordFile implements ShouldQueue
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
        $html = CrawlHelper::crawl($this->word->source);

        $ipa = CrawlHelper::getIpa($html);
        if ($ipa) {
            $this->word->update([
                'ipa' => $ipa,
            ]);
        }

        $file = CrawlHelper::getFile($html);
        Storage::disk('public')->put($this->word->file, $file);
    }
}
