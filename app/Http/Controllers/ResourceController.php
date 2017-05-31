<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Resource;
use Illuminate\Http\Request;

/**
 * Resources for Challenges
 * @package App\Http\Controllers
 * @resource("Resources", uri="/resources")
 */
class ResourceController extends Controller
{
	use CreatesResources;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     * @get("/")
     */
    public function index()
    {
        return Resource::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Resource
     *
     * @post("/")
     */
    public function store(Request $request)
    {
	    $challenge = Challenge::findOrFail($request->get('challenge_id'));
	    return $this->createResource($request, $challenge);
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $resource
     *
     * @return Resource
     *
     * @get("/{id}")
     */
    public function show(Resource $resource)
    {
        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Resource  $resource
     *
     * @return Resource
     *
     * @put("/{id}")
     * @patch("/{id}")
     */
    public function update(Request $request, Resource $resource)
    {
	    if (!$resource->update($request->all())) {
		    $this->response->errorInternal();
	    }

	    return $resource;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     *
     * @delete("/{id}")
     */
    public function destroy(Resource $resource)
    {
	    if (!$resource->delete()) {
		    $this->response->errorInternal();
	    }

	    return $this->response->noContent();
    }
}
