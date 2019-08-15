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
  public static function ShowID($routeParameters,$DataSig) {
    // code...
    $GroupShowID = Group::ShowID($routeParameters);
    $PostShowID = Post::ShowID($GroupShowID,$routeParameters);

    $DataSigFragments = explode("/", $DataSig);
    // ----------------
    // querie strat
    // ----------------

    $stage = 1;
    foreach ($DataSigFragments as $key => $value) {
      if ($stage==1) {
        // code...
        $DataShowSigPref = Data::ShowSignaturePrefix();
        $Post = Post::find($PostShowID);
        if (!empty($Post)) {
          // code...
          $Data = Post::find($PostShowID)->DataChildren->where('name', $DataShowSigPref)->first();
          if (!empty($Data)) {
            // code...
            $ShowID = $Data->id;
            $stage = 2;
          }
        }
      } else {
        array_shift($DataSigFragments);
        $Data = Data::find($ShowID)->children->where('name', $value)->first();

        if (!empty($Data)) {
          $ShowID = $Data->id;
        }
      }




      // $ShowID = DB::select(
      //   'SELECT *
      //   FROM data a, data b
      //   WHERE a.parent_id = b.id
      //   AND a.parent_type = "App\\Data"
      //   ;'
      // );

      // ----------------
      // querie strat
      // ----------------
    }
    if (isset($ShowID)) {
      return $ShowID;
    }



  }

  public static function Show($DataShowID) {
    $DataShowAll = Data::find($DataShowID);
    // dd($dd);
    if (!empty($DataShowAll)) {
      $ShowDataContent = $DataShowAll->toArray();
      // code...

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
        $result[$Attribute_types['2']] = "unknown data type \"".$ShowDataContent["type"]."\"";
        $result[$Attribute_types['1']] = 'text';
        break;
      }
      return $result;
    }


  }
  public static function ShowRelativeSignature($arg) {
      $result = Data::ShowSignaturePrefix()."/".$arg;
      return $result;

  }
  public static function ShowSignaturePrefix() {

      $result = "_data";
      return $result;

  }
  public static function ShowAll($routeParameters) {

    if(!function_exists('App\ShowHelper')){
      function ShowHelper($Data) {
        $result = array();


        foreach ($Data as $key => $value) {
          $SubData = Data::find($value["id"])->children->toArray();

          // $DataLocation = $PostShowID . "/" . $value;
          $result[$value["name"]]["?"] = "?";

          if (!empty($SubData)) {
            // dd($SubData);


            $result[$value["name"]] = ShowHelper($SubData);
            $result[$value["name"]]["SmartDataType"] = $value["type"];
          } else {
            $result[$value["name"]] = Data::Show($value["id"]);
          }

        }
        return  $result;
      }
    }
    // dd(1);
    // $PostShowID = PostM::ShowLocation($PostShowID)."/".$ShowDataID;

    $GroupShowID = Group::ShowID($routeParameters);
    $PostShowID = Post::ShowID($GroupShowID,$routeParameters);
    // $PostShowID = Post::ShowID($PostShowID,$routeParameters);
    // dd($PostShowID);
    if (!empty($PostShowID)) {
      // $Show[$ShowDataID] =   ShowHelper($PostShowID);

      $BaseData = Post::find($PostShowID)->DataChildren->toArray();
      $Show =   ShowHelper($BaseData);
      // dd($Show);
      // dd($Show);
      return $Show;
    }
  }

  public static function ShowAttributeTypes() {
    $ShowAttributeTypes["/SmartDataName"] =   'SmartDataName';
    $ShowAttributeTypes["/SmartDataContent"] =   'SmartDataContent';
    $ShowAttributeTypes["/SmartDataType"] =   'SmartDataType';

    return $ShowAttributeTypes;
  }
  public static function ShowActions() {
    $ShowActions["SelectedSmartDataItem"] =   'Selected';
    return $ShowActions;
  }
  public static function g_base64_decode($value) {
    return base64_decode($value);
    // return $value;
  }

  public static function Store($request, $ShowID) {
    // dd($ShowID);
    function StoreHelperDestroy($ShowLocation,$ShowDataID, $SelectedSmartDataItem, $SmartDataItemShowFieldValues) {
      // dd($SmartDataItemShowFieldValues);
      foreach ($SmartDataItemShowFieldValues as $key => $value) {
        // dd($SmartDataItemShowFieldValues);
        // dd($SmartDataItemShowFieldValues);
        // dd($SmartDataItemShowFieldValues);
        // dd($SmartDataItemShowFieldValues);

        $action = 'SelectedSmartDataItem';
        $String_SmartDataName = 'SmartDataName';
        $String_SmartDataLocationParent = 'SmartDataLocationParent';
        $String_SmartDataContent = 'SmartDataContent';
        $String_SmartDataLocation = 'SmartDataLocation';
        if (
        $key !== $action
        && $key !== $String_SmartDataName
        && $key !== $String_SmartDataLocationParent
        && $key !== $String_SmartDataContent
        && $key !== $String_SmartDataLocation
        ) {
          $key = SmartDataItemM::g_base64_decode($key);
          if (!array_key_exists($String_SmartDataContent, $value)) {
            // dd(1);
            if (isset($value[$action]) OR $SelectedSmartDataItem == 1) {
              $SelectedSmartDataItemInheritance = 1;
            } else {
              $SelectedSmartDataItemInheritance = 0;
            }
            // dd($key);
            StoreHelperDestroy($ShowLocation,$ShowDataID."/".$key, $SelectedSmartDataItemInheritance, $value);
            if (isset($value[$action]) OR $SelectedSmartDataItem == 1) {
              rmdir($ShowLocation.$ShowDataID."/".$key);
            }
          } else {

            if (isset($value[$action]) OR $SelectedSmartDataItem == 1) {
              // dd($value['SelectedSmartDataItem']);
              unlink($ShowLocation.$ShowDataID."/".$key);
            }
          }
        }
      }

    }
    function StoreHelperStore($ShowLocation,$SelectedSmartDataItem,$ShowDataID,$SmartDataItemShowFieldValues) {
      // dd($SmartDataItemShowFieldValues);
      foreach($SmartDataItemShowFieldValues as $key => $value) {

        $action = 'SelectedSmartDataItem';
        $String_SmartDataName = 'SmartDataName';
        $String_SmartDataLocationParent = 'SmartDataLocationParent';
        $String_SmartDataContent = 'SmartDataContent';
        $String_SmartDataLocation = 'SmartDataLocation';
        if (
        $key !== $action
        && $key !== $String_SmartDataName
        && $key !== $String_SmartDataLocationParent
        && $key !== $String_SmartDataContent
        && $key !== $String_SmartDataLocation
        )  {
          $key = SmartDataItemM::g_base64_decode($key);
          if (!array_key_exists($String_SmartDataContent, $value)){
            if (isset($value[$action]) OR $SelectedSmartDataItem == 1) {
              $SmartDataName = $value[$String_SmartDataName];
              $SmartDataArrayLocation = $ShowLocation . $ShowDataID."/".$SmartDataName;
              $SelectedSmartDataItemInheritance = 1;
              mkdir($SmartDataArrayLocation);
            } else {

              $SmartDataName = $key;
              $SelectedSmartDataItemInheritance = 0;
            }
            StoreHelperStore($ShowLocation,$SelectedSmartDataItemInheritance, $ShowDataID."/".$SmartDataName, $value);
          } else {
            $SmartDataName = $value[$String_SmartDataName];
            $content = $value;
            $SmartDataArrayLocation = $ShowLocation.$ShowDataID."/".$SmartDataName;


            if (isset($value[$action]) OR $SelectedSmartDataItem == 1) {
              file_put_contents($SmartDataArrayLocation,$value[$String_SmartDataContent]);
            }
          }
        }
      }
    }
    dd($request);
    // $action = Data::ShowActions()["SelectedSmartDataItem"];
    // $ghjeje = $request->get("_token");



    StoreHelperDestroy($ShowLocation,null, 0, $SmartDataItemShowFieldValues);

    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();


    StoreHelperStore($ShowLocation, null,null,$SmartDataItemShowFieldValues);
  }



}
