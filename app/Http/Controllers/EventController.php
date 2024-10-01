<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = event::all();
        return view('events.allEvents', ['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'eventName' => 'required|string|max:255',
        //     'eventDate' => 'required|date',
        //     'location' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'communityId' => 'required|integer',
        // ]);

        print($request);
        $event = new event();
        $event->eventName = $request->input('eventName');
        $event->eventDate = $request->input('eventDate');
        $event->location = $request->input('location');
        $event->descreption = $request->input('descreption');
        $event->communityId = $request->input('communityId');
        $event->createdAt = now();
        $event->updatedAt = now();
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }


    public function create(){
        return view('events.addEvents');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        // $request->validate([
        //     'eventName' => 'required|string|max:255',
        //     'eventDate' => 'required|date',
        //     'location' => 'required|string',
        //     'description' => 'required|string',
        //     'communityId' => 'required|integer',
        // ]);

        // Find the event by ID
        $event = Event::findOrFail($id);

        // Update the event with the request data
        $event->eventName = $request->input('eventName');
        $event->eventDate = $request->input('eventDate');
        $event->location = $request->input('location');
        $event->descreption = $request->input('descreption');
        $event->communityId = $request->input('communityId');

        // Save the updated event
        $event->save();

        // Redirect to the events index with a success message
        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }


    public function edit(Event $event)
    {
        return view('events.updateEvent', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
