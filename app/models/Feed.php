<?php

use Desarrolla2\RSSClient\RSSClient;

class Feed extends Eloquent {
	protected $table = 'feeds';

	public function articles()
    {
        return $this->hasMany('Article');
    }

    public function getNews()
    {
    	$client = new RSSClient();

    	$client->addFeeds(
		    array(
		        $this->url
		    ),
		    'news'
		);


		foreach ($client->fetch('news') as $item) {
			if (Article::where('url', '=', $item->getLink())->where('feed_id', '=', $this->id)->exists()) {
				continue;
			}
				$article = new Article;
				$article->title = $item->getTitle();
				$article->url = $item->getLink();
				$article->content = $item->getDescription();
				$article->vote = 0;
				$article->feed_id = $this->id;
				$article->time_pub = $item->getPubDate();
				$article->save();

				$article->createWordsFromArticle();
				$article->calcPoints();
		}

		return 'Done';
    }
}