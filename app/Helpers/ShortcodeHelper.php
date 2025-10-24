<?php

namespace App\Helpers;
use App\Models\Listen;
use App\Models\Sound;

class ShortcodeHelper
{
//    public static function parse(string $content): string
//    {
//        // Tìm tất cả shortcode dạng [audio id=1]
//        return preg_replace_callback('/\[listen\s+id=(\d+)\]/', function ($matches) {
//            $id = $matches[1];
//            $listen = Listen::find($id);
//
//            if (!$listen) {
//                return '';
//            }
//
//            return view('shortcodes.listen', compact('listen'))->render();
//        }, $content);
//    }

    public static function parse(string $content): string
    {
        // Mẫu shortcode tổng quát: [tag attr="value" attr2=value2]
        $pattern = '/\[(\w+)([^\]]*)\]/';

        return preg_replace_callback($pattern, function ($matches) {
            $tag = $matches[1];        // Tên shortcode, ví dụ: audio, image, quiz
            $attrString = trim($matches[2]); // Phần thuộc tính bên trong
            $attrs = self::parseAttributes($attrString);

            return self::renderShortcode($tag, $attrs);
        }, $content);
    }

    protected static function parseAttributes(string $attrString): array
    {
        $attrs = [];
        preg_match_all('/(\w+)=["\']?([^"\']+)["\']?/', $attrString, $matches, PREG_SET_ORDER);

        foreach ($matches as $m) {
            $attrs[$m[1]] = $m[2];
        }

        return $attrs;
    }

    protected static function renderShortcode(string $tag, array $attrs): string
    {
        return match ($tag) {
            'listen' => self::renderListen($attrs),
            'sounds' => self::renderSounds($attrs),
            default => "[{$tag}]", // nếu chưa hỗ trợ
        };
    }

    protected static function renderListen(array $attrs): string
    {
        $id = $attrs['id'] ?? null;
        if (!$id) return '';

        $listen = Listen::find($id);
        if (!$listen) {
            return '';
        }

        return view('shortcodes.listen', compact('listen'))->render();
    }

    protected static function renderSounds(array $attrs): string
    {
        $ids = $attrs['ids'] ?? '';
        if (!$ids) return '';
        $sounds = Sound::whereIn('id', explode(',', $ids))->get();

        return view('shortcodes.sounds', compact('sounds'))->render();
    }
}
