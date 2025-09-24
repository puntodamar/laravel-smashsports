<?php

namespace App\Support;

final class Phone
{
    /**
     * Normalize Indonesian phone numbers to "62…" (no plus).
     * Examples: "0812 3456-789" -> "628123456789", "+62811-123-456" -> "62811123456"
     */
    public static function normalize(?string $input): string
    {
        $s = trim((string) $input);

        // keep digits and leading '+'
        $s = preg_replace('/[^\d+]/', '', $s) ?? '';

        // strip leading '+'
        if (str_starts_with($s, '+')) {
            $s = substr($s, 1);
        }

        // 0XXXXXXXXX -> 62XXXXXXXXX
        if (str_starts_with($s, '0')) {
            return '62' . substr($s, 1);
        }

        // already 62…
        if (str_starts_with($s, '62')) {
            return $s;
        }

        // otherwise return as-is; validator will catch invalid country codes
        return $s;
    }
}
