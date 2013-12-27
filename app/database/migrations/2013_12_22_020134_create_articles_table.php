<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 500);
			$table->longText('content');
			$table->smallInteger('vote');
			$table->integer('points');
			$table->text('url');
			$table->unsignedInteger('feed_id');
			$table->timestamp('time_pub');

			$table->foreign('feed_id')->references('id')->on('feeds');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
