<?php

namespace Modules\Schedule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Schedule\Http\Requests\FindAvailableCourtRequest;
use Modules\Schedule\Models\CourtSchedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FindAvailableCourtRequest $request)
    {
        $available = CourtSchedule::findAvailableSchedules($request->query('membership_type'), $request->query('date'));


        return Inertia::render('Module/Schedule/Index', [
            'title' => 'Schedule',
            'available' => $available,
        ]);
    }

    public function booking(Request $request)
    {
        $validated = $request->validate([
            'membership_type' => 'nullable|in:incidental,membership',
            'date'            => 'nullable|date_format:Y-m-d',
        ]);



        $membershipType = $validated['membership_type'] ?? null;
        $date           = $validated['date'] ?? null;

        $available = collect();
        if ($membershipType && $date) {
            CourtSchedule::ensureForDate($request->query('date'), User::superAdmin()->id);

            $available = CourtSchedule::findAvailableByTypeAndDate($membershipType, $date);
        }

        return Inertia::render('Module/Schedule/Booking', [
            'title'     => 'Booking',
            'available' => $available,
            'filters'   => compact('membershipType', 'date'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedule::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('schedule::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('schedule::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
