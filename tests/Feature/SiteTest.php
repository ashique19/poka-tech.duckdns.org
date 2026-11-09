<?php

namespace Tests\Feature;

use Tests\TestCase;

class SiteTest extends TestCase
{
    public function test_root_redirects_using_accept_language(): void
    {
        $this->get('/')->assertRedirect('/en');

        $this->withHeaders(['Accept-Language' => 'ar-SA,en;q=0.5'])
            ->get('/')
            ->assertRedirect('/ar');
    }

    public function test_english_home_renders(): void
    {
        $response = $this->get('/en');

        $response->assertOk();
        $response->assertSee('lang="en"', false);
        $response->assertSee('dir="ltr"', false);
        $response->assertSee('data-theme="theme-2"', false);
        $response->assertSee('brand/concept-2.svg', false);
        $response->assertSee('Laravel and Livewire products for Saudi and Gulf businesses.', false);
        $response->assertSee('See work', false);
        $response->assertSee('Get a quote', false);
        $response->assertSee('15 years building software', false);
        $response->assertSee('https://github.com/ashique19', false);
        $response->assertSee('https://wa.me/8801785636359', false);
        $response->assertSee('ashique19@gmail.com', false);
        $response->assertSee('Representative mockup', false);
        $response->assertSee('ZATCA e-invoicing', false);
        $response->assertSee('Academia Training', false);
        $response->assertSee('hreflang="ar"', false);
        $response->assertSee('hreflang="en"', false);
        $response->assertDontSee('Calendly', false);
        $response->assertDontSee('[PLACEHOLDER: starting price]', false);
        $response->assertDontSee('testimonial', false);
    }

    public function test_arabic_home_is_rtl(): void
    {
        $response = $this->get('/ar');

        $response->assertOk();
        $response->assertSee('lang="ar"', false);
        $response->assertSee('dir="rtl"', false);
        $response->assertSee('اطّلع على الأعمال', false);
        $response->assertSee('اطلب عرض سعر', false);
        $response->assertSee('نموذج تمثيلي', false);
        $response->assertSee('lang="ar"', false);
        $response->assertDontSee('dir="ltr"', false);
    }

    public function test_case_study_pages_hide_empty_demo_urls(): void
    {
        $response = $this->get('/en/work/zatca-e-invoicing');

        $response->assertOk();
        $response->assertSee('claims ZATCA certification', false);
        $response->assertSee('Fancy Coffee', false);
        $response->assertSee('Demo on request', false);
        $response->assertSee('project=zatca-e-invoicing', false);
        $response->assertSee('https://github.com/ashique19/zatca', false);
        $response->assertDontSee('Live demo', false);

        $this->get('/en/work/academia-training')
            ->assertOk()
            ->assertSee('SlimCijfers Analytics B.V.', false)
            ->assertDontSee('Live demo', false);

        $this->get('/ar/work/zatca-e-invoicing')
            ->assertOk()
            ->assertSee('dir="rtl"', false);
    }

    public function test_sample_page_is_labeled_as_a_mockup(): void
    {
        $this->get('/en/samples/accounting')
            ->assertOk()
            ->assertSee('Representative mockup', false)
            ->assertSee('Not a client project', false);

        $this->get('/en/samples/not-a-real-client')->assertNotFound();
        $this->get('/en/work/missing')->assertNotFound();
    }

    public function test_dev_mockup_screen_states_it_is_not_a_client_project(): void
    {
        $this->get('/mockups/pos')
            ->assertOk()
            ->assertSee('Representative mockup', false)
            ->assertSee('نموذج تمثيلي', false)
            ->assertSee('Not a client project', false)
            ->assertSee('noindex', false);

        $this->get('/mockups/unknown')->assertNotFound();
    }

    public function test_sitemap_and_robots(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertSee('Sitemap: https://poka-tech.duckdns.org/sitemap.xml', false);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('https://poka-tech.duckdns.org/en', false)
            ->assertSee('https://poka-tech.duckdns.org/ar/work/zatca-e-invoicing', false)
            ->assertSee('https://poka-tech.duckdns.org/en/samples/accounting', false)
            ->assertDontSee('/mockups/', false);
    }

    public function test_theme_preview_query_is_local_to_testing(): void
    {
        $this->get('/en?preview_theme=theme-2&preview_logo=concept-3')
            ->assertOk()
            ->assertSee('data-theme="theme-2"', false)
            ->assertSee('brand/concept-3.svg', false);
    }
}
