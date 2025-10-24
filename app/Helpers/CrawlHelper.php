<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class CrawlHelper
{
    protected static array $userAgents = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
        //'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
        //'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
        //'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15A372 Safari/604.1'
    ];

    public static function crawl(string $title)
    {
        $url = 'https://dictionary.cambridge.org/dictionary/english/' . $title;
        $agent = static::$userAgents[array_rand(static::$userAgents)];

        $response = Http::withHeaders([
            'User-Agent' => $agent,
            'Accept-Language' => 'en-US,en;q=0.9',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        ])->get($url);
        return $response->body();
    }

    public static function getFile($html)
    {
        // --- BƯỚC 2: Phân tích HTML và tìm URL audio ---
        $crawler = new Crawler($html);

        // Tìm thẻ <audio id="audio2">
        $audioNode = $crawler->filter('audio#audio2 source[type="audio/mpeg"]')->first();

        if ($audioNode->count() === 0) {
            return;
        }

        // 🧩 3️⃣ Lấy đường dẫn mp3
        $src = $audioNode->attr('src');

        // Nếu là link tương đối → nối domain
        if (str_starts_with($src, '/')) {
            $src = 'https://dictionary.cambridge.org' . $src;
        }

        $agent = static::$userAgents[array_rand(static::$userAgents)];
        $audioResponse = Http::withHeaders([
            'User-Agent' => $agent,
            'Accept-Language' => 'en-US,en;q=0.9',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        ])->get($src);

        return $audioResponse->body();
        //Storage::disk('public')->put($this->word->file, $audioResponse->body());
    }
}
