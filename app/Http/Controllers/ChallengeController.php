<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

/**
 * Microchallenges
 * @package App\Http\Controllers
 * @resource("Challenges", uri="/challenges")
 */
class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     * @get("/")
     */
    public function index()
    {
        return Challenge::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @post("/")
     * @request({"name": "Name", "summary": "This is a challenge.", "description": "Challenge description"})
     */
    public function store(Request $request)
    {
        return Challenge::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return Challenge|\Illuminate\Http\Response
     *
	 * @get("/{id}")
     */
    public function show(Challenge $challenge)
    {
        return $challenge;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Challenge $challenge
	 * @return Challenge
	 *
	 * @put("/{id}")
	 * @patch("/{id}")
	 * @request({"name": "Name", "summary": "This is a challenge.", "description": "Challenge description"})
	 */
    public function update(Request $request, Challenge $challenge)
    {
        if (!$challenge->update($request->all())) {
	        $this->response->errorInternal();
        }

        return $challenge;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     *
     * @delete("/{id}")
     */
    public function destroy(Challenge $challenge)
    {
        if (!$challenge->delete()) {
        	$this->response->errorInternal();
        }

	    return $this->response->noContent();
    }
}
