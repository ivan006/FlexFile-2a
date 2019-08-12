<?php function SmartDataFileItemMenu($SmartDataID, $SmartDataItemM_ShowActions){ ?>
  <span class="" style="  ">




    <button class="w3-button w3-theme-d1 w3-margin-bottom" type="submit" name="<?php echo $SmartDataID ?>[<?php echo $SmartDataItemM_ShowActions['SelectedSmartDataItem'] ?>]" value="1">Store</button>
    <button class="w3-button w3-theme-d1 w3-margin-bottom" type="submit" name="Create" value="1"><del>Create</del></button>
    <button class="w3-button w3-theme-d1 w3-margin-bottom" type="submit" name="Destroy" value="1"><del>Destroy</del></button>

  </span>
<?php } ?>
