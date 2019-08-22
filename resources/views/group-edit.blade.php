@include('includes.base-dom/general-include-one-of-four')
<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
@include('includes.base-dom/general-include-two-of-four')
@include('includes.item-menus/PostAndGroupMenu')
@include('includes.item-menus/functions')
@include('includes.menu_post')
@include('includes.base-dom/general-include-three-of-four')





<div class="w3-col m5">


  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>Posts</h2>

    <form  enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="posts">

      {{csrf_field()}}
      <div class="f-treeview">
        <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
          <li>

            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-di-in kv-wh-sp-no ">
              <div class="kv-di-in">📁</div>
              <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="" value="Posts">

              <input class=""  style="display:none;" type="text" name="" value="">
              <input class=""  style="display:none;" type="text" name="" value="">

              <?php echo PostAndGroupMenu(); ?>
            </div>

            <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
              <?php
              foreach ($PostShowImSubPosts as $key => $value) {
                ?>

                <li>
                  <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-di-in kv-wh-sp-no ">
                    <div class="kv-di-in">📁</div>
                    <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="" value="{{$key}} {{$value['url']}}">

                    <input class=""  style="display:none;" type="text" name="" value="">
                    <input class=""  style="display:none;" type="text" name="" value="">
                    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="" value="update">✓</button>
                    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="Destroy" value="1">×</button>
                    <label class="kv-po-re">
                      <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in ">+</span>
                      <input class="ks-di-no kv-sibling-di-bl" type="checkbox" name="checkbox" value="value">
                      <div class="kv-bg-wh kv-wh-sp-no ks-di-no kv-po-ab kv-to-100-per kv-ri-0 kv-z-in-1 kv-sibling-di-bl-sib " style="">
                        <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh  ">
                          <div class="">
                            <span>📁</span>
                            <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no"  type="text" name="name">
                            <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="create" value="1">+</button>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>



                </li>
                <?php
              }
              ?>

            </ul>
          </li>
        </ul>
      </div>

    </form>

  </div>
  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>


<div class="w3-col m7">
  <!-- <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

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

  </div> -->
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <h2>Data</h2>


    <form  id="form" enctype="multipart/form-data" name="" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">
      {{csrf_field()}}
      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="data">

      <div class="">


        <?php

        if (!empty($DataShowAll)) {
          function list1($Identifier, $DataShowAll, $Attr)
          {
            ?>
            <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">


              <?php
              $IdentifierSuffix = -1;
              foreach ($DataShowAll[$Attr[2]] as $key => $value2) {
                $IdentifierSuffix = $IdentifierSuffix + 1;
                $CurrentIdentifier = $Identifier.'['.$Attr[2].']'.'['.$IdentifierSuffix.']';

                if (is_array($value2)) {
                  if ('folder' == $value2[$Attr[1]]) {
                    ?>
                    <li>
                      <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-di-in kv-wh-sp-no ">
                        <div class="kv-di-in">📁</div>
                        <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                        <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
                        <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="Destroy" value="1">×</button>
                        <label class="kv-po-re">
                          <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in ">+</span>
                          <input class="ks-di-no kv-sibling-di-bl" type="checkbox" name="checkbox" value="value">
                          <div class="kv-bg-wh kv-wh-sp-no ks-di-no kv-po-ab kv-to-100-per kv-ri-0 kv-z-in-1 kv-sibling-di-bl-sib" style="">
                            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh  ">
                              <div class="kv-mar-bot-3" >
                                <span>📁</span>
                                <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no"  type="text"   name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][folder]" >
                                <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_folder">+</button>
                              </div>
                              <div class="">
                                <span>📃</span>
                                <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no"  type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][file]">
                                <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_folder">+</button>
                              </div>
                            </div>
                          </div>
                        </label>
                      </div>
                      <?php list1($CurrentIdentifier, $value2, $Attr); ?>
                    </li>


                    <?php
                  } else {
                    ?>
                    <li>
                      <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-di-in ">
                        <div class="kv-di-in">📃</div>
                        <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                        <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
                        <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="Destroy" value="1">×</button>
                      </div>
                      <ul class="kv-li-st-no">
                        <li>



                          <?php
                          $fileExtension = FileExtention($value2[$Attr[0]]);

                          if (
                          'png' == $fileExtension
                          or 'jpg' == $fileExtension
                          or 'jpeg' == $fileExtension
                          or 'png' == $fileExtension
                          or 'gif' == $fileExtension
                          ) {
                            ?>
                            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-di-in kv-wh-sp-no ">
                              <img  style="width: 300px;" alt="Embedded Image" src="<?php echo $value2[$Attr[2]]; ?>" />
                              <textarea class="g-bor-gre kv-di-in"  style="display:none;" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh ">
                              <textarea class="kv-bo-bl kv-pa-2 kv-he-200 kv-wi-100-per kv-re-ve kv-di-in" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                            </div>

                            <?php
                          } ?>



                        </li>
                      </ul>

                    </li>

                    <?php
                  }
                }
              } ?>
            </ul>
            <?php
          }
          $Identifier = 'Data';
          list1($Identifier, $DataShowAll, $Attr);
        }
        ?>
      </div>
      <br>
    </form>
  </div>




  <br>






  <!-- End Middle Column -->
</div>





@include('includes.base-dom/general-include-four-of-four')
