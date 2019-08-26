<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Data;
class Entity extends Model
{

  public static function ShowMulti($BaseEntityType,$BaseEntityID, $EntityType,$Slug)
  {
    if (!function_exists('App\ShowMultiHelper')) {
      function ShowMultiHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier,$Slug)
      {
        $result = array();
        $Attr = Entity::ShowAttributeTypes();

        $BaseEntityTypeClass = "App\\".$BaseEntityType;

        $Entity = $BaseEntityTypeClass::find($BaseEntityID)->toArray();

        $Slug = $Slug."/".$Entity['name'];

        $result[$Attr[0]] = $Entity['name'];
        $result[$Attr[1]] = $Entity['type'];
        $result[$Attr[2]] = null;
        $result[$Attr[4]] = $Entity['id'];
        $result[$Attr[7]] = $Slug;

        $EntityChildrenType = $EntityType."Children";

        $SubEntityList = $BaseEntityTypeClass::find($BaseEntityID)->$EntityChildrenType->toArray();

        $SubIdentifier = 0;
        foreach ($SubEntityList as $key => $value) {

          $BaseEntityID = $value[$Attr[4]];

          if ('folder' == $value['type']) {
            $BaseEntityType = $EntityType;
            $result[$Attr[2]][$SubIdentifier] = ShowMultiHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier,$Slug);
          } else {
            $result[$Attr[2]][$SubIdentifier] = $BaseEntityTypeClass::Show($value['id']);
          }
          $SubIdentifier = $SubIdentifier + 1;
        }

        return $result;
      }
    }

    $SubIdentifier = 0;

    $result[0] = ShowMultiHelper($BaseEntityType, $BaseEntityID, $EntityType, $SubIdentifier,$Slug);

    return $result;
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
    '7' => 'url',
    );

    return $ShowAttributeTypes;
  }

  public static function FileExtention($name)
  {
      $explodedName = explode('.', $name);
      $extention = end($explodedName);

      return $extention;
  }


  public static function ShowMultiStyledForEdit($EntityShowMultiForEdit,$EntityType)
  {
    function ShowMultiStyledForEditHelper($Identifier, $EntityShowMultiForEdit, $Attr,$EntityType)
    {
      $result = null;
      ob_start();
      ?>
      <ul class="kv-list-parent">
        <?php
        $IdentifierSuffix = -1;
        if (!empty($EntityShowMultiForEdit[$Attr[2]])) {
          foreach ($EntityShowMultiForEdit[$Attr[2]] as $key => $value2) {
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
                      <?php if ($EntityType=='Report') { ?>
                        <a href="<?php echo $value2['url']; ?>" class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></a>
                      <?php } else { ?>
                        <div class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></div>
                      <?php }?>
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
                  $result .= ShowMultiStyledForEditHelper($CurrentIdentifier, $value2, $Attr,$EntityType);


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



    $Identifier = $EntityType;
    $Attr = Entity::ShowAttributeTypes();
    $result = ShowMultiStyledForEditHelper($Identifier, $EntityShowMultiForEdit, $Attr,$EntityType);
    return $result;
  }



  public static function ShowMultiStyledForEditx($EntityShowMultiForEdit,$EntityType)
  {
    function ShowMultiStyledForEditHelper($Identifier, $EntityShowMultiForEdit, $Attr,$EntityType)
    {
      $result = null;
      ob_start();
      ?>
      <ul class="kv-list-parent">
        <?php
        $IdentifierSuffix = -1;
        if (!empty($EntityShowMultiForEdit[$Attr[2]])) {
          foreach ($EntityShowMultiForEdit[$Attr[2]] as $key => $value2) {
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
                      <?php if ($EntityType=='Report') { ?>
                        <a href="<?php echo $value2['url']; ?>" class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></a>
                      <?php } else { ?>
                        <div class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></div>
                      <?php }?>
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
                  $result .= ShowMultiStyledForEditHelper($CurrentIdentifier, $value2, $Attr,$EntityType);


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



    $Identifier = $EntityType;
    $Attr = Entity::ShowAttributeTypes();
    $result = ShowMultiStyledForEditHelper($Identifier, $EntityShowMultiForEdit, $Attr,$EntityType);
    return $result;
  }








}
