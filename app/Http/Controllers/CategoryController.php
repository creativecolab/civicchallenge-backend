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
	 * List categories.
	 * Option to include challenges as well as resources. Resources default to current phase only.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/{?include}")
	 * @parameters({
	 *     @parameter("include", type="string", description="Relations to include", members={
	 *          @Member(value="challenges"),
	 *          @Member(value="challenges.questions{?:allPhases(true)}", description="Get relations from all phases (default is current phase only)"),
	 *     }),
	 * })
	 */
	public function index() {
		return Category::all();
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
	 * @response(200, body={"data":{"id":1,"name":"Name","description":"Category description","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 */
	public function store( Request $request ) {
		return Category::create( $request->all() );
	}

	/**
	 * Get Category by ID.
	 * Option to include challenges as well as resources. Resources default to current phase only.
	 *
	 * @param  \App\Category $category
	 *
	 * @return Category
	 * @get("/{id}{?challenges,questions,allPhases,include}")
	 * @response(200, body={"data":{"id":1,"name":"Explicabo doloribus distinctio nulla.","description":"Quas ad officia alias asperiores laborum hic aut ex.","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer"),
	 *     @parameter("include", type="string", description="Relations to include", members={
	 *          @member(value="challenges"),
	 *          @member(value="challenges.questions", description="Get relations from all phases (default is current phase only)")
	 *     }),
	 * })
	 */
	public function show( Category $category ) {
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
	 * @response(200, body={"data":{"id":1,"name":"Name","description":"Quas ad officia alias asperiores laborum hic aut ex.","created_at":"2017-05-31 07:35:50","updated_at":"2017-05-31 07:35:50"}})
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
