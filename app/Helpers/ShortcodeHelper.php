<?php

namespace App\Helpers;
use App\Models\Audio;

class ShortcodeHelper
{
    public static function parse(string $content): string
    {
        // Tìm tất cả shortcode dạng [audio id=1]
        return preg_replace_callback('/\[audio\s+id=(\d+)\]/', function ($matches) {
            $id = $matches[1];
            $audio = Audio::find($id);

            if (!$audio) {
                return '';
            }

            $url = asset('storage/' . $audio->file_url);
            $transcript = e($audio->transcript ?? '');

            return <<<HTML
                <div class="audio-block my-4">
                    <h3 class="mb-3">{$audio->title}</h3>
                    <div class="mb-3">
                        <audio style="width: 500px" controls src="{$url}"></audio>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTranscript" aria-expanded="false" aria-controls="collapseTranscript">
                            Show transcript
                        </button>
                    </div>
                    <div class="collapse" id="collapseTranscript">
                        <div class="card card-body">
                            {$transcript}
                        </div>
                    </div>
                </div>
            HTML;
        }, $content);
    }
}
