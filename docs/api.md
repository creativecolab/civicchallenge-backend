FORMAT: 1A

# D4SD API

# Challenges [/challenges]
Microchallenges

## Display a listing of the resource. [GET /challenges{?resources}]


+ Parameters
    + resources: (boolean, optional) - Include associated resources.
        + Default: false

## Store a newly created resource in storage. [POST /challenges]


+ Request (application/json)
    + Body

            {
                "name": "Name",
                "summary": "This is a challenge.",
                "description": "Challenge description"
            }

## Display the specified resource. [GET /challenges/{id}]


## Update the specified resource in storage. [PUT /challenges/{id}]


+ Request (application/json)
    + Body

            {
                "name": "Name",
                "summary": "This is a challenge.",
                "description": "Challenge description"
            }

## Remove the specified resource from storage. [DELETE /challenges/{id}]


## Get resources belonging to Challenge [GET /challenges/{id}/resources]


+ Parameters
    + id: (integer, required) - ID of Challenge

## Store new Resource for Challenge [POST /challenges/{id}/resources]


+ Parameters
    + id: (integer, required) - ID of Challenge

# Resources [/resources]
Resources for Challenges

## Display a listing of the resource. [GET /resources]


## Store a newly created resource in storage. [POST /resources]


## Display the specified resource. [GET /resources/{id}]


## Update the specified resource in storage. [PUT /resources/{id}]


## Remove the specified resource from storage. [DELETE /resources/{id}]