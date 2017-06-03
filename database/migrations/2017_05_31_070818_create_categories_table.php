<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });

        Schema::table('challenges', function (Blueprint $table) {
        	$table->unsignedInteger('category_id')->nullable()->after('phase');
        	$table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('challenges', function (Blueprint $table) {
    		$table->dropForeign('challenges_category_id_foreign');
    		$table->dropColumn('category_id');
	    });
        Schema::dropIfExists('categories');
    }
}
