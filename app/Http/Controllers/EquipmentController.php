<?php

namespace App\Http\Controllers;

use App\Checkin;
use App\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment = Equipment::all();
        if (count($equipment) < 1) {
            return view('equipment.index', compact('equipment'));
        }
        $eq = $equipment->map(function ($item, $key) {
            return $item->id;
        });
        // Get today's range
        $now = new Carbon('now');
        $start = clone $now->hour(0)->minute(0)->second(0);
        $end = clone $now->hour(23)->minute(59)->second(59);

        $user = \Auth::id();
        $checkins = Checkin::whereIn('equipment_id', $eq)
            ->where('user_id', $user)
            ->whereBetween('checkin', [$start, $end])
            ->whereNull('checkout')
            ->get();
        foreach ($checkins as $ch) {
            $equipment->where('id', $ch->equipment_id)->first()->checked_in = true;
            $equipment->where('id', $ch->equipment_id)->first()->checkin = $ch->checkin;
        }

        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'calories_pm']);
        Equipment::create($data);
        return redirect()->route('equipment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check in on equipment
     *
     * @param int $id The equipment you want to check in on
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function checkin($id)
    {
        // FindOrFail because we don't want anyone checking in on nonexistant equipment
        $equipment = Equipment::findOrFail($id);
        $user = \Auth::id();

        // Get today's range
        $now = new Carbon('now');
        $start = clone $now->hour(0)->minute(0)->second(0);
        $end = clone $now->hour(23)->minute(59)->second(59);

        // Not checked out, checked in, and checkin was today
        $checkins = Checkin::where('user_id', $user)
            ->whereNotNull('checkin')
            ->whereNull('checkout')
            ->whereBetween('checkin', [$start, $end])->get();

        // Double checkin? No sir
        if ($checkins->count() > 0) {
            return "Error: You're already checked in.";
        }

        // All is well, write checkin to database
        Checkin::create([
            'id' => 1,
            'equipment_id' => $id,
            'user_id' => $user,
            'checkin' => new \DateTime
        ]);
        return redirect()->back();
    }

    /**
     * @param int $id The equipment you want to check out on
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function checkout($id)
    {
        // FindOrFail because we don't want anyone checking out on nonexistant equipment
        $equipment = Equipment::findOrFail($id);
        $user = \Auth::id();

        // Get today's range
        $now = new Carbon('now');
        $start = clone $now->hour(0)->minute(0)->second(0);
        $end = clone $now->hour(23)->minute(59)->second(59);

        // Not checked out, checked in, and checkin was today
        $checkin = Checkin::where('user_id', $user)
            ->where('equipment_id', $id)
            ->whereNotNull('checkin')
            ->whereNull('checkout')
            ->whereBetween('checkin', [$start, $end])->first();

        // No checkin? No dice.
        if ($checkin === null) {
            return "Error: You're not checked in.";
        }

        // All is well, write checkout to database
        $checkin->update([
            'checkout' => new \DateTime
        ]);
        return redirect()->back(); // "You have been checked out";
    }

//    public function ()
//    {
//
//    }
}
