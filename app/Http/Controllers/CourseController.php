<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Activity;
use App\Models\Slot;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('activity', 'slot', 'users')->get();

        return view('courses.index', [
            'courses' => $courses,
        ]);
        
    }

    public function prenota($id, $user_id){
        $course = Course::findOrFail($id);
        $user = User::find(Auth::id());
        // $user->courses()->attach($id, ['status' => 'pending']); //TODO:
        $user->courses()->attach($user_id, ['status' => 'pending']);

        return redirect()->route('courses.index');
    }

    public function annulla($id, $user_id){
        $course = Course::findOrFail($id);
       $course->users()->detach($user_id);
        return redirect()->route('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'location' => 'required|string|max:100',
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'day' => 'required|string',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i'
        ]);


        $newActivity = new Activity();
        $newActivity->name = $data['name'];
        $newActivity->description = $data['description'];
        $newActivity->save();


        $newSlot = new Slot();
        $newSlot->day = $data['day'];
        $newSlot->start = $data['start'];
        $newSlot->end = $data['end'];
        $newSlot->save();

        $newCourse = new Course();
        $newCourse->location = $data['location'];
        $newCourse->activity_id = $newActivity->id;
        $newCourse->slot_id = $newSlot->id;
        $newCourse->save();

        $newCourse->users()->attach(Auth::id(), ['status' => 'pending']);

        return redirect()->route('courses.index', ['id'=>$newCourse->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        if($request->user()->id !== $course->user_id) abort('401');

        return redirect()->route('courses.index');
    }

    

    


    public function accepted($id, $user_id){
        $course = Course::findOrFail($id);
        $course->users()->updateExistingPivot($user_id, ['status' => 'accepted']); //TODO:
        return redirect()->route('courses.index');
    }

    public function rejected($id, $user_id){
        $course = Course::findOrFail($id);
        $course->users()->updateExistingPivot($user_id, ['status' => 'rejected']); //TODO:
        return redirect()->route('courses.index');;
    }
}
