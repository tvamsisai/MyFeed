<?php

class Word extends Eloquent {
	protected $table = 'keywords';
	protected $softDelete = true;

    public function keywords()
    {
        return $this->hasMany('Keyword');
    }
}