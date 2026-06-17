<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Inquiry;
use App\Models\Room;
use Illuminate\View\View;

class OwnerDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('owner.dashboard', [
            'roomCount' => Room::query()->count(),
            'announcementCount' => Announcement::query()->count(),
            'eventCount' => Event::query()->count(),
            'galleryCount' => GalleryItem::query()->count(),
            'recentInquiries' => Inquiry::query()->latest()->limit(5)->get(),
        ]);
    }
}
