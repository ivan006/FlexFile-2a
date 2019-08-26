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

  public function DataChildren()
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
          $Data = $DataParent->DataChildren->where('name', $value)->first();
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


  public static function ShowMultiForEdit($routeParameters)
  {

    $GroupShowID = Group::ShowID($routeParameters);
    $ReportShowID = Report::ShowID($GroupShowID, $routeParameters);

    $Identifier = null;
    if (!empty($ReportShowID)) {

      $BaseEntityType = 'Report';
      $BaseEntityID = $ReportShowID;
    } elseif (!empty($GroupShowID)) {
      $BaseEntityType = 'Group';
      $BaseEntityID = $GroupShowID;
    }

    $BaseEntityTypeClass = "App\\".$BaseEntityType;

    $DataList = $BaseEntityTypeClass::find($BaseEntityID)->DataChildren->first()->toArray();

    $BaseEntityID = $DataList['id'];
    $BaseEntityType = 'Data';

    $EntityType = 'Data';

    $Slug = null;

    $result = Entity::ShowMulti($BaseEntityType,$BaseEntityID, $EntityType,$Slug);

    return $result;
  }



  public static function ShowActions()
  {
    $ShowActions['SelectedSmartDataItem'] = 'Selected';

    return $ShowActions;
  }

  public static function ShowMultiStyledForEdit($DataShowMultiForEdit)
  {

    function DataShowMultiStyledForEditHelper($Identifier, $DataShowMultiForEdit, $Attr)
    {

      $result = null;
      ob_start();
      ?>
      <ul class="kv-list-parent">
        <?php
        $IdentifierSuffix = -1;
        if (!empty($DataShowMultiForEdit[$Attr[2]])) {
          foreach ($DataShowMultiForEdit[$Attr[2]] as $key => $value2) {
            $IdentifierSuffix = $IdentifierSuffix + 1;
            $CurrentIdentifier = $Identifier.'['.$Attr[2].']'.'['.$IdentifierSuffix.']';

            if (is_array($value2)) {
              if ('folder' == $value2[$Attr[1]]) {
                ?>
                <li>

                  <div class="kv-item-container  kv-di-in ">
                    <div class="kv-di-in">📁</div>
                    <label style="">
                      <input class="kv-tog-on-ib-switch kv-tog-off-ib-switch" type="checkbox" name="checkbox" value="value">
                      <input class="kv-field-container kv-name kv-tog-on-ib" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                      <div class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></div>
                      <span class="kv-little-button ">∧</span>
                    </label>

                    <input class="kv-di-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                    <input class="kv-di-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                    <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
                    <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="delete">×</button>


                    <label class="kv-po-re">
                      <span class="kv-little-button ">+</span>
                      <input class="kv-tog-on-bl-switch" type="checkbox" name="checkbox" value="value">
                      <div class="kv-popover kv-tog-on-bl kv-item-container  kv-di-in" style="">
                        <div class="kv-mar-bot-3" >
                          <span>📁</span>
                          <input class="kv-field-container kv-name kv-di-in "  type="text"   name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][folder]" >
                          <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_folder">+</button>
                        </div>
                        <div class="">
                          <span>📃</span>
                          <input class="kv-field-container kv-name kv-di-in"  type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][file]">
                          <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_file">+</button>
                        </div>
                      </div>
                    </label>
                  </div>
                  <?php



                  $result .= ob_get_contents();

                  ob_end_clean();
                  $result .= DataShowMultiStyledForEditHelper($CurrentIdentifier, $value2, $Attr);

                  ob_start();
                  ?>
                </li>


                <?php
              } else {
                ?>
                <li>
                  <div class="kv-item-container  kv-di-in ">
                    <div class="kv-di-in">📃</div>
                    <label style="">
                      <input class="kv-tog-on-ib-switch kv-tog-off-ib-switch" type="checkbox" name="checkbox" value="value">
                      <input class="kv-field-container kv-name kv-tog-on-ib" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                      <div class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></div>
                      <span class="kv-little-button ">∧</span>
                    </label>

                    <input class="kv-di-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                    <input class="kv-di-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                    <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
                    <button type="submit" class="kv-little-button" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="delete">×</button>

                  </div>


                  <ul class="kv-list-parent">
                    <li>



                      <?php
                      $fileExtension = Entity::FileExtention($value2[$Attr[0]]);

                      if ('png' == $fileExtension or 'jpg' == $fileExtension or 'jpeg' == $fileExtension
                      or 'png' == $fileExtension or 'gif' == $fileExtension)
                      {
                        ?>
                        <div class="kv-item-container ">
                          <img  style="width: 300px;" alt="Embedded Image" src="<?php echo $value2[$Attr[2]]; ?>" />
                          <textarea class="kv-field-container kv-content-container kv-di-in kv-di-no" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                        </div>
                        <?php
                      } else {
                        ?>

                        <div class="kv-item-container ">
                          <textarea class="kv-field-container kv-content-container kv-di-in" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                        </div>

                        <?php
                      } ?>
                    </li>
                  </ul>
                </li>
                <?php
              }
            }
          }
        }?>
      </ul>
      <?php



      $result .= ob_get_contents();

      ob_end_clean();

      return $result;
    }
    $Identifier = 'Data';

    $Attr = Entity::ShowAttributeTypes();
    $result = DataShowMultiStyledForEditHelper($Identifier, $DataShowMultiForEdit, $Attr);



    return $result;
  }



  public static function StoreMultiForEdit($request)
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
