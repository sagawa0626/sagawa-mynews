<?php

namespace News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    //Newsモデルに関連付けを行う
    public function histories()
    {
        return $this->hasMany('News\History');
    }
}