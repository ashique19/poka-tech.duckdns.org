<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        config([
            'app.url' => 'https://poka-tech.duckdns.org',
            'portfolio.contact.whatsapp' => '8801785636359',
            'portfolio.contact.email' => 'ashique19@gmail.com',
            'portfolio.theme' => 'theme-1',
            'portfolio.logo' => 'concept-1',
        ]);

        URL::forceRootUrl('https://poka-tech.duckdns.org');
        URL::forceScheme('https');
    }
}
