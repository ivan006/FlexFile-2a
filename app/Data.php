<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

  public function parent()
  {
    return $this->morphTo();
  }

  public function children()
  {
    return $this->morphMany('App\Data', 'parent');
  }

  public static function ShowID($routeParameters, $DataSig)
  {
    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    $DataShowSigPref = Data::ShowSignaturePrefix();
    if (!empty($ReportShowID)) {
      $Report = Report::find($ReportShowID);
      if (!empty($Report)) {
        $Data = $Report->DataChildren->where('name', $DataShowSigPref)->first();
        if (!empty($Data)) {
          $ShowParentID = $Data->id;
        }
      }
    } elseif (!empty($GroupShowID)) {
      $Group = Group::find($GroupShowID);
      if (!empty($Group)) {
        $Data = $Group->DataChildren->where('name', $DataShowSigPref)->first();
        if (!empty($Data)) {
          $ShowParentID = $Data->id;
        }
      }
    }

    $DataSigFragments = explode('/', $DataSig);

    // ----------------
    // querie strat
    // ----------------

    if (!empty($ShowParentID)) {
      $ShowID = $ShowParentID;
      foreach ($DataSigFragments as $key => $value) {
        $DataParent = Data::find($ShowID);
        if (!empty($DataParent)) {
          $Data = $DataParent->children->where('name', $value)->first();
          if (!empty($Data)) {
            $ShowID = $Data->id;
          } else {
            $ShowID = null;
          }
        } else {
          $ShowID = null;
        }

        // $ShowID = DB::select(
        //   'SELECT *
        //   FROM data a, data b
        //   WHERE a.parent_id = b.id
        //   AND a.parent_type = "App\\Data"
        //   ;'
        // );
      }
    }
    // ----------------
    // querie strat
    // ----------------
    if (isset($ShowID)) {
      return $ShowID;
    }
  }

  public static function Show($DataShowID)
  {
    $DataShowAll = Data::find($DataShowID);

    if (!empty($DataShowAll)) {
      $ShowDataContent = $DataShowAll->toArray();

      $Attr = Entity::ShowAttributeTypes();

      $result[$Attr[2]] = $ShowDataContent['content'];
      $result[$Attr[1]] = $ShowDataContent['type'];
      $result[$Attr[0]] = $ShowDataContent['name'];
      $result[$Attr[4]] = $ShowDataContent['id'];

      return $result;
    }
  }

  public static function ShowSignaturePrefix()
  {
    $result = '_data';

    return $result;
  }

  public static function ShowForEdit($routeParameters)
  {
    $Show = Entity::ShowForEdit($routeParameters, 'App\Data');

    return $Show;
  }


  public static function ShowActions()
  {
    $ShowActions['SelectedSmartDataItem'] = 'Selected';

    return $ShowActions;
  }

  public static function StoreForEdit($request)
  {
    function StoreHelperStore($Action, $Data, $Attr)
    {
      if (isset($Data[$Attr[2]])) {
        foreach ($Data[$Attr[2]] as $key => $value) {
          if ('folder' == $value[$Attr[1]]) {
            if (isset($value[$Attr[3]])) {
              $Action = $value[$Attr[3]];
            }
            // dd($Data);
            switch ($Action) {
              case 'update':
              if (!empty($value[$Attr[4]])) {
                Data::find($value[$Attr[4]])
                ->update([
                'name' => $value[$Attr[0]],
                ]);
              }
              break;
              case 'delete':
              if (!empty($value[$Attr[4]])) {
                Data::find($value[$Attr[4]])
                ->delete();
              }
              break;
              case 'create_folder':
              $DataItem = array (
                'name' => $value[$Attr[6]]['folder'],
                'parent_id' => $value[$Attr[4]],
                'parent_type' => "App\Data",
                'type' => 'folder',
                'content' => 'null',
              );
              Data::Add($DataItem);
              $Action = null;
              break;
              case 'create_file':

              $DataItem = array (
                'name' => $value[$Attr[6]]['file'],
                'parent_id' => $value[$Attr[4]],
                'parent_type' => "App\Data",
                'type' => 'file',
                'content' => 'null',
              );

              Data::Add($DataItem);

              // $Action = null;
              break;

              default:

              break;
            }
            StoreHelperStore($Action, $value, $Attr);
            $Action = null;
          } else {
            if (isset($value[$Attr[3]])) {
              $Action = $value[$Attr[3]];
            }

            switch ($Action) {
              case 'update':
              if (!empty($value[$Attr[4]])) {
                Data::find($value[$Attr[4]])
                ->update([
                'name' => $value[$Attr[0]],
                'content' => $value[$Attr[2]],
                ]);
              }
              break;
              case 'delete':
              if (!empty($value[$Attr[4]])) {
                Data::find($value[$Attr[4]])
                ->delete();
              }
              break;

              default:

              break;
            }
            $Action = null;
          }
        }
      }
    }
    $Attr = Entity::ShowAttributeTypes();
    $Data = $request->get('Data');

    StoreHelperStore(null, $Data, $Attr);
  }

  public static function Add($DataItem)
  {

    // dd($DataItem);
    Data::create($DataItem);
  }
}
