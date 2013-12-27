<?php

class MakeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        Feed::create(array(
        	'url' => 'http://new.ycombinator.com/rss',
        	'name' => 'Hacker News',
        	'points' => 0
        ));

        Article::create(array(
        	'title' => 'This is an article',
        	'content' => 'Content of the article',
        	'vote' => 0,
        	'url' => 'http://google.com',
        	'feed_id' => 1
        ));
	}

}