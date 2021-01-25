<?php

namespace App\Http\Controllers;

use App\EventTypes;
use App\Languages;
use App\Page;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Event)->first();
        $eventTypes = EventTypes::all();
        $languages = Languages::all();

        return view('event.index', compact('page', 'eventTypes', 'languages'));
    }
}
