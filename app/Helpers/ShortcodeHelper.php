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

            return view('shortcodes.audio', compact('audio', 'url', 'transcript'))->render();
        }, $content);
    }
}
