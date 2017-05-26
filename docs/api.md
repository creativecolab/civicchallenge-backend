FORMAT: 1A

# D4SD API

# Challenges [/challenges]
Microchallenges

## Display a listing of the resource. [GET /challenges]


## Store a newly created resource in storage. [POST /challenges]


+ Request (application/json)
    + Body

            {
                "name": "Name",
                "summary": "This is a challenge."
            }

## Display the specified resource. [GET /challenges/{id}]


## Update the specified resource in storage. [PUT /challenges/{id}]


+ Request (application/json)
    + Body

            {
                "name": "Name",
                "summary": "This is a challenge."
            }

## Remove the specified resource from storage. [DELETE /challenges/{id}]