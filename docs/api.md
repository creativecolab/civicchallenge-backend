FORMAT: 1A

# D4SD API

# Challenges [/challenges]
Microchallenges

## Display a listing of the resource. [GET /challenges{?phase,allPhases,resources,questions,insights,insightTypes,groupInsightsByQuestion,include}]


+ Parameters
    + phase: (number, optional) - Get challenges from specific phase.
    + allPhases: (boolean, optional) - Get relations for each challenge from all phases.
        + Default: 0
    + include: (enum[string], optional) - Relations to include
        + Members
            + `category` - 
            + `resources` - 
            + `questions` - 
            + `insights{?:type()}` - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT). Default is 1 and 2

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

## Display the specified resource. [GET /challenges/{id}{?phase,allPhases,include}]


+ Parameters
    + id: (integer, required) - ID of Challenge
    + phase: (number, optional) - Get relations from specific phase.
    + allPhases: (boolean, optional) - Get relations from all phases.
        + Default: 0
    + include: (enum[string], optional) - Relations to include
        + Members
            + `category` - 
            + `resources` - 
            + `questions` - 
            + `insights{?:type()}` - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT). Default is 1 and 2.

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

## Get Questions belonging to Challenge [GET /challenges/{id}/questions/{?insights}]


+ Parameters
    + id: (integer, required) - ID of Challenge
    + insights: (boolean, optional) - Include associated insights.

+ Response 200 (application/json)

## Store new Question for Challenge [POST /challenges/{id}/questions]


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

## Get Insights for Challenge [GET /challenges/{id}/insights]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)
    + Body

            {
                "insights": []
            }

# Challenge Resources [/resources]
Resources for Challenges. i.e. Student work, external resources

## Display a listing of the resource. [GET /resources{?include}]


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

## Display the specified resource. [GET /resources/{id}{?include}]


+ Parameters
    + id: (integer, required) - ID of Resource
    + include: (enum[enum[string]], optional) - Relations to include
        + Members
            + `challenge` - 

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

## List categories. [GET /categories{?include}]
Option to include challenges as well as resources. Resources default to current phase only.

+ Parameters
    + include: (enum[string], optional) - Relations to include
        + Members
            + `challenges` - 
            + `challenges.questions{?:allPhases(true)}` - Get relations from all phases (default is current phase only)

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

## Get Category by ID. [GET /categories/{id}{?challenges,questions,allPhases,include}]
Option to include challenges as well as resources. Resources default to current phase only.

+ Parameters
    + id: (integer, required) - ID of Category
    + include: (enum[string], optional) - Relations to include
        + Members
            + `challenges` - 
            + `challenges.questions` - Get relations from all phases (default is current phase only)

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

## Display a listing of the resource. [GET /questions{?challenge,phase,include}]


+ Parameters
    + challenge: (number, optional) - Get insights from challenge ID.
    + phase: (number, optional) - Get insights from specific phase
    + include: (enum[enum[string]], optional) - Relations to include
        + Members
            + `insights` - 
            + `challenge` - 

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

## Display the specified resource. [GET /questions/{id}{?include}]


+ Parameters
    + id: (integer, required) - ID of Question
    + include: (enum[enum[string]], optional) - Relations to include
        + Members
            + `insights` - 
            + `challenge` - 

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

# Insights [/insights]
Insights i.e. Discussion, comments, prototypes, ideas

## Display a listing of the resource. [GET /insights{?types,challenge,phase,include}]


+ Parameters
    + types: (array|number, optional) - Filter by type (0 = NORMAL, 1 = CURATED, 2 = HIGHLIGHT)
    + challenge: (number, optional) - Get insights from challenge ID.
    + phase: (number, optional) - Get insights from specific phase
    + include: (enum[enum[string]], optional) - Relations to include
        + Members
            + `user` - 
            + `question` - 
            + `challenge` - 

+ Response 200 (application/json)

## Store a newly created resource in storage. [POST /insights]


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

## Display the specified resource. [GET /insights/{id}{?include}]


+ Parameters
    + id: (integer, required) - ID of Insight
    + include: (enum[enum[string]], optional) - Relations to include
        + Members
            + `user` - 
            + `question` - 
            + `challenge` - 

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

## Update the specified resource in storage. [PUT /insights/{id}]


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

## Remove the specified resource from storage. [DELETE /insights/{id}]


+ Parameters
    + id: (integer, required) - ID of Insight

+ Response 204 (application/json)

# Events [/events]
Events

## Display a listing of the resource. [GET /events]


+ Response 200 (application/json)
    + Body

            {
                "events": [
                    {
                        "id": 1,
                        "name": "Name",
                        "date": "2018-12-03 11:33:37",
                        "description": "Desc."
                    },
                    {
                        "id": 2,
                        "name": "Name",
                        "date": "2018-12-03 11:33:37",
                        "description": "Desc."
                    }
                ]
            }

## Display the specified resource. [GET /events/{id}]


+ Parameters
    + id: (integer, required) - ID of Challenge

+ Response 200 (application/json)
    + Body

            {
                "event": {
                    "id": 1,
                    "name”:”Event Name”,”date": "2018-12-03 11:33:37",
                    "description”:”Description,”created_at": "2017-06-13 16:35:34",
                    "updated_at": "2017-06-13 16:35:34"
                }
            }

# Users [/users]
Users

## Display a listing of the resource. [GET /users]


+ Response 200 (application/json)
    + Body

            {
                "users": [
                    {
                        "id": 1,
                        "slack_id": "UrH6vj8",
                        "name": "Wilma Hickle",
                        "email": "kallie68@example.org",
                        "thumbnail": null,
                        "admin": 0,
                        "created_at": "2017-06-13 17:57:56",
                        "updated_at": "2017-06-13 17:57:56"
                    }
                ]
            }

## Display the specified resource. [GET /users/{id}]


+ Parameters
    + id: (integer|string, required) - ID of User OR Slack ID of user

+ Response 200 (application/json)
    + Body

            {
                "user": {
                    "id": 1,
                    "slack_id": "UuwXqgS",
                    "name": "Lambert Feest",
                    "email": "uwintheiser@example.com",
                    "thumbnail": null,
                    "admin": 0,
                    "survey": "",
                    "created_at": "2017-06-19 20:06:49",
                    "updated_at": "2017-06-19 20:13:45"
                }
            }

## Update the specified resource in storage. [PUT /users/{id}]


+ Parameters
    + id: (integer|string, required) - ID of User OR Slack ID of user

+ Request (application/json)
    + Body

            {
                "survey": ""
            }

+ Response 200 (application/json)
    + Body

            {
                "user": {
                    "id": 1,
                    "slack_id": "UuwXqgS",
                    "name": "Lambert Feest",
                    "email": "uwintheiser@example.com",
                    "thumbnail": null,
                    "admin": 0,
                    "survey": "",
                    "created_at": "2017-06-19 20:06:49",
                    "updated_at": "2017-06-19 20:13:45"
                }
            }