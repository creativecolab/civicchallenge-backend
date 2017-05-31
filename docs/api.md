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

+ Response 200 (application/json)
    + Body

            {
                "challenge": {
                    "id": 1,
                    "name": "Consequatur voluptatem atque blanditiis.",
                    "summary": "In vel eaque ut reprehenderit voluptates.",
                    "thumbnail": "http://thumbnail.com/img.jpg",
                    "phase": 2,
                    "created_at": "2017-05-31 05:06:00",
                    "updated_at": "2017-05-31 05:06:00"
                }
            }

## Display the specified resource. [GET /challenges/{id}]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)
    + Body

            {
                "challenge": {
                    "id": 1,
                    "name": "Consequatur voluptatem atque blanditiis.",
                    "summary": "In vel eaque ut reprehenderit voluptates.",
                    "thumbnail": "http://thumbnail.com/img.jpg",
                    "phase": 2,
                    "created_at": "2017-05-31 05:06:00",
                    "updated_at": "2017-05-31 05:06:00"
                }
            }

## Update the specified resource in storage. [PUT /challenges/{id}]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Request (application/json)
    + Body

            {
                "name": "Name",
                "summary": "This is a challenge.",
                "description": "Challenge description"
            }

+ Response 200 (application/json)
    + Body

            {
                "challenge": {
                    "id": 1,
                    "name": "Consequatur voluptatem atque blanditiis.",
                    "summary": "In vel eaque ut reprehenderit voluptates.",
                    "thumbnail": "http://thumbnail.com/img.jpg",
                    "phase": 2,
                    "created_at": "2017-05-31 05:06:00",
                    "updated_at": "2017-05-31 05:06:00"
                }
            }

## Remove the specified resource from storage. [DELETE /challenges/{id}]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 204 (application/json)

## Get Resources belonging to Challenge [GET /challenges/{id}/resources]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)
    + Body

            {
                "resource": {
                    "name": "Test",
                    "url": "http:\/\/test.com",
                    "description": "Test description",
                    "type": "PDF",
                    "phase": 2,
                    "challenge_id": 1,
                    "updated_at": "2017-05-31 06:33:25",
                    "created_at": "2017-05-31 06:33:25",
                    "id": 23
                }
            }

## Store new Resource for Challenge [POST /challenges/{id}/resources]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Request (application/json)
    + Body

            {
                "name": "Test",
                "url": "http://test.com",
                "description": "Test description",
                "type": "PDF"
            }

+ Response 200 (application/json)
    + Body

            {
                "resource": {
                    "name": "Test",
                    "url": "http:\/\/test.com",
                    "description": "Test description",
                    "type": "PDF",
                    "phase": 2,
                    "challenge_id": 1,
                    "updated_at": "2017-05-31 06:33:25",
                    "created_at": "2017-05-31 06:33:25",
                    "id": 23
                }
            }

# Resources [/resources]
Resources for Challenges. i.e. Student work, external resources

## Display a listing of the resource. [GET /resources]


## Store a newly created resource in storage. [POST /resources]


+ Request (application/json)
    + Body

            {
                "name": "Test",
                "url": "http://test.com",
                "description": "Test description",
                "type": "PDF",
                "challenge_id": 1
            }

+ Response 200 (application/json)
    + Body

            {
                "resource": {
                    "name": "Test",
                    "url": "http:\/\/test.com",
                    "description": "Test description",
                    "type": "PDF",
                    "phase": 2,
                    "challenge_id": 1,
                    "updated_at": "2017-05-31 06:33:25",
                    "created_at": "2017-05-31 06:33:25",
                    "id": 23
                }
            }

## Display the specified resource. [GET /resources/{id}]


+ Parameters
    + id: (integer, required) - ID of Resource

+ Response 200 (application/json)
    + Body

            {
                "resource": {
                    "name": "Test",
                    "url": "http:\/\/test.com",
                    "description": "Test description",
                    "type": "PDF",
                    "phase": 2,
                    "challenge_id": 1,
                    "updated_at": "2017-05-31 06:33:25",
                    "created_at": "2017-05-31 06:33:25",
                    "id": 23
                }
            }

## Update the specified resource in storage. [PUT /resources/{id}]


+ Parameters
    + id: (integer, required) - ID of Resource

+ Request (application/json)
    + Body

            {
                "name": "Test",
                "url": "http://test.com",
                "description": "Test description",
                "type": "PDF",
                "challenge_id": 1
            }

+ Response 200 (application/json)
    + Body

            {
                "resource": {
                    "name": "Test",
                    "url": "http:\/\/test.com",
                    "description": "Test description",
                    "type": "PDF",
                    "phase": 2,
                    "challenge_id": 1,
                    "updated_at": "2017-05-31 06:33:25",
                    "created_at": "2017-05-31 06:33:25",
                    "id": 23
                }
            }

## Remove the specified resource from storage. [DELETE /resources/{id}]


+ Parameters
    + id: (integer, required) - ID of Resource

+ Response 204 (application/json)