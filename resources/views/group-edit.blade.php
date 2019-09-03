@include('includes.base-dom/1-title-links')
<link href="{{ asset('css/key-value-list.css') }}" rel="stylesheet">


@include('includes.menu_report')
@include('includes.base-dom/2-wrap-div')


<div class="w3-col m4">

  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <h2>Reports</h2>
    <form  enctype="multipart/form-data" name="1" class="" action="{{ $allURLs['sub_report_store'] }}" method="post">
      <input class="g-bor-gre"  style="display: none;" type="text" name="form" value="reports">
      {{csrf_field()}}
      <div class="">
        <?php echo $ReportShowMultiStyledForEdit; ?>
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
        <?php echo $DataShowMultiStyledForEdit; ?>
      </div>
    </form>

  </div>

  <br>

  <!-- End Middle Column -->
</div>





@include('includes.base-dom/3-wrap-div-script')
