<html>


    <body>

        <?php

        include('DeliveryData.php');
        include('DummyDataCreator.php');

        // at this stage $data will contain  the data required
        //
        // just to test output the contents of data which should be an array of objects

        $data  = json_encode($data);
        $data = json_decode($data, true);
        $msgBatches = $data;

        foreach ($data as $key => $value) {
          $msgSources[$key] = $value['source'];
        }
        $msgSources = array_count_values($msgSources);

        foreach ($data as $key => $value) {
          $msgDestis[$key] = $value['destination'];
        }
        $msgDestis = array_count_values($msgDestis);


        foreach ($msgSources as $msgSourceKey => $msgSource) {
          foreach ($msgDestis as $msgDestiKey => $msgDesti) {
            $msgStats[$msgSourceKey][$msgDestiKey] = 0;
            foreach ($msgBatches as $msgBatchKey => $msgBatch) {
              if ($msgBatch['destination']==$msgDestiKey & $msgBatch['source']==$msgSourceKey) {
                $msgStats[$msgSourceKey][$msgDestiKey] = $msgStats[$msgSourceKey][$msgDestiKey] + $msgBatch['number'];
              }
            }
          }
        }
        // echo '<pre>';
        // print_r($msgBatches);
        // echo '</pre>';



        ?>


        <h1>Delivery Data</h1>
        <table>
            <!-- todo -->

            <tr>
              <th></th>
              <?php
              foreach ($msgDestis as $key => $value) {
                ?>
                <th><?php echo $key; ?> (dest.)</th>
                <?php
                // code...
              }
              ?>
            </tr>
            <?php
            foreach ($msgStats as $key => $msgStat) {
              ?>
              <tr>
                <th><?php echo $key ?> (src.)</th>
                <?php
                foreach ($msgStat as $key => $msgStatValue) {
                  ?>
                  <td><?php echo $msgStatValue ?></td>
                  <?php
                }
                ?>


              </tr>
              <?php
            }
            ?>
        </table>
    </body>
</html>
