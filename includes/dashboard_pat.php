<?php
/**
*
*
*/
function DisplayDashboardPAT(){
  $status = new StatusMessages();

  $return = "DOWN";

  $strPAT = $return;
  $strARDOP = $return;

  $strLinkQuality = "33";

  if(strpos( $strPAT, "UP" ) !== false) {
    $status->addMessage('PAT is running', 'success');
    $PATup = true;
  } else {
    $status->addMessage('PAT is not running', 'warning');
  }

  if(strpos( $strARDOP, "UP" ) !== false) {
    $status->addMessage('ARDOP is running', 'success');
    $ARDOPup = true;
  } else {
    $status->addMessage('ARDOP is not running', 'warning');
  }

  if( isset($_POST['stop_pat']) ) {
    //
    if($test[0] == 1) {
    //
    } else {
      echo 'PAT already down';
    }
  } elseif( isset($_POST['start_pat']) ) {
    //
    if($test[0] == 0) {
    //
    //
    } else {
      echo 'PAT already running';
    }
  }
  ?>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">6</div>
                                    <div>New messages</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">3</div>
                                    <div>Message(s) not delivered</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-dashboard fa-fw"></i> Dashboard   </div>
              <div class="panel-body">
                <p><?php $status->showMessages(); ?></p>
                  <div class="row">
                        <div class="col-md-6">
                        <div class="panel panel-default">
                  <div class="panel-body">

                      <h4>Interface Information</h4>
          <div class="info-item">Interface Name</div> <?php echo PAT_CLIENT_INTERFACE ?></br>

        </div><!-- /.panel-body -->
        </div><!-- /.panel-default -->
                        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
                    <div class="panel panel-default">
              <div class="panel-body wireless">
                            <h4>Other Information</h4>
          <div class="info-item">Connected To</div>   <?php echo 'LA1B-10' ?></br>
          <div class="info-item">Signal Level</div>        <?php echo '12' ?></br>
          <div class="info-item">Transmit Power</div> <?php echo '5W' ?></br>
          <div class="info-item">Frequency</div>      <?php echo '145.525MHz' ?></br></br>
          <div class="info-item">Link Quality</div>
            <div class="progress">
            <div class="progress-bar progress-bar-info progress-bar-striped active"
              role="progressbar"
              aria-valuenow="<?php echo $strLinkQuality ?>" aria-valuemin="0" aria-valuemax="100"
              style="width: <?php echo $strLinkQuality ?>%;"><?php echo $strLinkQuality ?>%
            </div>
          </div>
        </div><!-- /.panel-body -->
        </div><!-- /.panel-default -->
                        </div><!-- /.col-md-6 -->
      </div><!-- /.row -->

                  <div class="col-lg-12">
                 <div class="row">
                    <form action="?page=pat_info" method="POST">
                    <?php if ( !$PATup ) {
                      echo '<input type="submit" class="btn btn-success" value="Start ' . PAT_WEB_INTERFACE . '" name="start_pat" />';
                    } else {
                echo '<input type="submit" class="btn btn-warning" value="Stop ' . PAT_WEB_INTERFACE . '" name="stop_pat" />';
              }
              ?>
              <input type="button" class="btn btn-outline btn-primary" value="Refresh" onclick="document.location.reload(true)" />
              </form>
            </div>
              </div>

                </div><!-- /.panel-body -->
                <div class="panel-footer">Information </div>
            </div><!-- /.panel-default -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
  <?php
}
?>
