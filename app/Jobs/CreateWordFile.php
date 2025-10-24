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
//        $url = 'https://dictionary.cambridge.org/dictionary/english/' . $this->word->source;
//
//        $userAgents = [
//            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
//            //'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
//            //'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
//            //'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15A372 Safari/604.1'
//        ];
//        $agent = $userAgents[array_rand($userAgents)];
//
//        $response = Http::withHeaders([
//            'User-Agent' => $agent,
//            'Accept-Language' => 'en-US,en;q=0.9',
//            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//        ])->get($url);
//
//        // --- BƯỚC 2: Phân tích HTML và tìm URL audio ---
//        $crawler = new Crawler($response->body());
//
//        // Tìm thẻ <audio id="audio2">
//        $audioNode = $crawler->filter('audio#audio2 source[type="audio/mpeg"]')->first();
//
//        if ($audioNode->count() === 0) {
//            return;
//        }
//
//        // 🧩 3️⃣ Lấy đường dẫn mp3
//        $src = $audioNode->attr('src');
//
//        // Nếu là link tương đối → nối domain
//        if (str_starts_with($src, '/')) {
//            $src = 'https://dictionary.cambridge.org' . $src;
//        }
//
//        $audioResponse = Http::withHeaders([
//            'User-Agent' => $agent,
//            'Accept-Language' => 'en-US,en;q=0.9',
//            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//        ])->get($src);

        $html = CrawlHelper::crawl($this->word->source);
        $file = CrawlHelper::getFile($html);
        Storage::disk('public')->put($this->word->file, $file);
    }
}
