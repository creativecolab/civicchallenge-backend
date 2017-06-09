<?php

namespace App\Http\Controllers;


class EventController extends Controller
{
    public function show( Event $event ) {
        return $event;
    }
}