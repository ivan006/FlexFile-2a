<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'parent_id',
    'parent_type',
  ];

  public function DataChildren()
  {
    return $this->morphMany('App\Data', 'parent');
  }

  public function ReportChildren()
  {
    return $this->morphMany('App\Report', 'parent');
  }

  public static function ShowActions($routeParameters)
  {
    if (!empty($routeParameters)) {
      $ReportShowSig = Report::ShowRelativeSignature($routeParameters);
      $GroupShowSig = Group::ShowSignature($routeParameters);
      $Slug = $GroupShowSig.'/'.$ReportShowSig;
    } else {
      $Slug = null;
    }

    $allURLs['sub_report_read'] = route('NetworkC.show', $Slug);
    $allURLs['sub_report_edit'] = route('NetworkC.edit', $Slug);
    $allURLs['sub_report_store'] = route('NetworkC.store', $Slug);

    return $allURLs;
  }

  public static function ShowRelativeSignature($routeParameters)
  {
    $arguments = $routeParameters;
    array_shift($arguments);
    $result = null;
    foreach ($arguments as $key => $value) {
      if (isset($result)) {
        $result .= '/'.$value;
      } else {
        $result = $value;
      }
    }

    return $result;
  }

  public static function ShowAbsoluteSignature($routeParameters)
  {
    $ReportShowSig = Report::ShowRelativeSignature($routeParameters);
    $GroupShowSig = Group::ShowSignature($routeParameters);

    $result = $GroupShowSig.'/'.$ReportShowSig;

    return $result;
  }

  public static function ShowID($GroupShowID, $routeParameters)
  {
    array_shift($routeParameters);
    $ShowID = null;
    $stage = 1;

    foreach ($routeParameters as $key => $value) {
      if (1 == $stage) {
        $ShowID = Group::find($GroupShowID)->ReportChildren->where('name', $value)->first()->id;
        $stage = 2;
      } else {
        $ShowID = Report::find($ShowID)->ReportChildren->where('name', $value)->first()->id;
      }
    }

    return $ShowID;
  }

  public static function ShowBaseIDPlusBaseLocation()
  {
    return Group::ShowBaseLocation().Report::ShowBaseID(func_get_args()[0]);
  }

  public static function ShowBaseID()
  {
    $arguments = func_get_args()[0][0];

    return $arguments;
  }

  public static function ShowSubReport($routeParameters)
  {
    if (!function_exists('App\ShowSubReportHelper')) {
      function ShowSubReportHelper($Entities, $routeParameters)
      {
        $result = array();

        $Identifier = -1;
        foreach ($Entities['List'] as $key => $value) {
          $Identifier = $Identifier + 1;
          $SubEntityList = Report::find($value['id'])->ReportChildren->toArray();
          $Slug = $Entities['Slug'].'/'.$value['name'];
          $SubEntities = array(
            'List' => $SubEntityList,
            'Slug' => $Slug,
          );
          $result[$Identifier]['content'] = ShowSubReportHelper($SubEntities, $routeParameters);
          $result[$Identifier]['url'] = $Slug;
          $result[$Identifier]['name'] = $value['name'];
          $result[$Identifier]['type'] = 'folder';
          $result[$Identifier]['id'] = $value['id'];
        }

        return $result;
      }
    }

    $GroupShowID = Group::ShowID($routeParameters);
    $GroupShow = Group::find($GroupShowID);

    $Identifier = -1;
    $Identifier = $Identifier + 1;
    $SubEntityList = Group::find($GroupShow['id'])->ReportChildren->toArray();
    $Slug = route('NetworkC.show').'/'.$GroupShow['name'];
    $SubEntities = array(
    'List' => $SubEntityList,
    'Slug' => $Slug,
    );
    $result[$Identifier]['content'] = ShowSubReportHelper($SubEntities, $routeParameters);
    $result[$Identifier]['url'] = $Slug;
    $result[$Identifier]['name'] = $GroupShow['name'];
    $result[$Identifier]['type'] = 'folder';
    $result[$Identifier]['id'] = $GroupShow['id'];

    return $result;
  }

  public static function ShowImmediateSubReport($routeParameters)
  {
    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    if (!empty($ReportShowID)) {
      $EntityShow = Report::find($ReportShowID);
      $SubEntityList = Report::find($EntityShow['id'])->ReportChildren->toArray();
    } elseif (!empty($GroupShowID)) {
      $EntityShow = Group::find($GroupShowID);
      $SubEntityList = Group::find($EntityShow['id'])->ReportChildren->toArray();
    }

    $result = array();
    foreach ($SubEntityList as $key => $value) {
      $result[$value['name']]['url'] = Report::ShowActions($routeParameters)['sub_report_edit'].'/'.$value['name'];
    }

    return $result;
  }

  public static function Store($routeParameters, $request)
  {
    switch ($request->get('form')) {
      case 'data':

      Data::StoreMultiForEdit($request);
      break;
      case 'reports':

      Report::Add($routeParameters, $request);
      break;

      default:

      break;
    }
  }

  public static function Add($routeParameters, $request)
  {
    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    $name = $request->get('name');

    if (!empty($ReportShowID)) {
      $parent_id = $ReportShowID;
      $parent_type = "App\Report";
    } elseif (!empty($GroupShowID)) {
      $parent_id = $GroupShowID;
      $parent_type = "App\Group";
    }

    $var = Report::create([
    'name' => $name,
    'parent_id' => $parent_id,
    'parent_type' => $parent_type,
    ]);

    $ReportShowID = $var->attributes['id'];

    $Data = array (
      'name' => '_data',
      'parent_id' => $ReportShowID,
      'parent_type' => "App\Report",
      'type' => 'folder',
      'content' => 'null',
    );
    // dd(1);
    Data::Add($Data);
  }
}
