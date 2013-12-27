<?php

class FeedController extends BaseController {

	public function add()
	{
		return View::make('addFeed');
	}

	public function save()
	{
		$url = Input::get('url');
		$name = Input::get('feed-name');

		$feed = new Feed;
		$feed->url = $url;
		$feed->name = $name;
		$feed->points = 0;
		$feed->save();

		return Redirect::to('refresh');
	}

	public function home() {
		$input['articles'] = "";

		if(Input::get('by') == 'recent') {
			if (Article::all()->count() > 0) {
				$input['articles'] = Article::orderBy('time_pub', 'DESC')->get();
			}
		}
		else {
			if (Article::all()->count() > 0) {
				$input['articles'] = Article::orderBy('time_pub', 'DESC')->get();
			}
		}
		
		return View::make('home', $input);
	}

	public function showFeeds() {
		$input['feeds'] = "";
		if(Feed::all()->count() > 0) {
			$input['feeds'] = Feed::all();
		}

		return View::make('showFeeds', $input);
	}

	public function showFeed($id) {
		if (Feed::exists($id)) {
			$input['feed'] = Feed::find($id);
		}
		else
			App::abort(404);

		$input['articles'] = "";
		if(Article::where('feed_id', '=', $id)->count() > 0) {
			$input['articles'] = Article::where('feed_id', '=', $id)->orderBy('time_pub', 'DESC')->get();
		}

		return View::make('showFeed', $input);
	}

	public function refreshFeed($id)
	{
		Feed::find($id)->getNews();
		return 'Done';
	}
}
