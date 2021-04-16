<script>
  $('.main-carousel').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    autoPlay: true
  });
</script>
<div class="container" id="content">
  <div class="row">
    <div class="col-12">
      <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
        <?php include('charts.php'); ?>
      </div>
    </div>
    <?php
    error_reporting(0);
    $json = file_get_contents('json/genres.json');
    $data = json_decode($json);
    foreach ($data->data as $mydata) {
      echo '
      <div class="col-4">
        <div class="card ' . $mydata->color . '-box">
          <div class="card-body">
            <h5 class="bold">' . $mydata->attributes->name . '</h6>
        </div>
      </div>
      </div>      
      ';
    }
    ?>
  </div>
</div>