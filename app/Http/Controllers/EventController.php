<?php

namespace App\Http\Controllers;

use App\Event;

/**
 * Events
 * @package App\Http\Controllers
 * @resource("Group Events")
 */
class EventController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/")
	 * @response(200, body={"events":{{"id":1,"name":"Name","date":"2018-12-03 11:33:37","description": "Desc."},{"id":2,"name":"Name","date":"2018-12-03 11:33:37","description": "Desc."}}})
	 */
	public function index() {
		return Event::all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Event $event
	 *
	 * @return Event
	 *
	 * @get("/{id}")
	 * @response(200, body={"event":{"id":1,"name”:”Event Name”,”date":"2018-12-03 11:33:37","description”:”Description,”created_at":"2017-06-13 16:35:34","updated_at":"2017-06-13 16:35:34"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Challenge", required=true, type="integer")
	 * })
	 */
	public function show( Event $event ) {
		return $event;
	}
}
