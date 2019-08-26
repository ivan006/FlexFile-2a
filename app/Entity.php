<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Data;
class Entity extends Model
{

  public static function ShowMulti($BaseEntityType,$BaseEntityID, $EntityType)
  {
    if (!function_exists('App\ShowHelper')) {
      function ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $Identifier)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Identifier = -1;
        $Data = $BaseEntityType::find($BaseEntityID)->DataChildren->toArray();
        foreach ($Data as $key => $value) {
          $Identifier = $Identifier + 1;

          $BaseEntityID = $value['id'];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Identifier][$Attr[2]] = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $Identifier);
            $result[$Identifier][$Attr[1]] = $value['type'];
            $result[$Identifier][$Attr[0]] = $value['name'];
            $result[$Identifier][$Attr[4]] = $value['id'];
          } else {
            $result[$Identifier] = $EntityType::Show($value['id']);
          }
        }

        return  $result;
      }
    }

    $Identifier = null;
    $Show = ShowHelper($BaseEntityType, $BaseEntityID, $EntityType, $Identifier);
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

    $result = Entity::ShowMulti($BaseEntityType,$BaseEntityID,  $EntityType);
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
