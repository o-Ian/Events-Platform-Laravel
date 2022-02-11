<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();

        return view('home/index', ['events' => $events]);
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
        $content = Event::create($data);

        return redirect()->route('site.create')->with('msg', 'Evento criado com sucesso!');
    }

    public function show(Event $event)
    {
        return view('events/show/index', ['event' => $event]);
    }
}
