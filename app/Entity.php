<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Data;
class Entity extends Model
{

  public static function ShowMulti($BaseEntityType,$BaseEntityID, $EntityType)
  {
    if (!function_exists('App\ShowHelper')) {
      function ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Data = $BaseEntityType::find($BaseEntityID)->toArray();
        // dd($Data);
        $result[$Attr[2]] = null;
        $result[$Attr[1]] = $Data['type'];
        $result[$Attr[0]] = $Data['name'];
        $result[$Attr[4]] = $Data['id'];

        $DataList = $BaseEntityType::find($BaseEntityID)->DataChildren->toArray();

        $SubIdentifier = 0;
        foreach ($DataList as $key => $value) {

          $BaseEntityID = $value['id'];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Attr[2]][$SubIdentifier] = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
          } else {
            $result[$Attr[2]][$SubIdentifier] = $EntityType::Show($value['id']);
          }
          $SubIdentifier = $SubIdentifier + 1;
        }

        return  $result;
      }
    }

    $SubIdentifier = 0;
    $Show = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
    // dd($Show);
    return $Show;
  }
  public static function ShowMultdi($BaseEntityType,$BaseEntityID, $EntityType)
  {
    if (!function_exists('App\ShowHelper')) {
      function ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Data = $BaseEntityType::find($BaseEntityID)->toArray();
        // dd($Data);
        $result[$Attr[2]] = null;
        $result[$Attr[1]] = $Data['type'];
        $result[$Attr[0]] = $Data['name'];
        $result[$Attr[4]] = $Data['id'];

        $DataList = $BaseEntityType::find($BaseEntityID)->DataChildren->toArray();

        $SubIdentifier = 0;
        foreach ($DataList as $key => $value) {

          $BaseEntityID = $value['id'];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Attr[2]][$SubIdentifier] = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
          } else {
            $result[$Attr[2]][$SubIdentifier] = $EntityType::Show($value['id']);
          }
          $SubIdentifier = $SubIdentifier + 1;
        }

        return  $result;
      }
    }

    $SubIdentifier = 0;
    $Show = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
    // dd($Show);
    return $Show;
  }
  public static function ShowMultiForEdit($routeParameters, $EntityType)
  {
    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    $Identifier = null;
    if (!empty($ReportShowID)) {

      $BaseEntityType = 'App\Report';
      $BaseEntityID = $ReportShowID;
    } elseif (!empty($GroupShowID)) {
      $BaseEntityType = 'App\Group';
      $BaseEntityID = $GroupShowID;
    }

    $DataList = $BaseEntityType::find($BaseEntityID)->DataChildren->first()->toArray();

    $BaseEntityID = $DataList['id'];
    $BaseEntityType = 'App\Data';



    $result[0] = Entity::ShowMulti($BaseEntityType,$BaseEntityID,  $EntityType);
    // dd($result);
    return  $result;
  }


  public static function ShowAttributeTypes()
  {
    $ShowAttributeTypes = array(
    '0' => 'name',
    '1' => 'type',
    '2' => 'content',
    '3' => 'action',
    '4' => 'id',
    '5' => 'subtype',
    '6' => 'add',
    );

    return $ShowAttributeTypes;
  }

}
