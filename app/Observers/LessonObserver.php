<?php

namespace App\Observers;

use App\Models\Lesson;
use App\Models\Word;

class LessonObserver
{
    /**
     * Handle the Lesson "created" event.
     */
    public function created(Lesson $lesson): void
    {
        $this->syncVocabulary($lesson);
    }

    /**
     * Handle the Lesson "updated" event.
     */
    public function updated(Lesson $lesson): void
    {
        if ($lesson->wasChanged('vocabulary')) {
            $this->syncVocabulary($lesson);
        }
    }

    protected function syncVocabulary(Lesson $lesson): void
    {
        $vocabulary = $lesson->vocabulary;
        if (empty($vocabulary)) {
            $lesson->words()->detach();
            return;
        }

        $lines = explode("\n", $vocabulary);
        $wordIds = [];
        $order = 1;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Định dạng: source (pos) mean
            // source có thể có nhiều từ, là phần trước dấu ( đầu tiên.
            // mean là phần còn lại, phân tách bởi (x) với x là pos
            if (preg_match('/^([^(]+)(.*)$/', $line, $matches)) {
                $source = trim($matches[1]);
                $rest = trim($matches[2]);

                if (empty($source)) {
                    continue;
                }

                $means = [];
                if (!empty($rest)) {
                    if (preg_match_all('/\(([^)]+)\)\s*([^(\n]+)/', $rest, $meanMatches, PREG_SET_ORDER)) {
                        foreach ($meanMatches as $m) {
                            $vn = trim($m[2]);
                            $vn = rtrim($vn, ', ');
                            $means[] = [
                                'pos' => trim($m[1]),
                                'vn' => $vn,
                            ];
                        }
                    }
                }

                $word = Word::firstOrCreate(
                    ['source' => $source],
                    ['mean' => $means]
                );

                $wordIds[$word->id] = ['order' => $order++];
            } else {
                // Trường hợp không khớp regex (thường là dòng chỉ có source mà không có dấu '(')
                $source = trim($line);
                if (empty($source)) {
                    continue;
                }
                $word = Word::firstOrCreate(['source' => $source]);
                $wordIds[$word->id] = ['order' => $order++];
            }
        }

        $lesson->words()->sync($wordIds);
    }

    /**
     * Handle the Lesson "deleted" event.
     */
    public function deleted(Lesson $lesson): void
    {
        //
    }

    /**
     * Handle the Lesson "restored" event.
     */
    public function restored(Lesson $lesson): void
    {
        //
    }

    /**
     * Handle the Lesson "force deleted" event.
     */
    public function forceDeleted(Lesson $lesson): void
    {
        //
    }
}
