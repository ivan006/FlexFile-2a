@include('includes.base-dom/general-include-one-of-four')
<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
@include('includes.base-dom/general-include-two-of-four')
@include('includes.item-menus/PostAndGroupMenu')
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
      Groups

    </h2>
    <form  enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_post_store'] }}" method="post">

      <input class="g-bor-gre"  style="display: none;" type="text" name="All_Content" value="1">

      {{csrf_field()}}
      <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
          <li>
            <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in  ">
              <div class="kv-di-in">📁</div>
              <div href="#" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-ov-hi kv-ve-al-bo kv-te-ov-el">Harmonyville.net</div>

              <label class="kv-po-re">
                <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in ">+</span>
                <input class="kv-di-no kv-sibling-di-bl" type="checkbox" name="checkbox" value="value">
                <div class="kv-bg-wh kv-wh-sp-no kv-di-no kv-po-ab kv-to-100-per kv-ri-0 kv-z-in-1 kv-sibling-di-bl-sib " style="">
                  <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh  ">
                    <div class="">
                      <span>📁</span>
                      <input class="kv-bo-bl kv-fo-in kv-bo-si-in kv-pa-2 kv-di-in kv-wi-150 "  type="text" name="name">
                      <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-but-sty-res kv-di-in" name="create" value="1">+</button>
                    </div>
                  </div>
                </div>
              </label>
            </div>

              <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
              <?php
              foreach ($PostList as $key => $value) {
                  ?>
                <li>
                  <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in  ">
                    <div class="kv-di-in">📁</div>
                    <label style="">
                      <input class="kv-di-no kv-sibling-di-in kv-sibling-di-no" type="checkbox" name="checkbox" value="value">
                      <input class="kv-bo-bl kv-fo-in kv-bo-si-in kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-in-sib kv-di-no" type="text" name="" value="">
                      <a href="{{$value['url']}}" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-no-sib kv-ov-hi kv-ve-al-bo kv-te-ov-el ">{{$key}}</a>
                      <span class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-di-in kv-sibling-di-no-sib">⚙</span>
                    </label>
                    <input class=""  style="display:none;" type="text" name="" value="">
                    <input class=""  style="display:none;" type="text" name="" value="">
                    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-but-sty-res kv-di-in" name="" value="update">✓</button>
                    <button type="submit" class="kv-fo-we-bo kv-wi-20 kv-te-al-ce kv-but-sty-res kv-di-in" name="Destroy" value="1">×</button>

                  </div>
                </li>
                <?php
              }
              ?>

            </ul>
          </li>
        </ul>

    </form>

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
