<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

/**
 * Categories of Microchallenges
 * @package App\Http\Controllers
 * @resource("Categories", uri="/categories")
 */
class CategoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/{?include}")
	 * @parameters({
	 *     @parameter("challenges", type="boolean", description="Include challenges under each category", default="false"),
	 *     @parameter("questions", type="boolean", description="Include associated questions at current phase.", default="false"),
	 *     @parameter("allPhases", type="boolean", description="Get relations from all phases.", default="false"),
	 *     @parameter("include", type="enum[string]", description="Relations to include", members={
	 *          @member(value="challenges"),
	 *          @member(value="challenges.questions")
	 *     }),
	 * })
	 */
	public function index( Request $request ) {
		$withChallenges = filter_var( $request->query( 'challenges' ), FILTER_VALIDATE_BOOLEAN );
		$withQuestions  = filter_var( $request->query( 'questions' ), FILTER_VALIDATE_BOOLEAN );
		$allPhases      = filter_var( $request->query( 'allPhases' ), FILTER_VALIDATE_BOOLEAN );

		$loadRelations = [];

		if ( $withChallenges ) {
			$loadRelations[] = 'challenges';
		}

		if ( $allPhases ) {
			if ( $withQuestions ) {
				$loadRelations[] = 'challenges.questions';
			}

			return Category::with( $loadRelations )->get();
		} else {
			$categories = Category::with( $loadRelations )->get();

			if ( $withChallenges && $withQuestions ) {
				foreach ( $categories as $category ) {
					foreach ( $category->challenges as $key => $challenge ) {
						$phase = $challenge->phase;
						$challenge->load( [
							'questions' => function ( $query ) use ( $phase ) {
								$query->where( 'phase', '=', $phase );
							}
						] );
					}
				}
			}

			return $categories;
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @post("/")
	 * @request({"name": "Name", "description": "Category description"})
	 * @response(200, body={"category":{"id":1,"name":"Name","description":"Category description","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 */
	public function store( Request $request ) {
		return Category::create( $request->all() );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Request $request
	 * @param  \App\Category $category
	 *
	 * @return Category
	 * @get("/{id}{?challenges,questions,allPhases,include}")
	 * @response(200, body={"category":{"id":1,"name":"Explicabo doloribus distinctio nulla.","description":"Quas ad officia alias asperiores laborum hic aut ex.","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer"),
	 *     @parameter("challenges", type="boolean", description="Include challenges under category", default="false"),
	 *     @parameter("questions", type="boolean", description="Include associated questions at current phase.", default="false"),
	 *     @parameter("allPhases", type="boolean", description="Get relations from all phases.", default="false"),
	 *     @parameter("include", type="enum[string]", description="Relations to include", members={
	 *          @member(value="challenges"),
	 *          @member(value="challenges.questions")
	 *     }),
	 * })
	 */
	public function show( Request $request, Category $category ) {
		$withChallenges = filter_var( $request->query( 'challenges' ), FILTER_VALIDATE_BOOLEAN );
		$withQuestions  = filter_var( $request->query( 'questions' ), FILTER_VALIDATE_BOOLEAN );
		$allPhases      = filter_var( $request->query( 'allPhases' ), FILTER_VALIDATE_BOOLEAN );

		$loadRelations = [];

		if ( $withChallenges ) {
			$loadRelations[] = 'challenges';
		}

		if ( $allPhases ) {
			if ( $withQuestions ) {
				$loadRelations[] = 'challenges.questions';
			}
		} else {
			if ( $withChallenges && $withQuestions ) {
				$category->load($loadRelations);

				$loadRelations = []; // Reset because we've loaded

				foreach ( $category->challenges as $key => $challenge ) {
					$phase = $challenge->phase;
					$challenge->load( [
						'questions' => function ( $query ) use ( $phase ) {
							$query->where( 'phase', '=', $phase );
						}
					] );
				}
			}
		}

		return $category->load( $loadRelations );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Category $category
	 *
	 * @return Category
	 *
	 * @post("/{id}")
	 * @request({"name": "Name"})
	 * @response(200, body={"category":{"id":1,"name":"Name","description":"Quas ad officia alias asperiores laborum hic aut ex.","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer")
	 * })
	 */
	public function update( Request $request, Category $category ) {
		if ( ! $category->update( $request->all() ) ) {
			$this->response->errorInternal();
		}

		return $category;
	}

	/**
	 * Delete category. Any challenges within the category will have its category set to NULL.
	 *
	 * @param Category $category
	 *
	 * @return \Illuminate\Http\Response
	 *
	 * @delete("/{id}")
	 * @response(204)
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer")
	 * })
	 */
	public function destroy( Category $category ) {
		if ( ! $category->delete() ) {
			$this->response->errorInternal();
		}

		return $this->response->noContent();
	}
}
