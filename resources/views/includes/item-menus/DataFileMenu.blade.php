<?php function DataFileMenu($Identifier, $Attr)
{
  ?>
  <span class="" style="  ">
    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="<?php echo $Identifier; ?>[<?php echo $Attr[3]; ?>]" value="update">✓</button>
    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-but-sty-res" type="submit" name="Destroy" value="1">×</button>

  </span>
  <?php
}
?>
