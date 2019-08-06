<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';   //table name
    protected $primaryKey = 'id';   //primary key name
    public $timestamps = false;     //no timestamp needed
  protected $fillable = ['bookname','isbn','author','publication_date','language','description'];


}
