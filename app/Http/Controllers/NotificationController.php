<?php

namespace App\Http\Controllers;

use App\Models\WebNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = WebNotification::orderBy('created_at', 'desc')->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markAllRead()
    {
        WebNotification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }

    public function getUnreadCount()
    {
        return response()->json([
            'count' => WebNotification::where('is_read', false)->count()
        ]);
    }
}
