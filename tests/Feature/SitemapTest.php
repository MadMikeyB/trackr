<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_can_have_a_sitemap_index()
    {
        $this->get(route('sitemap.index'))->assertStatus(200);
    }

    public function test_the_application_can_have_a_sitemap_for_pages()
    {
        $this->get(route('sitemap.pages'))->assertStatus(200);
    }
}
