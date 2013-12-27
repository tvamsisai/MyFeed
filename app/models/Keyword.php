<?php


class Keyword extends Eloquent {
	protected $table = 'keywords_in_article';
	protected $softDelete = true;

    public function article()
    {
        return $this->belongsTo('Article');
    }

    public function word()
    {
        return $this->hasOne('Word');
    }
}