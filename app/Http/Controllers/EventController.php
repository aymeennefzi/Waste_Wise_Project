<?php

namespace App\Http\Controllers;

use App\Models\Event; // Assurez-vous que le nom de votre modèle est correctement orthographié (Event avec E majuscule).
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewNotification; // Assurez-vous que vous avez bien importé l'événement de notification.

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.allEvents', ['events' => $events]);
    }

    public function index2()
    {
        $events = Event::all();
        return view('events.newEvents', ['events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'eventName' => 'required|string|max:255',
            'eventDate' => 'required|date',
            'location' => 'required|string|max:255',
            'descreption' => 'required|string',
        ]);

        // Create a new event with validated data
        $event = new Event();
        $event->eventName = $request->input('eventName');
        $event->eventDate = $request->input('eventDate');
        $event->location = $request->input('location');
        $event->descreption = $request->input('descreption');
        $event->created_at = now();
        $event->updated_at = now();
        $event->save();

        // Notify users about the new event
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'ajouté',
            'item' => 'événement',
            'name' => $event->eventName,
        ];
        event(new NewNotification($data));

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function create()
    {
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
        // Code pour afficher un événement spécifique (à implémenter si nécessaire)
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
        $request->validate([
            'eventName' => 'required|string|max:255',
            'eventDate' => 'required|date',
            'location' => 'required|string|max:255',
            'descreption' => 'required|string',
        ]);

        // Find the event by ID and update it with validated data
        $event = Event::findOrFail($id);
        $event->eventName = $request->input('eventName');
        $event->eventDate = $request->input('eventDate');
        $event->location = $request->input('location');
        $event->descreption = $request->input('descreption');
        $event->updated_at = now();
        $event->save();

        // Notify users about the updated event
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'événement',
            'name' => $event->eventName,
        ];
        event(new NewNotification($data));

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

        // Notify users about the deleted event
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'événement',
            'name' => $event->eventName,
        ];
        event(new NewNotification($data));

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
