<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{

  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'parent_id',
    'parent_type',
    'type',
    'content',
  ];
  public function parent() {
    return $this->morphTo();
  }
  public function Data() {
    return $this->morphMany('App\Data', 'parent');
  }
}
