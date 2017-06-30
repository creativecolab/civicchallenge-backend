<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\Api\GetChannelRequest;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

/**
 * Class ChannelController
 * @package App\Http\Controllers
 * @resource("Slack Channels", uri="/channels")
 */
class ChannelController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @param GetChannelRequest $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @get("/{?condition,include}")
	 * @parameters({
	 *     @parameter("condition", description="Condition ID", type="integer"),
	 *     @parameter("include", type="string", description="Relations to include", members={
	 *          @member(value="challenge"),
	 *          @member(value="questions"),
	 *     }),
	 * })
	 */
    public function index(GetChannelRequest $request)
    {
    	if ($request->has('condition')) {
    	    return Channel::where('condition', '=', $request->get('condition'))->get();
	    }

        return Channel::all();
    }

	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 *
	 * @return Channel
	 * @internal param Channel $channel
	 *
	 * @get("/{id}{?include}")
	 * @parameters({
	 *     @parameter("id", description="ID of Channel", required=true, type="integer"),
	 *     @parameter("include", type="string", description="Relations to include", members={
	 *          @member(value="challenge"),
	 *          @member(value="questions"),
	 *     }),
	 * })
	 */
    public function show($id)
    {
	    return Channel::findWithFallback( $id );
    }
}
