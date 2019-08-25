<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Data;
class Entity extends Model
{
  public static function ShowMulti($routeParameters, $EntityType)
  {

    if (!function_exists('App\ShowHelper')) {
      function ShowHelper($Data, $Identifier, $EntityType)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $Identifier = -1;
        foreach ($Data as $key => $value) {
          $Identifier = $Identifier + 1;

          $SubData = $EntityType::find($value['id'])->children->toArray();

          if ('folder' == $value['type']) {
            $result[$Identifier][$Attr[2]] = ShowHelper($SubData, $Identifier, $EntityType);
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

    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    $Identifier = null;
    if (!empty($ReportShowID)) {
      $BaseData = Report::find($ReportShowID)->DataChildren->toArray();
    } elseif (!empty($GroupShowID)) {
      $BaseData = Group::find($GroupShowID)->DataChildren->toArray();
    }
    $Show = ShowHelper($BaseData, $Identifier, $EntityType);

    return $Show;
  }
  public static function ShowMultiForEdit($routeParameters, $EntityType)
  {
    $result = Entity::ShowMulti($routeParameters, $EntityType);

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
