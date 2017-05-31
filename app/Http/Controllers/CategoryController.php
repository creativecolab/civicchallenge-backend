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
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 *
	 * @get("/")
	 */
	public function index() {
		// TODO: Add parameter to list all challenges in categories
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
	 * @get("/{id}")
	 * @parameters({
	 *     @parameter("id", description="ID of Category", required=true, type="integer")
	 * })
	 */
	public function show( Category $category ) {
		// TODO: Add parameter to list all challenges in category
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
