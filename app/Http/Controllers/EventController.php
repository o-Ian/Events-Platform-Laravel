<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();

        return view('home/index', ['events' => $events]);
    }

    public function show($id = false)
    {
        return view('products/show', ['id' => $id]);
    }

    public function create()
    {
        return view('events/create/index');
    }
}
