<?php

namespace App\Http\Controllers;

use App\Channel;
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     * @get("/{?include}")
     * @parameters({
     *     @parameter("id", description="ID of Channel", required=true, type="integer"),
     *     @parameter("include", type="string", description="Relations to include", members={
     *          @member(value="challenge"),
     *          @member(value="questions"),
     *     }),
     * })
     */
    public function index()
    {
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
