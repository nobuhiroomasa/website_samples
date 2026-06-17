<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Inquiry;
use App\Models\Room;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_public_pages_are_accessible(): void
    {
        Room::factory()->create(['name' => 'カスミ']);
        Announcement::factory()->create(['title' => '営業のお知らせ']);
        Event::factory()->create(['title' => '囲炉裏イベント']);
        GalleryItem::factory()->create(['category' => '宿泊']);

        $routes = [
            '/' => '宿福 SHUKUFUKU',
            '/about' => '宿福について',
            '/stay' => 'カスミ',
            '/cafe-bar' => 'カフェ＆バー',
            '/news-events' => '営業のお知らせ',
            '/gallery' => 'ギャラリー',
            '/access' => 'アクセス',
            '/contact' => 'お問い合わせ',
        ];

        foreach ($routes as $path => $text) {
            $this->get($path)
                ->assertOk()
                ->assertSee($text);
        }
    }

    public function test_unpublished_content_is_hidden_from_public_pages(): void
    {
        Room::factory()->create(['name' => '公開客室', 'is_published' => true]);
        Room::factory()->create(['name' => '非公開客室', 'is_published' => false]);
        Announcement::factory()->create(['title' => '公開お知らせ', 'is_published' => true]);
        Announcement::factory()->create(['title' => '非公開お知らせ', 'is_published' => false]);

        $this->get('/stay')
            ->assertOk()
            ->assertSee('公開客室')
            ->assertDontSee('非公開客室');

        $this->get('/news-events')
            ->assertOk()
            ->assertSee('公開お知らせ')
            ->assertDontSee('非公開お知らせ');
    }

    public function test_contact_form_stores_inquiry(): void
    {
        $response = $this->post('/contact', [
            'name' => '山田太郎',
            'email' => 'taro@example.com',
            'phone' => '090-1234-5678',
            'message' => '宿泊について問い合わせです。',
        ]);

        $response->assertRedirect('/contact')
            ->assertSessionHas('status');

        $this->assertDatabaseHas('inquiries', [
            'name' => '山田太郎',
            'email' => 'taro@example.com',
            'phone' => '090-1234-5678',
            'message' => '宿泊について問い合わせです。',
        ]);
    }

    public function test_customized_site_settings_are_rendered_on_public_pages(): void
    {
        $siteSetting = SiteSetting::current();
        $siteSetting->update([
            'about_heading' => '新しい宿福について',
            'about_story_title' => '宿の想い',
            'news_heading' => '最新ニュース',
            'gallery_heading' => '写真ギャラリー',
        ]);

        $this->get('/about')
            ->assertOk()
            ->assertSee('新しい宿福について')
            ->assertSee('宿の想い');

        $this->get('/news-events')
            ->assertOk()
            ->assertSee('最新ニュース');

        $this->get('/gallery')
            ->assertOk()
            ->assertSee('写真ギャラリー');
    }

    public function test_contact_form_requires_required_fields(): void
    {
        $response = $this->from('/contact')->post('/contact', [
            'name' => '',
            'email' => '',
            'message' => '',
        ]);

        $response->assertRedirect('/contact')
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertSame(0, Inquiry::count());
    }
}
