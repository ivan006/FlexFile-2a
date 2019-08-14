<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

// use App\Post;

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
  public function children() {
    return $this->morphMany('App\Data', 'parent');
  }

  // public static function ShowID($GroupSig,$PostSig, $DataSig) {
  public static function ShowID($DataSig) {

    $DataSigFragments = explode("/", $DataSig);


    // ----------------
    // querie strat
    // ----------------
      // $GroupEntityName = "App\Group";
      // $PostEntityName =  "App\Post";
      // $DataEntityName =  "App\Data";
      // $Show["ID"] = Group::where('name', $GroupSigFragments)->first()->id;
      // $Show["type"] = $GroupEntityName;
      // // dd($PostSigFragments);
      // foreach ($PostSigFragments as $key => $value) {
      //     $Show["ID"] = Post::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', $value)->first()->id;
      //     $Show["type"]= $PostEntityName;
      // }
      // $Show["ID"] = Data::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', "_data")->first()->id;
      // $Show["type"] = $DataEntityName;
      // foreach ($DataSigFragments as $key => $value) {
      //   // dd($Show["ID"]);
      //     $Show["ID"] = Data::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', $value)->first()->id;
      //     $Show["type"]= $DataEntityName;
      // }
    // ----------------
    // querie strat
    // ----------------

    // ----------------
    // querie strat
    // ----------------
      // $Show["ID"] = Group::where('name', $Group)->first()->id;
      //
      // $Show["ID"] = Group::find($Show["ID"])->PostChildren->where('name', $PostSigFragments[0])
      // ->first()->id;
      // array_shift($PostSigFragments);
      // foreach ($PostSigFragments as $key => $value) {
      //     $Show["ID"] = Post::find($Show["ID"])->PostChildren->where('name', $value)->first()->id;
      // }
      //
      // $Show["ID"] = Post::find($Show["ID"])->DataChildren->where('name', $DataSigFragments[0])->first()->id;
      // array_shift($DataSigFragments);
      // foreach ($DataSigFragments as $key => $value) {
      //   $Show["ID"] = Data::find($Show["ID"])->children->where('name', $value)->first()->id;
      // }
    // ----------------
    // querie strat
    // ----------------

    // ----------------
    // querie strat
    // ----------------



    $stage = "1. what group?";
    foreach ($DataSigFragments as $key => $value) {
      switch ($stage) {
        case "1. what group?":
          $Show["ID"] = Group::where('name', $value)->first()->id;
          $stage = "2. what post?";
          break;
        case "2. what post?":
          $Show["ID"] = Group::find($Show["ID"])->PostChildren->where('name', $value)->first()->id;
          $stage = "3. what sub-post/data?";
          // array_shift($PostSigFragments);
          break;
        case "3. what sub-post/data?":
          if ($value !== Data::ShowSignaturePrefix()) {
            $Show["ID"] = Post::find($Show["ID"])->PostChildren->where('name', $value)->first()->id;
          } else {
            $Show["ID"] = Post::find($Show["ID"])->DataChildren->where('name', $value)->first()->id;
            $stage = "4. what sub-data?";
            array_shift($DataSigFragments);
          }
          break;
        case "4. what sub-data?":
          $Show["ID"] = Data::find($Show["ID"])->children->where('name', $value)->first()->id;
          break;
        default:
          break;
      }
    }

    // $Show["ID"] = DB::select(
    //   'SELECT *
    //   FROM data a, data b
    //   WHERE a.parent_id = b.id
    //   AND a.parent_type = "App\\Data"
    //   ;'
    // );

    // ----------------
    // querie strat
    // ----------------


    // dd($Show["ID"]);
    return $Show["ID"];

  }

  public static function Show($DataSig) {

      $ShowDataID = Data::ShowID($DataSig);
      // dd($ShowDataID);

      $ShowDataContent = Data::find($ShowDataID)->toArray();

      // dd($ShowDataContent);


    // $result = file_get_contents($DataLocation);
    $Attribute_types = array(
      '1' => 'SmartDataType',
      '2' => 'SmartDataContent'
    );
      switch ($ShowDataContent["type"]) {
        case 'text':
        // code...

        $result[$Attribute_types['2']] = $ShowDataContent["content"];
        $result[$Attribute_types['1']] = $ShowDataContent["type"];
        break;
        case 'image':
        // code...

        // mime_content_type($DataLocation) == "image/jpeg"

        $subtype = $ShowDataContent["subtype"];
        $data = $ShowDataContent["content"];
        $base64 = 'data:image/' . $subtype . ';base64,' . base64_encode($data);

        $result[$Attribute_types['2']] = $base64;
        $result[$Attribute_types['1']] = 'img';
        break;

        default:
        // code...
        $result[$Attribute_types['2']] = "error dont support this: ".mime_content_type($DataLocation);
        $result[$Attribute_types['1']] = 'text';
        break;
      }
      return $result;

  }
  public static function ShowSignature($routeParameters,$arg) {

    $PostShowSig = Post::ShowSignature($routeParameters);

      $result = $PostShowSig."/".Data::ShowSignaturePrefix()."/".$arg;
      return $result;

  }
  public static function ShowSignaturePrefix() {

      $result = "_data";
      return $result;

  }
}
