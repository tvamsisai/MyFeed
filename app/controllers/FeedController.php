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
		$input['count'] = Article::all()->count();
		if(Input::get('by') == 'recent') {
			if (Article::all()->count() > 0) {
				if (Input::get('page') > 0)
					$page = Input::get('page');
				else
					$page = 0;
				$input['articles'] = Article::orderBy('time_pub', 'DESC')->limit(30)->skip($page*30)->get();
			}
		}
		else {
			if (Article::all()->count() > 0) {
				if (Input::get('page') > 0)
					$page = Input::get('page');
				else
					$page = 0;
				$input['articles'] = Article::orderBy('time_pub', 'DESC')->limit(30)->skip($page*30)->get();
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
			if (Input::get('page') > 0)
					$page = Input::get('page');
				else
					$page = 0;
			$input['articles'] = Article::where('feed_id', '=', $id)->orderBy('time_pub', 'DESC')->limit(30)->skip($page*30)->get();
			$input['count'] = Article::where('feed_id', '=', $id)->orderBy('time_pub', 'DESC')->count();
		}

		return View::make('showFeed', $input);
	}

	public function refreshFeed($id)
	{
		Feed::find($id)->getNews();
		return 'Done';
	}

	public function getFeed($id)
	{
		$feed = Feed::find($id);
		return Response::json($feed);
	}
}
