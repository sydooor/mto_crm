<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo $header; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1><?php echo $title; ?></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title; ?></li>
            </ol>
            </div>
            <div class="col-lg-6">
            	<h1><?php echo $error;?></h1>
          </div>
        </div>
<?php echo $footer; ?>