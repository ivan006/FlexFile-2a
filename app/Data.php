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

  public static function ShowID($GroupSig,$PostSig, $DataSig) {
    $GroupSigFragments = $GroupSig;
    $PostSigFragments = explode("/", $PostSig);
    $DataSigFragments = explode("/", $DataSig);

    $GroupEntityName = "App\Group";
    $PostEntityName =  "App\Post";
    $DataEntityName =  "App\Data";


    $Show["ID"] = Group::where('name', $GroupSigFragments)->first()->id;
    $Show["type"] = $GroupEntityName;
    // dd($PostSigFragments);
    foreach ($PostSigFragments as $key => $value) {
        $Show["ID"] = Post::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', $value)->first()->id;
        $Show["type"]= $PostEntityName;
    }
    $Show["ID"] = Data::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', "_data")->first()->id;
    $Show["type"] = $DataEntityName;
    foreach ($DataSigFragments as $key => $value) {
      // dd($Show["ID"]);
        $Show["ID"] = Data::where('parent_type', $Show["type"])->where('parent_id', $Show["ID"])->where('name', $value)->first()->id;
        $Show["type"]= $DataEntityName;
    }

    $ShowID = $Show["ID"];
    return $ShowID;

  }

  public static function Show($GroupSig,$PostSig, $DataSig) {

      $ShowDataID = Data::ShowID($GroupSig,$PostSig, $DataSig);
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
}
