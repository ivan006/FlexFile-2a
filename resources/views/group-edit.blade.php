@include('includes.base-dom/general-include-one-of-four')
<link href="{{ asset('css/key-value-list.css') }}" rel="stylesheet">
@include('includes.base-dom/general-include-two-of-four')
@include('includes.item-menus/functions')
@include('includes.menu_report')
@include('includes.base-dom/general-include-three-of-four')


<div class="w3-col m4">
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <h2>Reports</h2>
    <form  enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_report_store'] }}" method="post">
      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="reports">
      {{csrf_field()}}
      <div class="">
        <?php
        if (!empty($ReportShowSubReport)) {
          function ReportShowStyledMultiForEdit($Identifier, $Reports, $Attr)
          {
            ?>
            <ul class="kv-list-parent">
              <?php
              $IdentifierSuffix = -1;
              if (!empty($Reports[$Attr[2]])) {
                foreach ($Reports[$Attr[2]] as $key => $value2) {
                  $IdentifierSuffix = $IdentifierSuffix + 1;
                  $CurrentIdentifier = $Identifier.'['.$Attr[2].']'.'['.$IdentifierSuffix.']';

                  if (is_array($value2)) {
                    // if ('folder' == $value2[$Attr[1]]) {
                    ?>
                    <li>

                      <div class="kv-item-container  kv-di-in ">
                        <div class="kv-di-in">📁</div>
                        <label style="">
                          <input class="kv-tog-on-ib-switch kv-tog-off-ib-switch" type="checkbox" name="checkbox" value="value">
                          <input class="kv-field-container kv-name kv-tog-on-ib" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                          <!-- <div class="kv-name-unedit kv-name kv-tog-off-ib "></div> -->
                          <a href="<?php echo $value2['url']; ?>" class="kv-name-unedit kv-name kv-tog-off-ib "><?php echo $value2[$Attr[0]]; ?></a>
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
                      <?php ReportShowStyledMultiForEdit($CurrentIdentifier, $value2, $Attr); ?>
                    </li>


                    <?php
                    // }
                  }
                }
              }?>
            </ul>
            <?php
          }
          $Reports['content'] =$ReportShowSubReport;
          // dd($Reports);
          $Identifier = 'Reports';
          ReportShowStyledMultiForEdit($Identifier, $Reports, $Attr);
        }
        ?>
      </div>

    </form>

  </div>
  <!-- Alert Box -->
  <br>

  <!-- End Left Column -->
</div>


<div class="w3-col m8">
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <h2>Data</h2>
    <form  id="form" enctype="multipart/form-data" name="" class="" action="{{ $allURLs['sub_report_store'] }}" method="post">
      {{csrf_field()}}
      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="data">
      <div class="">
        <?php
        if (!empty($DataShowAll)) {
          function DataShowStyledMultiForEdit($Identifier, $DataShowAll, $Attr)
          {
            ?>
            <ul class="kv-list-parent">
              <?php
              $IdentifierSuffix = -1;
              if (!empty($DataShowAll[$Attr[2]])) {
                foreach ($DataShowAll[$Attr[2]] as $key => $value2) {
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
                        <?php DataShowStyledMultiForEdit($CurrentIdentifier, $value2, $Attr); ?>
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
                            $fileExtension = FileExtention($value2[$Attr[0]]);

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
          }
          $Identifier = 'Data';
          DataShowStyledMultiForEdit($Identifier, $DataShowAll, $Attr);
        }
        ?>
      </div>
    </form>

  </div>

  <br>

  <!-- End Middle Column -->
</div>





@include('includes.base-dom/general-include-four-of-four')
