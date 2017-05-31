FORMAT: 1A

# D4SD API

# Challenges [/challenges]
Microchallenges

## Display a listing of the resource. [GET /challenges{?resources,questions}]


+ Parameters
    + resources: (boolean, optional) - Include associated resources.
        + Default: false
    + questions: (boolean, optional) - Include associated questions.
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

## Display the specified resource. [GET /challenges/{id}{?resources,questions}]


+ Parameters
    + id: (integer, required) - ID of Challenge
    + resources: (boolean, optional) - Include associated resources.
        + Default: false
    + questions: (boolean, optional) - Include associated questions.
        + Default: false

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

## Get Questions belonging to Challenge [GET /challenges/{id}/questions]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)

## Store new Question for Challenge [POST /challenges/{id}/questions]


+ Request (application/json)
    + Body

            {
                "text": "What?"
            }

+ Response 200 (application/json)
    + Body

            {
                "question": {
                    "id": 1,
                    "text": "What?",
                    "challenge_id": 1,
                    "phase": 1,
                    "created_at": "2017-05-31 17:00:27",
                    "updated_at": "2017-05-31 17:18:28"
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

# Categories [/categories]
Categories of Microchallenges

## Display a listing of the resource. [GET /categories{?challenges}]


+ Parameters
    + challenges: (boolean, optional) - Include challenges under each category
        + Default: false

## Store a newly created resource in storage. [POST /categories]


+ Request (application/json)
    + Body

            {
                "name": "Name",
                "description": "Category description"
            }

+ Response 200 (application/json)
    + Body

            {
                "category": {
                    "id": 1,
                    "name": "Name",
                    "description": "Category description",
                    "created_at": "2017-05-31 07:35:50",
                    "updated_at": "2017-05-31 07:35:50"
                }
            }

## Display the specified resource. [GET /categories/{id}{?challenges}]


+ Parameters
    + id: (integer, required) - ID of Category
    + challenges: (boolean, optional) - Include challenges under category
        + Default: false

+ Response 200 (application/json)
    + Body

            {
                "category": {
                    "id": 1,
                    "name": "Explicabo doloribus distinctio nulla.",
                    "description": "Quas ad officia alias asperiores laborum hic aut ex.",
                    "created_at": "2017-05-31 07:35:50",
                    "updated_at": "2017-05-31 07:35:50"
                }
            }

## Update the specified resource in storage. [POST /categories/{id}]


+ Parameters
    + id: (integer, required) - ID of Category

+ Request (application/json)
    + Body

            {
                "name": "Name"
            }

+ Response 200 (application/json)
    + Body

            {
                "category": {
                    "id": 1,
                    "name": "Name",
                    "description": "Quas ad officia alias asperiores laborum hic aut ex.",
                    "created_at": "2017-05-31 07:35:50",
                    "updated_at": "2017-05-31 07:35:50"
                }
            }

## Delete category. Any challenges within the category will have its category set to NULL. [DELETE /categories/{id}]


+ Parameters
    + id: (integer, required) - ID of Category

+ Response 204 (application/json)

# Discussion Questions [/questions]
Discussion Questions

## Display a listing of the resource. [GET /questions]


+ Response 200 (application/json)

## Store a newly created resource in storage. [POST /questions]


+ Request (application/json)
    + Body

            {
                "text": "What?",
                "challenge_id": 1
            }

+ Response 200 (application/json)
    + Body

            {
                "question": {
                    "id": 1,
                    "text": "What?",
                    "challenge_id": 1,
                    "phase": 1,
                    "created_at": "2017-05-31 17:00:27",
                    "updated_at": "2017-05-31 17:18:28"
                }
            }

## Display the specified resource. [GET /questions/{id}]


+ Parameters
    + id: (integer, required) - ID of Question

+ Response 200 (application/json)
    + Body

            {
                "question": {
                    "id": 1,
                    "text": "What?",
                    "challenge_id": 1,
                    "phase": 1,
                    "created_at": "2017-05-31 17:00:27",
                    "updated_at": "2017-05-31 17:18:28"
                }
            }

## Update the specified resource in storage. [PUT /questions/{id}]


+ Parameters
    + id: (integer, required) - ID of Question

+ Request (application/json)
    + Body

            {
                "text": "What?"
            }

+ Response 200 (application/json)
    + Body

            {
                "question": {
                    "id": 1,
                    "text": "What?",
                    "challenge_id": 1,
                    "phase": 1,
                    "created_at": "2017-05-31 17:00:27",
                    "updated_at": "2017-05-31 17:18:28"
                }
            }

## Remove the specified resource from storage. [DELETE /questions/{id}]


+ Parameters
    + id: (integer, required) - ID of Question

+ Response 204 (application/json)