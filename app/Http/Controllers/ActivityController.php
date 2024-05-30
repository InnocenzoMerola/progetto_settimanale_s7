<?php

namespace App\Http\Controllers;
use App\Models\Course;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $activities = Activity::all();

        // return view('activities.index', [
        //     'activities' => $activities,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->all();

        // $newActivity = new Activity();
        // // $newActivity->location = $data['location'];
        // $newActivity->name = $data['name'];
        // $newActivity->description = $data['description'];
        // $newActivity->slot->day = $data['day'];
        // // $newActivity->slot->start = $data['start'];
        // // $newActivity->slot->end = $data['end'];
        // $newActivity->save();

        // return redirect()->route('courses.index', ['id'=>$newActivity->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
