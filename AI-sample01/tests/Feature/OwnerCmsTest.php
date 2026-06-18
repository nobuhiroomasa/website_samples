<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Room;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OwnerCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_owner_login_screen_is_available_and_default_login_route_is_unused(): void
    {
        $this->get('/owner-login')
            ->assertOk()
            ->assertSee('管理者ログイン');

        $this->get('/login')->assertNotFound();
    }

    public function test_guest_is_redirected_to_owner_login(): void
    {
        $this->get('/owner/dashboard')
            ->assertRedirect('/owner-login');
    }

    public function test_non_admin_user_cannot_access_owner_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get('/owner/dashboard')
            ->assertForbidden();
    }

    public function test_admin_can_login_from_owner_login(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/owner-login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect('/owner/dashboard');
    }

    public function test_non_admin_cannot_login_from_owner_login(): void
    {
        $user = User::factory()->create([
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('/owner-login')->post('/owner-login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/owner-login')
            ->assertSessionHasErrors('email');
    }

    public function test_admin_can_create_room(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post('/owner/rooms', [
            'name' => 'サクラ',
            'description' => '庭園を望む客室です。',
            'capacity' => 3,
            'amenities' => "Wi-Fi\nエアコン",
            'image' => UploadedFile::fake()->image('room.jpg'),
            'sort_order' => 5,
            'is_published' => 1,
        ]);

        $room = Room::query()->firstOrFail();

        $response->assertRedirect(route('owner.rooms.edit', $room, false))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('rooms', [
            'name' => 'サクラ',
            'capacity' => 3,
            'sort_order' => 5,
            'is_published' => true,
        ]);

        Storage::disk('public')->assertExists($room->image_path);
    }

    public function test_admin_can_update_site_settings_and_seo(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $siteSetting = SiteSetting::current();
        $seoSetting = SeoSetting::forPage('home');

        $response = $this->actingAs($admin)->put('/owner/settings', [
            'site_title' => '宿福 SHUKUFUKU 公式サイト',
            'catch_copy' => '人と人がつながる宿。',
            'description' => '新しい宿福の紹介です。',
            'phone' => '06-1111-2222',
            'address' => '大阪市都島区東野田町',
            'instagram_url' => 'https://example.com/instagram',
            'facebook_url' => 'https://example.com/facebook',
            'x_url' => 'https://example.com/x',
            'hero_catch_copy' => '囲炉裏と庭のある宿。',
            'home_concept_heading' => 'つながる古民家ステイ',
            'home_concept_description' => 'トップの紹介文です。',
            'home_primary_button_label' => '客室を見る',
            'home_secondary_button_label' => '予約相談',
            'about_heading' => '宿福の物語',
            'about_intro' => '宿福の導入文です。',
            'about_story_title' => '宿福の背景',
            'about_story' => '宿福の想いです。',
            'about_renovation' => '古民家改修の説明です。',
            'about_community' => '地域とのつながりです。',
            'stay_heading' => 'お部屋',
            'stay_intro' => '客室紹介の導入です。',
            'cafe_heading' => 'にじいろ堂と福庵',
            'cafe_intro' => 'カフェの導入文です。',
            'cafe_day_label' => '昼営業',
            'cafe_day_title' => 'にじいろ堂',
            'cafe_day_description' => '昼営業の説明です。',
            'cafe_night_label' => '夜営業',
            'cafe_night_title' => '福庵',
            'cafe_night_description' => '夜営業の説明です。',
            'news_heading' => 'お知らせとイベント',
            'news_intro' => 'ニュース導入です。',
            'news_announcements_title' => 'お知らせ一覧',
            'news_events_title' => 'イベント一覧',
            'gallery_heading' => '宿福ギャラリー',
            'gallery_intro' => '写真の説明です。',
            'access_heading' => 'アクセス情報',
            'access_intro' => 'アクセス導入です。',
            'access_address_title' => '所在地',
            'access_station_title' => '駅から',
            'access_tourist_title' => '周辺案内',
            'access_map_embed' => '<iframe src="https://maps.example.com"></iframe>',
            'access_station_info' => '駅から徒歩5分です。',
            'access_tourist_info' => '大阪城にもアクセス良好です。',
            'contact_heading' => 'お問い合わせはこちら',
            'contact_description' => 'お気軽にご相談ください。',
            'hero_image' => UploadedFile::fake()->image('hero.jpg'),
            'about_image' => UploadedFile::fake()->image('about.jpg'),
            'stay_image' => UploadedFile::fake()->image('stay.jpg'),
            'cafe_image' => UploadedFile::fake()->image('cafe.jpg'),
            'news_image' => UploadedFile::fake()->image('news.jpg'),
            'gallery_image' => UploadedFile::fake()->image('gallery.jpg'),
            'access_image' => UploadedFile::fake()->image('access.jpg'),
            'contact_image' => UploadedFile::fake()->image('contact.jpg'),
            'seo' => [
                'home' => [
                    'title' => 'トップ | 宿福 SHUKUFUKU',
                    'meta_description' => 'トップページの説明です。',
                    'og_image' => UploadedFile::fake()->image('og-home.jpg'),
                ],
            ],
        ]);

        $response->assertRedirect('/owner/settings')
            ->assertSessionHas('status');

        $siteSetting->refresh();
        $seoSetting->refresh();

        $this->assertSame('宿福 SHUKUFUKU 公式サイト', $siteSetting->site_title);
        $this->assertSame('つながる古民家ステイ', $siteSetting->home_concept_heading);
        $this->assertSame('宿福の物語', $siteSetting->about_heading);
        $this->assertSame('お問い合わせはこちら', $siteSetting->contact_heading);
        $this->assertSame('トップ | 宿福 SHUKUFUKU', $seoSetting->title);
        $this->assertSame('トップページの説明です。', $seoSetting->meta_description);

        Storage::disk('public')->assertExists($siteSetting->hero_image_path);
        Storage::disk('public')->assertExists($siteSetting->about_image_path);
        Storage::disk('public')->assertExists($siteSetting->stay_image_path);
        Storage::disk('public')->assertExists($siteSetting->cafe_image_path);
        Storage::disk('public')->assertExists($siteSetting->news_image_path);
        Storage::disk('public')->assertExists($siteSetting->gallery_image_path);
        Storage::disk('public')->assertExists($siteSetting->access_image_path);
        Storage::disk('public')->assertExists($siteSetting->contact_image_path);
        Storage::disk('public')->assertExists($seoSetting->og_image_path);
    }

    public function test_existing_site_setting_images_are_retained_when_no_new_file_is_uploaded(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $siteSetting = SiteSetting::current();
        $seoSetting = SeoSetting::forPage('home');

        $siteSetting->forceFill([
            'site_title' => '既存サイト',
            'catch_copy' => '既存コピー',
            'hero_image_path' => UploadedFile::fake()->image('hero-original.jpg')->store('site', 'public'),
            'about_image_path' => UploadedFile::fake()->image('about-original.jpg')->store('site', 'public'),
        ])->save();

        $seoSetting->forceFill([
            'og_image_path' => UploadedFile::fake()->image('og-original.jpg')->store('seo', 'public'),
        ])->save();

        $heroImagePath = $siteSetting->hero_image_path;
        $aboutImagePath = $siteSetting->about_image_path;
        $ogImagePath = $seoSetting->og_image_path;

        $response = $this->actingAs($admin)->put('/owner/settings', [
            'site_title' => '更新後サイト',
            'catch_copy' => '更新後コピー',
            'description' => 'テキストだけ更新します。',
            'seo' => [
                'home' => [
                    'title' => '更新後SEOタイトル',
                    'meta_description' => '更新後SEO説明',
                ],
            ],
        ]);

        $response->assertRedirect('/owner/settings')
            ->assertSessionHas('status');

        $siteSetting->refresh();
        $seoSetting->refresh();

        $this->assertSame($heroImagePath, $siteSetting->hero_image_path);
        $this->assertSame($aboutImagePath, $siteSetting->about_image_path);
        $this->assertSame($ogImagePath, $seoSetting->og_image_path);

        Storage::disk('public')->assertExists($heroImagePath);
        Storage::disk('public')->assertExists($aboutImagePath);
        Storage::disk('public')->assertExists($ogImagePath);
    }

    public function test_admin_can_view_inquiries(): void
    {
        $admin = User::factory()->admin()->create();
        $inquiry = Inquiry::query()->create([
            'name' => '田中花子',
            'email' => 'hanako@example.com',
            'phone' => '06-9999-8888',
            'message' => 'イベント利用について相談です。',
        ]);

        $this->actingAs($admin)
            ->get('/owner/inquiries')
            ->assertOk()
            ->assertSee('田中花子');

        $this->actingAs($admin)
            ->get('/owner/inquiries/'.$inquiry->id)
            ->assertOk()
            ->assertSee('イベント利用について相談です。');
    }
}
