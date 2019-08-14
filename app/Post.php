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
  public function DataChildren() {
    return $this->morphMany('App\Data', 'parent');
  }
  public function PostChildren() {
    return $this->morphMany('App\Post', 'parent');
  }

  public static function ShowActions() {
    if (!empty(func_get_args()[0])) {
      $PostShowSig = Post::ShowSignature(func_get_args()[0]);
      $GroupShowSig = Group::ShowSignature(func_get_args()[0]);
      $Slug = $GroupShowSig."/".$PostShowSig;
    } else {
      $Slug = null;
    }
    $allURLs['sub_post_read'] =   route('NetworkC.show',$Slug);
    $allURLs['sub_post_edit'] = route('NetworkC.edit',$Slug);
    $allURLs['sub_post_store'] = route('NetworkC.store',$Slug);
    return $allURLs;
  }
  public static function ShowSignature($routeParameters){
    // dd($arguments);
    $arguments = $routeParameters;
    array_shift($arguments);
    // dd($arguments);

    foreach ($arguments as $key => $value) {
      if (isset($VPgLoc)) {

        $VPgLoc .= "/".$value;

      } else {
        $VPgLoc = $value;
      }
    }
    // dd($VPgLoc);


    $GroupShowSig = Group::ShowSignature($routeParameters);
    $result = $GroupShowSig."/".$VPgLoc;
    return $result;

  }

  public static function ShowID(){

  }


  public static function ShowBaseIDPlusBaseLocation() {
    return Group::ShowBaseLocation().Post::ShowBaseID(func_get_args()[0]);
  }

  public static function ShowBaseID() {
    $arguments = func_get_args()[0][0];

    return $arguments;
  }

  // public static function ShowLocation($ShowID) {
  //   if (!empty($ShowID)) {
  //     // return  Group::ShowBaseLocation().$ShowID;
  //     return  $ShowID;
  //   } else {
  //     return "now what";
  //   }
  //
  // }

  public static function ShowSubPost() {
    return null;
  }

}
