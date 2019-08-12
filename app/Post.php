<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'parent_id',
    'parent_type',
  ];
  public function Data() {
    return $this->morphMany('App\Data', 'parent');
  }

  public static function ShowActions() {

    if (!empty(func_get_args()[0])) {
      // $ShowID = PostM::ShowID(func_get_args()[0]);
      $ShowID = 1;
      $allURLs['sub_post_read'] =   route('Network.show',$ShowID);
      $allURLs['sub_post_edit'] = route('Network.edit',$ShowID);
      $allURLs['sub_post_store'] = route('Network.store',$ShowID);
    } else {
      $ShowID = null;
      $allURLs['sub_post_read'] =   route('Network.show',$ShowID);
      $allURLs['sub_post_edit'] = route('Network.edit',$ShowID);
      $allURLs['sub_post_store'] = route('Network.store',$ShowID);
    }
    return $allURLs;
  }
}
