@include('includes.base-dom/general-include-one-of-four')

  <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">

@include('includes.base-dom/general-include-two-of-four')



@include('includes.item-menus/SmartDataFileItemMenu')
@include('includes.item-menus/SmartDataFolderItemMenu')
@include('includes.item-menus/ShallowSmartDataMenu')
@include('includes.encode_decode')

@include('includes.menu_post')

@include('includes.base-dom/general-include-three-of-four')


<!-- Left Column -->
<div class="w3-col m2">


  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>

<!-- Middle Column -->
<div class="w3-col m8">
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>
      Guide

    </h2>
    <p>
      Well done!
    </p>
    <ul>
      <li>
        Please explore the below options!
      </li>



    </ul>


    <br>

  </div>
  <form  id="form" enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

    <input class="g-bor-gre"  style="display: none;" type="text" name="post_files_create_from_zip" value="1">

    {{csrf_field()}}
    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

      <h2>Create post files from Zip</h2>
      <div class="">
        <label>Please Select Zip File</label>
        <input class="g-bor-gre"  type="file" name="zip_file" />
        <input class="g-bor-gre"  type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
      </div>
      <br>
    </div>

  </form>
  <?php $Attribute_types = array(
    '1' => 'SmartDataType',
    '2' => 'SmartDataContent'
  ); ?>
  <form  id="form" enctype="multipart/form-data" name="SmartDataItemShowFieldValues" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
    {{csrf_field()}}
    <input class="g-bor-gre"  style="display: none;" type="text" name="SmartDataItemShowFieldValues_Form" value="1">

    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

      <h2>Rich Data</h2>
      <div class="">

        <?php
        $String_rich = "rich.html";
        $key = $String_rich;

        $key_encode = g_base64_encode($key);
        if (isset($ShowAllDeepSmartData["rich.html"])) {
          // code...
          $SmartDataID = "SmartDataItemShowFieldValues[".$key_encode."]";
          ?>
          <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
          <input class="g-bor-gre"  style="display:none;" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>">
          <?php
          // if (!isset($ShowAllDeepSmartData["rich.html"][$Attribute_types['2']])) {
          //   // code...
          //   dd($ShowAllDeepSmartData);
          // }
          ?>
          <textarea class="g-bor-gre "  style="width:100%;"  name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" ><?php echo $ShowAllDeepSmartData["rich.html"][$Attribute_types['2']]; ?></textarea>
          <?php
        }
        ?>
      </div>
      <br>
    </div>



    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>


      <h2>Deep Smart Data</h2>
      <div class="">


        <?php
        // dd($ShowAllDeepSmartData);
        if (!empty($ShowAllDeepSmartData)) {
          function list1(
          $SmartDataArrayShowBaseLocation,
          $smartData,
          $SmartDataLocation,
          $SmartDataLocationParent,
          $SmartDataItemM_ShowActions,
          $SmartDataItemM_ShowAttributeTypes,
          $Attribute_types
          ){
            $SmartDataArrayShowBaseLocationEncoded = g_base64_encode($SmartDataArrayShowBaseLocation);
            ?>
            <ul>
              <?php
              // dd($smartData);
              foreach($smartData as $key => $value2){
                // dd($SmartDataLocationParent);
                $SmartDataLocation = $SmartDataLocationParent.'['.g_base64_encode($key).']';
                $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
                ?>

                <?php

                if (is_array($value2)) {
                  // dd($value2);
                  if (!isset($value2["SmartDataType"])) {
                    // dd($value2);
                  }
                  if ($value2[$Attribute_types['1']] == 'dir') {
                    ?>
                    <li>
                      <?php
                      // dd($SmartDataID);
                      ?>
                      <input class="g-bor-gre"  style="" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>">
                      <?php echo SmartDataFolderItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?>


                      <?php
                      // dd($SmartDataArrayShowBaseLocationEncoded);
                      list1(
                        $SmartDataArrayShowBaseLocationEncoded,
                        $value2,
                        $SmartDataLocation,
                        $SmartDataLocation,
                        $SmartDataItemM_ShowActions,
                        $SmartDataItemM_ShowAttributeTypes,
                        $Attribute_types
                      );
                      ?>
                    </li>


                  <?php  } else {?>
                    <li class="f-leaf">
                      <input class="g-bor-gre"  style="" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>">
                      <?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?>
                      <?php if ($value2[$Attribute_types['1']] == 'img') { ?>
                        <div class="">

                          <img style="max-width: 50%;" alt="Embedded Image" src="<?php echo $value2[$Attribute_types['2']]; ?>" />
                        </div>
                      <?php } else { ?>
                        <textarea class="g-bor-gre "  style="width:100%;" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" ><?php echo $value2[$Attribute_types['2']]; ?></textarea>
                      <?php } ?>
                    </li>

                    <?php
                  }
                }
                ?>



                <?php
              }
              ?>
            </ul>
            <?php
          }

          // dd($ShowAllDeepSmartData);
          ?>
          <div class="f-treeview" >


            <?php
            // dd($ShowAllDeepSmartData);
            // dd($SmartDataArrayShowBaseLocation);
            $ShowAllDeepSmartDataSmart['smart'] = $ShowAllDeepSmartData['smart'];
            // $ShowAllDeepSmartDataSmart = $ShowAllDeepSmartData;
            // $ShowAllDeepSmartData = $ShowAllDeepSmartDataSmart;
            list1(
            $SmartDataArrayShowBaseLocation,
            $ShowAllDeepSmartDataSmart,
            null,
            null,
            $SmartDataItemM_ShowActions,
            $SmartDataItemM_ShowAttributeTypes,
            $Attribute_types
            );
            ?>
          </div>
          <?php

        }
        ?>
      </div>
      <br>
    </div>






    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      <h2>Shallow Smart Data</h2>
      <div class="">
        <div class="g-multi-level-dropdownd">

          <?php
          // dd($ShowAllDeepSmartData);
          if (isset($ShowAllDeepSmartData)) {
            // code...
            foreach($ShowAllDeepSmartData as $key => $value2){
              // dd($SmartDataLocationParent);
              $SmartDataLocation = '['.g_base64_encode($key).']';
              $SmartDataID = "SmartDataItemShowFieldValues".$SmartDataLocation;
              if (!is_array($value2) && $key !== $String_rich) {

                ?>
                <span><?php echo SmartDataFileItemMenu($SmartDataID,$SmartDataItemM_ShowActions); ?></span>
                <input class="g-bor-gre"  style="width:100%" type="text" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataName'] ?>]" value="<?php echo $key ?>"><br>
                <textarea class="g-bor-gre "  style="width:100%" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowAttributeTypes['/SmartDataContent'] ?>]" rows="8" cols="80"><?php echo $value2; ?></textarea>

                <?php
              }
            }
          }
          ?>

        </div>
      </div>
      <br>
    </div>



  </form>

  <form  id="form" enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

    <input class="g-bor-gre"  style="display: none;" type="text" name="All_Content" value="1">

    {{csrf_field()}}
    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

      <h2>Smart Data</h2>
      <div class="">
        <label>Please Select Zip File</label>
        <input class="g-bor-gre"  type="file" name="zip_file" />
        <input class="g-bor-gre"  type="submit" name="<?php echo $SmartDataItemM_ShowActions['RichDataStore'] ?>" value="Store"><br>
      </div>
      <br>
    </div>

  </form>

  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>Sub-posts</h2>
    <br>
  </div>


  <br>






  <!-- End Middle Column -->
</div>

<!-- Right Column -->
<div class="w3-col m2">

  <br>

  <!-- End Right Column -->
</div>



@include('includes.base-dom/general-include-four-of-four')
