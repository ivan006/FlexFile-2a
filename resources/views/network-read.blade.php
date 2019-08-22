@include('includes.base-dom/general-include-one-of-four')


<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">


@include('includes.base-dom/general-include-two-of-four')






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
      Welcome to Harmonyville.
    </p>
    <ul>
      <li>
        To view content just select a group from the list below.
      </li>



      <li>
        To edit the group go to the group and from there click "mode", at the top, and select "edit".
      </li>
      <li>
        To add a group from here click "mode", at the top, and select "edit" then click "create" etc...
      </li>

    </ul>


    <br>

  </div>
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>
      Groups

    </h2>

    <div class="f-treeview">
      <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
        <li>
          <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in  ">
            <div class="kv-di-in">📁</div>
            <div href="#" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-ov-hi kv-ve-al-bo kv-te-ov-el">Harmonyville.net</div>


          </div>
          <ul class="kv-li-st-no kv-pa-le-0 kv-child-pa-le-40">
            <?php
            foreach ($PostList as $key => $value) {
              ?>

            <li>
              <div class="kv-bo-gr kv-bo-ra-3 kv-pad-1-4 kv-mar-bot-3 kv-bg-wh kv-wh-sp-no kv-di-in  ">
                <div class="kv-di-in">📁</div>
                <a href="{{$value['url']}}" class="kv-bo-tr kv-pa-2 kv-di-in kv-wi-150 kv-sibling-di-no-sib kv-ov-hi kv-ve-al-bo kv-te-ov-el ">{{$key}}</a>


              </div>
            </li>
              <?php
            }
            ?>

          </ul>
        </li>
      </ul>
    </div>

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
