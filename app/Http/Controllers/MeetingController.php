<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\ItemPost;
use Illuminate\Support\Facades\Auth;



class MeetingController extends Controller
{
    // Display a listing of the meetings
    public function index()
    {
        $userId = Auth::id();
        $meetings = Meeting::where('buyer_id', $userId)
                           ->orWhere('owner_id', $userId)
                           ->get();
    
        return view('meetings.index', compact('meetings'));
    }




//     public function accept($meetingId)
// {
//     $meeting = Meeting::findOrFail($meetingId);

//     // Check if the current user is the owner of the meeting
//     if ($meeting->owner_id == Auth::id() && $meeting->status == 1) {
//         $meeting->status = 2; // Accepted
//         $meeting->save();

//         return redirect()->route('meetings.index')->with('success', 'Meeting accepted successfully.');
//     }

//     return redirect()->route('meetings.index')->with('error', 'You are not authorized to accept this meeting.');
// }


public function accept($meetingId)
{
    // Find the meeting by its ID
    $meeting = Meeting::findOrFail($meetingId);

    // Change the status of the accepted meeting to 2
    $meeting->status = 2;
    $meeting->save();

    // Change the status of the related ItemPost to 2
    $itemPost = ItemPost::findOrFail($meeting->item_post_id);
    $itemPost->status = 2;
    $itemPost->save();

    // Automatically set the status of all other meetings of this ItemPost to 3 (refused)
    Meeting::where('item_post_id', $meeting->item_post_id)
           ->where('id', '!=', $meetingId)
           ->update(['status' => 3]);

    return redirect()->back()->with('success', 'Meeting accepted and item status updated.');
}









public function refuse($meetingId)
{
    $meeting = Meeting::findOrFail($meetingId);

    // Check if the current user is the owner of the meeting
    if ($meeting->owner_id == Auth::id() && $meeting->status == 1) {
        $meeting->status = 3; // Refused
        $meeting->save();

        // Return a JSON response to trigger a page refresh
        return redirect()->back()->with('success', 'Meeting refused and item status updated.');
    }

    return redirect()->back()->with('success', 'Meeting refused and item status updated.');
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
        // Extract the item_post_id from the request (URL parameter)
        $itemPostId = $request->input('item_post_id');
    
        // Find the ItemPost using the provided item_post_id
        $itemPost = ItemPost::findOrFail($itemPostId);
        
        $request->validate([
            'meeting_time' => 'required|date',
        ]);
    
        // Create the meeting with the appropriate data
        Meeting::create([
            'owner_id' => $itemPost->user_id, // User who owns the post
            'buyer_id' => Auth::id(), // Current authenticated user
            'item_post_id' => $itemPost->id, // Item post ID from the URL
            'meeting_time' => $request->meeting_time,
            'status' => 1,
        ]);
    
        return redirect()->route('meetings.index')->with('success', 'Meeting scheduled successfully.');
    }
    
    

    public function show($item_post_id)
    {
        // Retrieve all meetings for the given item_post_id
        $meeting = Meeting::with('itemPost')->where('item_post_id', $item_post_id)->get();
    
        // Check if there is at least one meeting with status 2 (Accepted) for this item_post_id
        $isAccepted = $meeting->contains('status', 2);
    
        return view('meetings.show', compact('meeting', 'isAccepted'));
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
