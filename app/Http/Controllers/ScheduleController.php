<?php

namespace App\Http\Controllers;

use App\Models\FeedingSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = FeedingSchedule::orderBy('time', 'asc')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:60',
        ]);

        FeedingSchedule::create([
            'time' => $request->input('time'),
            'duration' => $request->integer('duration'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, FeedingSchedule $schedule)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:60',
        ]);

        $schedule->update([
            'time' => $request->input('time'),
            'duration' => $request->integer('duration'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(FeedingSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }

    public function toggle(FeedingSchedule $schedule)
    {
        $schedule->update(['is_active' => !$schedule->is_active]);
        return redirect()->back()->with('success', 'Status jadwal berhasil diubah');
    }
}
