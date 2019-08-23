<html class="mobilesdk-console-app" style="" lang="en">

<head>

  <style media="screen">
  .kv-li-st-no {list-style: none;}
  .kv-bo-gr {border: 1px DarkGray solid;}
  .kv-bo-ra-3 {border-radius: 3px;}
  .kv-pad-1-4 {padding: 1px 4px;}
  .kv-mar-bot-3 {margin-bottom: 3px;}
  .kv-di-in {display: inline-block;}
  .kv-bo-bl {border: 1px black solid;}
  .kv-pa-2{padding: 2px;}
  .kv-he-20 {height: 20px;}
  .kv-wi-150 {width: 150px;}
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


  .kv-bg-wh {background-color: white;}
  .kv-wh-sp-no { white-space: nowrap;}
  .kv-di-no {display:none;}
  .kv-po-ab {position: absolute;}
  .kv-po-re {position: relative;}
  .kv-z-in-1 {z-index: 1;}
  .kv-to-100-per {top: 100%;}
  .kv-ri-0 {right: 0px;}
  .kv-sibling-di-bl:checked ~ .kv-sibling-di-bl-sib {display:block;}

  .kv-pa-le-0  {padding-left: 0;}
  .kv-child-pa-le-40 .kv-child-pa-le-40 {padding-left: 40px;}

  .kv-sibling-di-no:checked ~ .kv-sibling-di-no-sib {display:none;}
  .kv-sibling-di-in:checked ~ .kv-sibling-di-in-sib {display:inline-block;}
  .kv-bo-tr {border: 1px solid transparent}
  .kv-fo-in {font: inherit;}
  .kv-bo-si-in {box-sizing:inherit}
  .kv-ov-hi {overflow: hidden;}
  .kv-te-ov-el {text-overflow: ellipsis;}
  .kv-ve-al-bo {vertical-align: bottom;}




















  </style>

</head>
<?php $CurrentIdentifier=0; $value2=0; ?>
<body>
  <div class="">
    <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
      <li>
        <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in ">
          <div class="kv-di-in">📁</div>
          <label style="">
            <input class="kv-di-no kv-sibling-di-in kv-sibling-di-no" type="checkbox" name="checkbox" value="value">
            <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-in-sib kv-di-no kv-fo-in kv-bo-si-in" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
            <a href="#" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-no-sib kv-ov-hi kv-ve-al-bo kv-te-ov-el ">php<?php echo $value2[$Attr[0]]; ?></a>
            <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-sibling-di-no-sib ">⚙</span>
          </label>
          <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
          <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
          <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
          <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="Destroy" value="1">×</button>
          <label class="kv-po-re">
            <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in ">+</span>
            <input class="kv-di-no kv-sibling-di-bl" type="checkbox" name="checkbox" value="value">
            <div class="kv-di-no kv-po-ab kv-to-100-per kv-ri-0 kv-z-in-1 kv-sibling-di-bl-sib " style="">
              <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in   ">

                <div class="kv-mar-bot-3" >
                  <span>📁</span>
                  <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 "  type="text"   name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][folder]" >
                  <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_folder">+</button>
                </div>
                <div class="">
                  <span>📃</span>
                  <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150"  type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[6]; ?>][file]">
                  <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="create_folder">+</button>
                </div>
              </div>
            </div>
          </label>
        </div>
        <ul class="kv-li-st-no">
          <li>
            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in  ">
              <div class="kv-di-in">📃</div>
              <label style="">
                <input class="kv-di-no kv-sibling-di-in kv-sibling-di-no" type="checkbox" name="checkbox" value="value">
                <input class="kv-bo-bl kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-in-sib kv-di-no kv-fo-in kv-bo-si-in" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[0]; ?>]" value="<?php echo $value2[$Attr[0]]; ?>">
                <a href="#" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-no-sib kv-ov-hi kv-ve-al-bo kv-te-ov-el ">phpdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd<?php echo $value2[$Attr[0]]; ?></a>
                <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-sibling-di-no-sib">⚙</span>
              </label>

              <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[1]; ?>]" value="<?php echo $value2[$Attr[1]]; ?>">
              <input class=""  style="display:none;" type="text" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[4]; ?>]" value="<?php echo $value2[$Attr[4]]; ?>">
              <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
              <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="Destroy" value="1">×</button>
            </div>
            <ul class="kv-li-st-no">
              <li>
                <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh">
                  <textarea class="kv-bo-bl kv-pa-2 kv-he-200 kv-wi-100-per kv-re-ve kv-di-in" name="<?php echo $CurrentIdentifier; ?>[<?php echo $Attr[2]; ?>]" rows="8" ><?php echo $value2[$Attr[2]]; ?></textarea>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>



</body>

</html>
