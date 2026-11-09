<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TranslationKeysTest extends TestCase
{
    public function test_english_and_arabic_keys_match(): void
    {
        $english = require dirname(__DIR__, 2).'/lang/en/portfolio.php';
        $arabic = require dirname(__DIR__, 2).'/lang/ar/portfolio.php';

        $this->assertSame($this->flatten($english), $this->flatten($arabic));
    }

    /**
     * @param  array<string, mixed>  $array
     * @return list<string>
     */
    private function flatten(array $array, string $prefix = ''): array
    {
        $keys = [];

        foreach ($array as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix.'.'.$key;
            if (is_array($value) && array_is_list($value) && isset($value[0]) && is_array($value[0])) {
                foreach ($value as $index => $item) {
                    $keys = array_merge($keys, $this->flatten($item, $path.'.'.$index));
                }
            } elseif (is_array($value)) {
                $keys = array_merge($keys, $this->flatten($value, $path));
            } else {
                $keys[] = $path;
            }
        }

        sort($keys);

        return $keys;
    }
}
