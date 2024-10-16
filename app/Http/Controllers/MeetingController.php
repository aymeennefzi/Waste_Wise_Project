<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\ItemPost;



class MeetingController extends Controller
{
    // Display a listing of the meetings
    public function index()
    {
        $meetings = Meeting::all();
        return view('meetings.index', compact('meetings'));
    }

    // Show the form for creating a new meeting
    public function create($item_post_id)
    {
        // Retrieve the item post based on the provided ID
        $itemPost = ItemPost::findOrFail($item_post_id);
        
        // Pass the item post data to the view
        return view('meetings.createMeet', compact('itemPost'));
    }

    // Store a newly created meeting in storage
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'meeting_time' => 'required|date',
            'status' => 'required|string',
        ]);
    
        // Create the meeting
        Meeting::create($request->all());
    
        return redirect()->route('meetings.index')->with('success', 'Meeting scheduled successfully.');
    }
    

    // Display the specified meeting
    public function show(Meeting $meeting)
    {
        return view('meetings.show', compact('meeting'));
    }

    // Show the form for editing the specified meeting
    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    // Update the specified meeting in storage
    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'meeting_time' => 'required|date',
            'status' => 'required|string',
        ]);

        $meeting->update($request->all());
        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }

    // Remove the specified meeting from storage
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully.');
    }
}
