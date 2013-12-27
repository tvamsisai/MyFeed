<?php

class Article extends Eloquent {
	protected $table = 'articles';
	protected $touches = array('feed');

    public function feed()
    {
        return $this->belongsTo('Feed');
    }

    public function keywords()
    {
        return $this->hasMany('Keyword');
    }

    public function getTimePub() {     
        return Carbon::parse($this->time_pub);
    }

    public function getKeywords()
    {
        preg_match_all('/[\w\d-]+/', $this->content.' '.$this->title, $words);
        foreach ($words[0] as $word){
            // Check if already computed for the $word
            if(Word::where('word', '=', $word)->exists())
                if(Keyword::where('article_id', '=', $this->id)->where('keyword_id', '=', Word::where('word', '=', $word)->first()->id)->exists())
                    continue;

            $w = $word;
            $output[$w] = $this->tfidf($w);
        }
        arsort($output);
        return $output;
    }

    public function tfidf($word)
    {
        return $this->tf($word)*$this->idf($word);
    }

    public function tf($word)
    {
        preg_match_all("/\s$word\s/", $this->content.' '.$this->title, $matches);
        return count($matches[0]);
    }

    public function idf($word)
    {
        $all = Article::all()->count();
        $withWord = Article::where('content', 'like', '%'.$word.'%');
        $withWord->orWhere('title', 'like', '%'.$word.'%');
        $withWord = $withWord->count();
        return log10($all / ($withWord + 1));
    }

    public function createWordsFromArticle()
    {
        set_time_limit(200);
        $importantWords = $this->getKeywords();
        foreach ($importantWords as $word => $tfidf) {
            if($tfidf < 1.3)
                break;

            // If word already exists in bag-of-words
            if(Word::where('word', '=', $word)->exists()){
                $keyword = new Keyword;
                $keyword->points = $tfidf;
                $keyword->keyword_id = Word::where('word', '=', $word)->first()->id;
                $keyword->article_id = $this->id;
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
                $keyword->article_id = $this->id;
                $keyword->save();

                $word_obj->points += $tfidf;
                $word_obj->save();
            }
        }
    }

    public static function refreshPoints()
    {
        set_time_limit(500);
        $articles = Article::all();
        Keyword::truncate();
        foreach ($articles as $article) {
            $article->createWordsFromArticle();
        }
    }
}
