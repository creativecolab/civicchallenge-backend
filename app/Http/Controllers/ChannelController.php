<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

/**
 * Class ChannelController
 * @package App\Http\Controllers
 * @resource("Slack Channels", uri="/channels")
 */
class ChannelController extends Controller
{
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
     * @param  \App\Channel  $channel
     *
     * @return Channel
     *
     * @get("/{id}{?include}")
     * @parameters({
     *     @parameter("id", description="ID of Channel", required=true, type="integer"),
     *     @parameter("include", type="string", description="Relations to include", members={
     *          @member(value="challenge"),
     *     }),
     * })
     */
    public function show(Channel $channel)
    {
        return $channel;
    }
}
