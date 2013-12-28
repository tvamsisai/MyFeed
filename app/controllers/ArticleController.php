<?php

class ArticleController extends BaseController {

	public function getKeywords($article_id)
	{
		$articles = Article::all();
		foreach($articles as $article) {
			$importantWords = $article->getKeywords();
			foreach ($importantWords as $word => $tfidf) {
				if($tfidf < 1.5)
					break;

				// If word already exists in bag-of-words
				if(Word::where('word', '=', $word)->exists()){
					$keyword = new Keyword;
					$keyword->points = $tfidf;
					$keyword->keyword_id = Word::where('word', '=', $word)->first()->id;
					$keyword->article_id = $article->id;
					$keyword->save();

					$word_obj = Word::find($keyword->keyword_id);
					$word_obj->points += $tfidf;
					$word_obj->save();
				}
				// If word doens't exist in bag-of-words
				else {
					$word_obj = new Word;
					$word_obj->word = $word;
					$word_obj->points = 0;
					$word_obj->save();

					$keyword = new Keyword;
					$keyword->points = $tfidf;
					$keyword->keyword_id = $word_obj->id;
					$keyword->article_id = $article->id;
					$keyword->save();

					$word_obj->points += $tfidf;
					$word_obj->save();
				}

				$article->points += $word_obj;
			}
		}
	}

	public function search()
	{
		$search_key = Input::get('q');
		$input['results'] = '';
		if(trim($search_key) == "")
			return View::make('search', $input);

		if (Input::get('page') > 0)
			$page = Input::get('page');
		else
			$page = 0;

		$input['count'] = Keyword::where('keyword_id', '=', Word::where('word', 'LIKE', '%'.$search_key.'%')->first()->id)->orderBy('points', 'DESC')->count();
		$input['results'] = Keyword::where('keyword_id', '=', Word::where('word', 'LIKE', '%'.$search_key.'%')->first()->id)->orderBy('points', 'DESC')->limit(30)->skip($page*30)->get();
		return View::make('search', $input);
	}

	public function refreshArticlepoints()
	{
		return Article::refreshPoints();
	}

	public function checkNew()
	{
		$clientHas = Input::get('have');
		return Article::where('id', '>', $clientHas)->count();
	}

	public function getArticle($id)
	{
		$article = Article::find($id);
		return Response::json($article);
	}
}