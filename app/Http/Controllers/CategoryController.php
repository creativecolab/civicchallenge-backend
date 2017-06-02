<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

/**
 * Categories of Microchallenges
 * @package App\Http\Controllers
 * @resource("Group Categories")
 */
class CategoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/{?challenges}")
	 * @parameters({
	 *     @parameter("challenges", type="boolean", description="Include challenges under each category", default="false")
	 * })
	 */
	public function index( Request $request ) {
		$withChallenges = strtolower( $request->query( 'challenges' ) );

		if ( $withChallenges == 'true' || $withChallenges == '1' ) {
			$categories = Category::with( [ 'challenges' ] )->get();
		} else {
			$categories = Category::all();
		}

		return $categories;
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
	 * @param  \App\Category $category
	 *
	 * @return Category
	 *
	 * @get("/{id}{?challenges}")
	 * @response(200, body={"category":{"id":1,"name":"Explicabo doloribus distinctio nulla.","description":"Quas ad officia alias asperiores laborum hic aut ex.","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer"),
	 *     @parameter("challenges", type="boolean", description="Include challenges under category", default="false")
	 * })
	 */
	public function show( Request $request, Category $category ) {
		$withChallenges = strtolower( $request->query( 'challenges' ) );

		if ( $withChallenges == 'true' || $withChallenges == '1' ) {
			$category->load( [ 'challenges' ] );
		}

		return $category;
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
