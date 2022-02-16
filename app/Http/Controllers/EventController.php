<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%'],
            ])->get();
        } else {
            $events = Event::get();
        }

        return view('home/index', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events/create/index');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }
        $data['user_id'] = auth()->user()->id;

        $content = Event::create($data);

        return redirect()->route('site.create')->with('msg', 'Evento criado com sucesso!');
    }

    public function show(Event $event)
    {
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        $user = auth()->user();
        $hasUserJoined = false;

        if ($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if ($userEvent['id'] == $event->id) {
                    $hasUserJoined = true;
                }
            }
        }

        return view('events/show/index', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('site.dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit(Event $event)
    {
        $user = auth()->user();

        if ($user->id != $event->user_id) {
            return redirect()->route('site.dashboard');
        }

        return view('events/edit/index', ['event' => $event]);
    }

    public function update(Event $event, Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        $event->update($data);

        return redirect()->route('site.dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent(Event $event)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($event);

        return back()->with('msg', 'Sua presença está confirmada no evento '.$event->title);
    }

    public function leaveEvent(Event $event)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($event);

        return back()->with('msg', 'Você saiu com sucesso do evento '.$event->title);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('dashboard/index', ['user' => $user, 'eventsAsParticipant' => $eventsAsParticipant]);
    }
}
