<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsInArtibleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keywords_in_article', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('points');
			$table->unsignedInteger('keyword_id');
			$table->unsignedInteger('article_id');
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('keywords_in_article');
	}

}
