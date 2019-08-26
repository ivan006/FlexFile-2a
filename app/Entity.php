<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Data;
class Entity extends Model
{

  public static function ShowMulti($BaseEntityType,$BaseEntityID, $EntityType)
  {
    if (!function_exists('App\ShowMultiHelper2')) {
      function ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Entity = $BaseEntityType::find($BaseEntityID)->toArray();
        // dd($Entity);
        $result[$Attr[0]] = $Entity['name'];
        $result[$Attr[1]] = $Entity['type'];
        $result[$Attr[2]] = null;
        $result[$Attr[4]] = $Entity['id'];

        $SubEntityList = $BaseEntityType::find($BaseEntityID)->DataChildren->toArray();

        $SubIdentifier = 0;
        foreach ($SubEntityList as $key => $value) {

          $BaseEntityID = $value['id'];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Attr[2]][$SubIdentifier] = ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
          } else {
            $result[$Attr[2]][$SubIdentifier] = $EntityType::Show($value['id']);
          }
          $SubIdentifier = $SubIdentifier + 1;
        }

        return  $result;
      }
    }

    $SubIdentifier = 0;
    $Show = ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
    // dd($Show);
    return $Show;
  }

  public static function ShowMulti($BaseEntityType,$BaseEntityID, $EntityType)
  {
    if (!function_exists('App\ShowMultiHelper2')) {
      function ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Entity = $BaseEntityType::find($BaseEntityID)->toArray();
        // dd($Entity);
        $result[$Attr[0]] = $Entity['name'];
        $result[$Attr[1]] = $Entity['type'];
        $result[$Attr[2]] = null;
        $result[$Attr[4]] = $Entity['id'];

        $SubEntityList = $BaseEntityType::find($BaseEntityID)->DataChildren->toArray();

        $SubIdentifier = 0;
        foreach ($SubEntityList as $key => $value) {

          $BaseEntityID = $value['id'];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Attr[2]][$SubIdentifier] = ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
          } else {
            $result[$Attr[2]][$SubIdentifier] = $EntityType::Show($value['id']);
          }
          $SubIdentifier = $SubIdentifier + 1;
        }

        return  $result;
      }
    }

    $SubIdentifier = 0;
    $Show = ShowMultiHelper2($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier);
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
