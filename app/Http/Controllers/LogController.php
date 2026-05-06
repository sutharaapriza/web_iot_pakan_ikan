<?php

namespace App\Http\Controllers;

use App\Models\FeedingLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = FeedingLog::orderBy('executed_at', 'desc');

        if ($request->filled('start_date')) {
            $query->whereDate('executed_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('executed_at', '<=', $request->end_date);
        }

        $logs = $query->paginate(15);

        return view('logs.index', compact('logs'));
    }
}
