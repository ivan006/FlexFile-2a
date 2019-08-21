@include('includes.base-dom/general-include-one-of-four')

<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">

@include('includes.base-dom/general-include-two-of-four')



@include('includes.item-menus/DataFileMenu')
@include('includes.item-menus/DataFolderMenu')
@include('includes.item-menus/PostAndGroupMenu')

@include('includes.item-menus/functions')


@include('includes.menu_post')

@include('includes.base-dom/general-include-three-of-four')


<!-- Left Column -->
<style media="screen">
.kv-li-st-no {list-style: none;}
.kv-bo-gr {border: 1px DarkGray solid;}
.kv-bo-ra-3 {border-radius: 3px;}
.kv-pad-1-4 {padding: 1px 4px;}
.kv-mar-bot {margin-bottom: 3px;}
.kv-di-in {display: inline-block;}
.kv-bo-bl {border: 1px black solid;}
.kv-pa-2{padding: 2px;}
.kv-he-20 {height: 20px;}
.kv-wi-150 {width: 150px;}
.kv-re-no {resize: none;}
.kv-he-200 {height: 200px;}
.kv-wi-100-per {width: 100%;}
.kv-re-ve {resize:vertical;}
.kv-fo-we-bo {font-weight: bold;}
.kv-wi-20 {width: 20px;}
.kv-te-al-ce {text-align: center;}

.kv-but-sty-res {
  font-size: 100%;
  font-family: inherit;
  border: 0 ;
  padding: 0;
  background-color: rgba(0,0,0,0);
}
</style>
<div class="w3-col m1">


  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>
<!-- Left Column -->
<div class="w3-col m3">


  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>Posts</h2>
    <br>
    <form  enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="posts">

      {{csrf_field()}}
      <div class="f-treeview">
        <ul>
          <li>
            Posts

            <?php echo PostAndGroupMenu(); ?>

            <ul>
              <?php
              foreach ($PostShowImSubPosts as $key => $value) {
                ?>
                <li class="f-leaf">
                  <a href="{{$value['url']}}">
                    {{$key}}
                  </a>
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

<!-- Middle Column -->
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
            <ul class="kv-li-st-no">


              <?php
              $IdentifierSuffix = -1;
              foreach ($DataShowAll[$Attr[2]] as $key => $value2) {
                $IdentifierSuffix = $IdentifierSuffix + 1;
                $CurrentIdentifier = $Identifier.'['.$Attr[2].']'.'['.$IdentifierSuffix.']';

                if (is_array($value2)) {
                  if ('folder' == $value2[$Attr[1]]) {
                    ?>
                    <li>
                      <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot kv-di-in">
                        <div class="kv-di-in">Name</div>
                        <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                        <?php echo DataFolderMenu($CurrentIdentifier, $Attr); ?>
                      </div>



                      <?php list1($CurrentIdentifier, $value2, $Attr); ?>
                    </li>


                    <?php
                  } else {
                    ?>
                    <li>
                      <div class="kv-di-in kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot">
                        <div class="kv-di-in">Name</div>
                        <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-re-no" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">



                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
                        <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
                        <?php echo DataFileMenu($CurrentIdentifier, $Attr); ?>

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
                            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot kv-di-in">


                              <img  style="width: 300px;" alt="Embedded Image" src="<?php echo $value2[$Attr[2]]; ?>" />
                              <textarea class="g-bor-gre kv-di-in"  style="display:none;" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>

                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot">


                              <textarea class="kv-bo-bl kv-pa-2 kv-he-200 kv-wi-100-per kv-re-ve kv-di-in" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                            </div>

                            <!-- <textarea class="g-bor-gre f-res-ver"  style="width:100%;" </textarea> -->
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

  <!-- Right Column -->
  <div class="w3-col m1">

    <br>

    <!-- End Right Column -->
  </div>



  @include('includes.base-dom/general-include-four-of-four')
