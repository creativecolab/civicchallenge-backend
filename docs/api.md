FORMAT: 1A

# D4SD API

# Group Challenges
Microchallenges

## Display a listing of the resource. [GET /{?phase,allPhases,resources,questions,insights,insightTypes,groupInsightsByQuestion}]


+ Parameters
    + phase: (number, optional) - Get challenges from specific phase.
    + allPhases: (boolean, optional) - Get relations for each challenge from all phases.
        + Default: 0
    + resources: (boolean, optional) - Include associated resources.
        + Default: 0
    + questions: (boolean, optional) - Include associated questions.
        + Default: 0
    + insights: (boolean, optional) - Include associated insights.
        + Default: 0
    + insightTypes: (array|number, optional) - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)
        + Default: 1,2
    + groupInsightsByQuestion: (boolean, optional) - Group associated insights by questions
        + Default: 0

## Store a newly created resource in storage. [POST /]


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

## Display the specified resource. [GET /{id}{?phase,allPhases,resources,questions,insights,insightTypes,groupInsightsByQuestion}]


+ Parameters
    + id: (integer, required) - ID of Challenge
    + phase: (number, optional) - Get relations from specific phase.
    + allPhases: (boolean, optional) - Get relations from all phases.
        + Default: 0
    + resources: (boolean, optional) - Include associated resources.
        + Default: 0
    + questions: (boolean, optional) - Include associated questions.
        + Default: 0
    + insights: (boolean, optional) - Include associated insights.
        + Default: 0
    + insightTypes: (array|number, optional) - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)
        + Default: 1,2
    + groupInsightsByQuestion: (boolean, optional) - Group associated insights by questions
        + Default: 0

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

## Update the specified resource in storage. [PUT /{id}]


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

## Remove the specified resource from storage. [DELETE /{id}]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 204 (application/json)

## Get Resources belonging to Challenge [GET /{id}/resources]


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

## Store new Resource for Challenge [POST /{id}/resources]


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

## Get Questions belonging to Challenge [GET /{id}/questions/{?insights}]


+ Parameters
    + id: (integer, required) - ID of Challenge
    + insights: (boolean, optional) - Include associated insights.

+ Response 200 (application/json)

## Store new Question for Challenge [POST /{id}/questions]


+ Parameters
    + id: (integer, required) - ID of Challenge

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

## Get Insights for Challenge [GET /{id}/insights]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)
    + Body

            {
                "insights": []
            }

# Group Challenge Resources
Resources for Challenges. i.e. Student work, external resources

## Display a listing of the resource. [GET /]


## Store a newly created resource in storage. [POST /]


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

## Display the specified resource. [GET /{id}]


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

## Update the specified resource in storage. [PUT /{id}]


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

## Remove the specified resource from storage. [DELETE /{id}]


+ Parameters
    + id: (integer, required) - ID of Resource

+ Response 204 (application/json)

# Group Categories
Categories of Microchallenges

## Display a listing of the resource. [GET /{?challenges,questions,allPhases}]


+ Parameters
    + challenges: (boolean, optional) - Include challenges under each category
        + Default: false
    + questions: (boolean, optional) - Include associated questions at current phase.
        + Default: false
    + allPhases: (boolean, optional) - Get relations from all phases.
        + Default: false

## Store a newly created resource in storage. [POST /]


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

## Display the specified resource. [GET /{id}{?challenges,questions,allPhases}]


+ Parameters
    + id: (integer, required) - ID of Category
    + challenges: (boolean, optional) - Include challenges under category
        + Default: false
    + questions: (boolean, optional) - Include associated questions at current phase.
        + Default: false
    + allPhases: (boolean, optional) - Get relations from all phases.
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

## Update the specified resource in storage. [POST /{id}]


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

## Delete category. Any challenges within the category will have its category set to NULL. [DELETE /{id}]


+ Parameters
    + id: (integer, required) - ID of Category

+ Response 204 (application/json)

# Group Discussion Questions
Discussion Questions

## Display a listing of the resource. [GET /]


+ Response 200 (application/json)

## Store a newly created resource in storage. [POST /]


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

## Display the specified resource. [GET /{id}]


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

## Update the specified resource in storage. [PUT /{id}]


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

## Remove the specified resource from storage. [DELETE /{id}]


+ Parameters
    + id: (integer, required) - ID of Question

+ Response 204 (application/json)

# Group Insights
Insights i.e. Discussion, comments, prototypes, ideas

## Display a listing of the resource. [GET /{?types,challenge,phase}]


+ Parameters
    + types: (array|number, optional) - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)
    + challenge: (number, optional) - Get insights from challenge ID.
    + phase: (number, optional) - Get insights from specific phase

+ Response 200 (application/json)

## Store a newly created resource in storage. [POST /]


+ Request (application/json)
    + Body

            {
                "text": "Eos ipsa possimus nemo voluptas facilis in.",
                "user_id": 1,
                "timestamp": "1999-01-31 00:00:00",
                "thumbnail": "http://lorempixel.com/640/480/?44834",
                "type": 0,
                "question_id": 1,
                "challenge_id": 1,
                "slack_meta": {
                    "var1": "content"
                }
            }

+ Request (application/json)
    + Body

            {
                "insights": []
            }

+ Response 200 (application/json)
    + Body

            {
                "insight": {
                    "text": "Eos ipsa possimus nemo voluptas facilis in.",
                    "user_id": 1,
                    "timestamp": "1999-01-31 00:00:00",
                    "thumbnail": "http:\/\/lorempixel.com\/640\/480\/?44834",
                    "type": 0,
                    "question_id": 1,
                    "challenge_id": 1,
                    "slack_meta": "",
                    "phase": 0,
                    "updated_at": "2017-05-31 19:58:08",
                    "created_at": "2017-05-31 19:58:08",
                    "id": 1261
                }
            }

+ Response 204 (application/json)

## Display the specified resource. [GET /{id}]


+ Parameters
    + id: (integer, required) - ID of Insight

+ Response 200 (application/json)
    + Body

            {
                "insight": {
                    "text": "Eos ipsa possimus nemo voluptas facilis in.",
                    "user_id": 1,
                    "timestamp": "1999-01-31 00:00:00",
                    "thumbnail": "http:\/\/lorempixel.com\/640\/480\/?44834",
                    "type": 0,
                    "question_id": 1,
                    "challenge_id": 1,
                    "slack_meta": "",
                    "phase": 0,
                    "updated_at": "2017-05-31 19:58:08",
                    "created_at": "2017-05-31 19:58:08",
                    "id": 1261
                }
            }

## Update the specified resource in storage. [PUT /{id}]


+ Parameters
    + id: (integer, required) - ID of Insight

+ Request (application/json)
    + Body

            {
                "type": 1
            }

+ Response 200 (application/json)
    + Body

            {
                "insight": {
                    "text": "Eos ipsa possimus nemo voluptas facilis in.",
                    "user_id": 1,
                    "timestamp": "1999-01-31 00:00:00",
                    "thumbnail": "http:\/\/lorempixel.com\/640\/480\/?44834",
                    "type": 1,
                    "question_id": 1,
                    "challenge_id": 1,
                    "slack_meta": "",
                    "phase": 0,
                    "updated_at": "2017-05-31 19:58:08",
                    "created_at": "2017-05-31 19:58:08",
                    "id": 1261
                }
            }

## Remove the specified resource from storage. [DELETE /{id}]


+ Parameters
    + id: (integer, required) - ID of Insight

+ Response 204 (application/json)