@include('includes.base-dom/general-include-one-of-four')
<link href="{{ asset('css/key-value-list.css') }}" rel="stylesheet">
@include('includes.base-dom/general-include-two-of-four')
@include('includes.menu_report')
@include('includes.base-dom/general-include-three-of-four')

<!-- Left Column -->
<div class="w3-col m2">
  <br>
  <!-- End Left Column -->
</div>

<!-- Middle Column -->
<div class="w3-col m8">
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

    <h2>
      Help

    </h2>
    <h3>Overview</h3>
    <ul>
      <li>Shortcodes
        <ul>
          <li>Group Menu</li>
          <li>Getter</li>
          <li>Foreach</li>
        </ul>
      </li>
    </ul>
    <h3>Shortcodes</h3>
    <h4>Group Menu</h4>
    <p>
      Group Menu shortcode is shown below.
    </p>
    <xmp>

      <div class="f-multi-level-dropdown">
        <ul>
          [page_list]
          [twig]
          <li>
            <a href="[link]">
              [name]
            </a>
            <span class="toggle">
              <a href="#">+</a>
              <ul>
                [inner_twig]
              </ul>
            </span>
          </li>
          [/twig]
          [leaf]
          <li>
            <a href="[link]">
              [name]
            </a>
          </li>
          [/leaf]
          [/page_list]
        </ul>
      </div>
    </xmp>

    <h4>Getter</h4>
    <p>
      Getter shortcode is shown below.
    </p>
    <xmp>
      [g]code/w3.css[/g]
    </xmp>
    <h4>Foreach</h4>
    <p>
      Foreach shortcode is shown below.
    </p>
    <xmp>
      <ul>
        [s type=`foreach` var=`[g type=`foreach`]Book/Chapter 1[/g]` level=`1`]
        <li><b>Dialogue set</b>
          <ul>
            <li>
              <b>Neale:</b> [g type=`foreach`]Neale[/g]
            </li>
            <li>
              <b>God:</b> [g type=`foreach`]God[/g]
            </li>
          </ul>
        </li>
        [/s type=`foreach` var=`[g type=`foreach`]Book/Chapter 1[/g]` level=`1`]
      </ul>
    </xmp>


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
