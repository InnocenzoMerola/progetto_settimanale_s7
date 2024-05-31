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
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('activity', 'slot', 'users')->paginate(5);
        return view('courses.index', [
            'courses' => $courses,
        ]);
        
    }

    public function prenota($id, $user_id){
        $course = Course::findOrFail($id);
        $user = User::find(Auth::id());
        $user->courses()->attach($id, ['status' => 'pending']); //TODO:
        // $user->courses()->attach($user_id, ['status' => 'pending']);

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

        // $newCourse->users()->attach(Auth::id(), ['status' => 'pending']);

        return redirect()->route('courses.index', ['id'=>$newCourse->id])->with('created_success', $newCourse);
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
    public function edit(Course $course, $id)
    {
        $course = Course::with('activity', 'slot')->findOrFail($id);

        return view('courses.edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $course = Course::findOrFail($id);
        $activity = Activity::findOrFail($course->activity_id);
        $slot = Slot::findOrFail($course->slot_id);

        $activity->name = $data['name'];
        $activity->description = $data['description'];
        $slot->day = $data['day'];
        $slot->start = $data['start'];
        $slot->end = $data['end'];
        $course->location = $data['location'];
        
        $activity->save();
        $slot->save();
        $course->save();

        return redirect()->route('courses.index', ['id'=>$course->id])->with('created_success', $course);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $course = Course::findOrFail($id);
    
        $course->delete();

        $activity = Activity::findOrFail($course->activity_id);
        if($activity){
            $activity->delete();
        }
        $slot = Slot::findOrFail($course->slot_id);
        if($slot){
            $slot->delete();
        }

        return redirect()->route('courses.index')->with('deleted_success', $course);;
    }

    


    public function accepted($id, $user_id){
        $course = Course::findOrFail($id);
        $course->users()->updateExistingPivot($user_id, ['status' => 'accepted']);
        return redirect()->route('dashboard');
    }

    public function rejected($id, $user_id){
        $course = Course::findOrFail($id);
        $course->users()->updateExistingPivot($user_id, ['status' => 'rejected']);
        return redirect()->route('dashboard');;
    }


    public function dashboardControl(){

        // $course = Course::findOrFail($id);
        if(auth()->user()->role === 'admin'){
            $courses = Course::with('activity', 'slot', 'users')->paginate(5);
        }elseif(auth()->user()->role === 'user'){

            $user = User::find(Auth::id());
            $courses = $user->courses()->with('activity', 'slot')->paginate(5);
        }
        
        return view('dashboard', [
            'courses' => $courses,
        ]);
    }
}
