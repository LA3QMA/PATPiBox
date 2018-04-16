<?php
include_once( 'includes/status_messages.php' );

function DisplayPATConfig(){

$json_data = ReadPATConfig();

  $status = new StatusMessages();

  $arrAuxiliary = $json_data['auxiliary_addresses'];
  $arrAuxiliary2 = implode("", $json_data['auxiliary_addresses']);

  $arrMotd   = $json_data['motd'];
  $arrMotd2   = implode("", $json_data['motd']);

  $arrConnectaliases = $json_data['connect_aliases'];
  $arrConnectaliases2 = implode("", $json_data['connect_aliases']);

  $arrListen = $json_data['listen'];
  $arrListen2 = implode("", $json_data['listen']);

  $arrHamlib = $json_data['hamlib_rigs'];
  $arrHamlib2 = implode("", $json_data['hamlib_rigs']);

  $arrRig = $json_data['rig'];
  $arrRig2 = implode("", $json_data['rig']);

  $arrAX25 = $json_data['ax25'];

  $arrSchedule = $json_data['schedule'];
  $arrSchedule2 = implode("", $json_data['schedule']);

  if( isset($_POST['WritePATConfig']) ) {
    if (CSRFValidate()) {
      WritePATConfig($arrMotd, $arrConnectaliases, $arrListen, $arrHamlib, $arrSchedule, $json_data[]);
    } else {
      error_log('CSRF violation');
    }
  } elseif( isset($_POST['StartPAT']) ) {
    if (CSRFValidate()) {
      $status->addMessage('Attempting to start PAT', 'info');

//
      foreach( $return as $line ) {
        $status->addMessage($line, 'info');
      }
    } else {
      error_log('CSRF violation');
    }
  } elseif( isset($_POST['StopPAT']) ) {
    if (CSRFValidate()) {
      $status->addMessage('Attempting to stop PAT', 'info');
//
      foreach( $return as $line ) {
        $status->addMessage($line, 'info');
      }
    } else {
      error_log('CSRF violation');
    }
  } elseif (isset($_POST['deletemotd'])) {
    // $_POST['MOTD']
    $status->addMessage('MOTD line deleted:' , 'info');
//    unset($json_data['motd'][1]);
  }

//
  if( $patstatus[0] == 0 ) {
    $status->addMessage('PAT is not running', 'warning');
  } else {
    $status->addMessage('PAT is running', 'success');
  }
  foreach( $return as $a ) {
    if( $a[0] != "#" ) {
      $arrLine = explode( "=",$a) ;
      $arrConfig[$arrLine[0]]=$arrLine[1];
    }
  };
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-dot-circle-o fa-fw"></i> Configure PAT</div>
        <!-- /.panel-heading -->
        <div class="panel-body">
    <p><?php $status->showMessages(); ?></p>
          <form role="form" action="?page=pat_conf" method="POST">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
              <li><a href="#connectaliases" data-toggle="tab">Connect aliases</a></li>
              <li><a href="#listen" data-toggle="tab">Listen</a></li>
              <li><a href="#hamlib" data-toggle="tab">hamlib</a></li>
              <li><a href="#ax25" data-toggle="tab">AX25</a></li>
              <li><a href="#rig" data-toggle="tab">Rig</a></li>
              <li><a href="#serialtnc" data-toggle="tab">Serial TNC</a></li>
              <li><a href="#winmor" data-toggle="tab">WINMOR</a></li>
              <li><a href="#ardop" data-toggle="tab">ARDOP</a></li>
              <li><a href="#telnet" data-toggle="tab">telnet</a></li>
              <li><a href="#gpsd" data-toggle="tab">GPSD</a></li>
              <li><a href="#schedule" data-toggle="tab">Schedule</a></li>

              <li><a href="#advanced" data-toggle="tab">Advanced</a></li>
              <li><a href="#logoutput" data-toggle="tab">Logfile Output</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="basic">
                <h4>Basic settings</h4>
                <?php CSRFToken() ?>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Mycall</label>
                    <input type="text" class="form-control" name="mycall" value="<?php echo $json_data['mycall']; ?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Secure login password</label>
                    <input type="password" class="form-control" name="secure_login_password" value="<?php echo $json_data['secure_login_password']; ?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Auxiliary addresses</label>
                    <?php SelectorOptions('AuxiliaryAddresses', $arrAuxiliary, $arrAuxiliary2); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Locator</label>
                    <input type="text" class="form-control" name="locator" value="<?php echo $json_data['locator']; ?>" />
                  </div>
                </div>                
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">HTTP Addr</label>
                    <input type="text" class="form-control" name="httpaddr" value="<?php echo $json_data['http_addr']; ?>" />
                  </div>
                </div>                
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">MOTD</label>
                    <?php SelectorOptions('MOTD', $arrMotd, $arrMotd2); ?>
                  </div>
                  <input type="submit" class="btn btn-warning" name="deletemotd" value="Delete selected MOTD" />
<?php
foreach ( $json_data['motd'] as $opt => $label) {
    $key = isAssoc($options) ? $opt : $label;
    echo '<br>' . $key . ' __ '. $label . '<br>';
}
?>                  
                </div>
              </div>
              <div class="tab-pane fade" id="connectaliases">
                <h4>Connect aliases</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Connect aliases</label>
                    <?php SelectorOptionsPAT('ConnectAliases', $arrConnectaliases, $arrConnectaliases2); ?><br>
                    <input type="submit" class="btn btn-warning" name="deletealias" value="Delete selected alias" />
<?php
foreach ( $json_data['connect_aliases'] as $opt => $label) {
    $key = isAssoc($options) ? $opt : $label;
//    echo '<br>' . $key . ' __ '. $label . '<br>';
}
?>

              </div>               


                <div class="form-group col-md-4">
                    <label for="code">Add alias</label>
                    <input type="text" class="form-control" name="addalias" value="" />                              
                 <input type="submit" class="btn btn-success" name="addaliasbtn" value="Add alias" />
              </div>
            </div>
            </div>
              <div class="tab-pane fade" id="listen">
                <h4>Listen</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Listen</label>
                    <?php SelectorOptions('', $arrListen, $arrListen2); ?>
<?php
foreach ( $json_data['listen'] as $opt => $label) {
    $key = isAssoc($options) ? $opt : $label;
    echo '<br>' . $key . ' __ '. $label . '<br>';
}
?> 
                  </div>                
                </div>
              </div>
              <div class="tab-pane fade" id="hamlib">
                <h4>hamlib</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">hamlib</label>
<?php
  echo "<select class=\"form-control\" name=\"$name\">";
  foreach ( $arrHamlib as $opt => $label) {
    $select = '';
    $key = isAssoc($options) ? $opt : $label;
    if( $key == $selected ) {
      $select = " selected";
    }
    $address = $json_data['hamlib_rigs'][$key]['address'];
    $network = $json_data['hamlib_rigs'][$key]['network'];

    echo "<option value=\"$key\"$select>$key: $address - $network</options>";
  }
  echo "</select>";?>
  <?php
foreach ( $json_data['listen'] as $opt => $label) {
    $key = isAssoc($options) ? $opt : $label;
    echo '<br>' . $key . ' __ '. $label . '<br>';
}
?> 

                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="ax25">
                <h4>AX25</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Port</label>
                    <input type="text" class="form-control" name="ax25_port" value="<?php echo $json_data['ax25']['port']; ?>" />                   
                    <label for="code">Beacon every</label>
                    <input type="text" class="form-control" name="ax25_beacon_every" value="<?php echo $json_data['ax25']['beacon']['every']; ?>" />                   
                    <label for="code">Beacon message</label>
                    <input type="text" class="form-control" name="ax25_beacon_message" value="<?php echo $json_data['ax25']['beacon']['message']; ?>" />                   
                    <label for="code">Beacon destination</label>
                    <input type="text" class="form-control" name="ax25_beacon_destination" value="<?php echo $json_data['ax25']['beacon']['destination']; ?>" />                   
                    <label for="code">ax25</label>
<?php
  $name = 'ax25rig';
  echo "<select class=\"form-control\" name=\"$name\">";
    $address = $json_data['ax25']['rig'];
    echo "<option value=\"$address\"$select>$address</options>";
    echo "</select>";
?>                    
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="rig">
                <h4>Rig</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Rig</label>
                    <input type="text" class="form-control" name="ax25_rig_port" value="<?php echo $json_data['ax25']['rig']; ?>" />                   
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="serialtnc">
                <h4>Serial TNC</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Path:</label>
                    <input type="text" class="form-control" name="serialtnc_path" value="<?php echo $json_data['serial-tnc']['path']; ?>" />                   
                    <label for="code">Baudrate</label>
                    <input type="text" class="form-control" name="serialtnc_baud" value="<?php echo $json_data['serial-tnc']['baudrate']; ?>" />                   
                    <label for="code">Type</label>
                    <input type="text" class="form-control" name="serialtnc_type" value="<?php echo $json_data['serial-tnc']['type']; ?>" />                   
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="winmor">
                <h4>WINMOR</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Addr:</label>
                    <input type="text" class="form-control" name="winmor_path" value="<?php echo $json_data['winmor']['addr']; ?>" />                   
                    <label for="code">inbound_bandwidth</label>
                    <input type="text" class="form-control" name="winmor_inbound_bandwidth" value="<?php echo $json_data['winmor']['inbound_bandwidth']; ?>" />                   
                    <label for="code">drive_level</label>
                    <input type="text" class="form-control" name="winmor_drive_level" value="<?php echo $json_data['winmor']['drive_level']; ?>" />                   
                    <label for="code">rig</label>
                    <input type="text" class="form-control" name="winmor_rig" value="<?php echo $json_data['winmor']['rig']; ?>" />                   
                    <label for="code">ptt_ctrl</label>
                    <input type="text" class="form-control" name="winmor_ptt_ctrl" value="<?php echo $json_data['winmor']['ptt_ctrl']; ?>" />                   
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="ardop">
                <h4>WINMOR</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Addr:</label>
                    <input type="text" class="form-control" name="ardop_path" value="<?php echo $json_data['ardop']['addr']; ?>" />                   
                    <label for="code">arq_bandwidth</label>
                    <input type="text" class="form-control" name="ardop_arq_bandwidth" value="<?php echo $json_data['ardop']['arq_bandwidth']['Forced']; ?>" />                   
                    <label for="code">max</label>
                    <input type="text" class="form-control" name="ardop_arq_max" value="<?php echo $json_data['ardop']['arq_bandwidth']['Max']; ?>" />                   
                    <label for="code">rig</label>
                    <input type="text" class="form-control" name="ardop_rig" value="<?php echo $json_data['ardop']['rig']; ?>" />                   
                    <label for="code">ptt_ctrl</label>
                    <input type="text" class="form-control" name="ardop_ptt_ctrl" value="<?php echo $json_data['ardop']['ptt_ctrl']; ?>" />                   
                    <label for="code">beacon_interval</label>
                    <input type="text" class="form-control" name="ardop_beacon_interval" value="<?php echo $json_data['ardop']['beacon_interval']; ?>" />                   
                    <label for="code">cwid_enabled</label>
                    <input type="text" class="form-control" name="ardop_cwid_enabled" value="<?php echo $json_data['ardop']['cwid_enabled']; ?>" />                   
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="telnet">
                <h4>telnet</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">telnet</label>
                    <input type="text" class="form-control" name="telnet_listen_addr" value="<?php echo $json_data['telnet']['listen_addr']; ?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">Password</label>
                    <input type="text" class="form-control" name="telnet_password" value="<?php echo $json_data['telnet']['password']; ?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="gpsd">
                <h4>GPSD</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">gpsd</label>
                    <input type="text" class="form-control" name="gpsd" value="<?php echo $json_data['gpsd_addr']; ?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="schedule">
                <h4>Schedule</h4>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="code">schedule</label>
                    <?php SelectorOptions('', $arrSchedule, $arrSchedule2); ?>
                    <label for="code">version_reporting_disabled</label>
                    <input type="text" class="form-control" name="schedule" value="<?php echo $json_data['version_reporting_disabled']; ?>" />

                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="logoutput">
                <h4>Logfile output</h4>
                  <div class="row">
                    <div class="form-group col-md-8">
                      <?php
                          if($arrHostapdConf['LogEnable'] == 1) {
                              $log = file_get_contents('/tmp/hostapd.log');
                              echo '<br /><textarea class="logoutput">'.$log.'</textarea>';
                          } else {
                              echo "<br />Logfile output not enabled";
                          }
                      ?>
                   </div>
                </div>
              </div>
              <div class="tab-pane fade" id="advanced">
                <h4>Advanced settings</h4>
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-check">
                    <label class="form-check-label">
                        Enable Logging <?php $checked = ''; if($arrHostapdConf['LogEnable'] == 1) { $checked = 'checked'; } ?>
                        <input id="logEnable" name ="logEnable" type="checkbox" class="form-check-input" value="1" <?php echo $checked; ?> />
                    </label>
                  </div>
                  </div>
                </div>
              </div><!-- /.panel-body -->
            </div><!-- /.panel-primary -->
            <input type="submit" class="btn btn-outline btn-primary" name="WritePATConfig" value="Save settings" />
            <?php
              if($patstatus[0] == 0) {
                echo '<input type="submit" class="btn btn-success" name="StartPAT" value="Start PAT" />';
              } else {
                echo '<input type="submit" class="btn btn-warning" name="StopPAT" value="Stop PAT" />';
              };
            ?>           
          </form>
        </div></div><!-- /.panel-primary -->
      <div class="panel-footer"> Information </div>
    </div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
<?php 
}

function ReadPATConfig() {

if ($file = fopen("/etc/patpibox/user.cfg", "r")) {
        $line = fgets($file);
	$line = str_replace(array("\t", "\n", "\r"),'',$line);
	$path = "/home/" . $line . "/.wl2k/config.json";
    	fclose($file);
	$jsondata = json_decode(file_get_contents($path), true, 512, JSON_UNESCAPED_UNICODE);
	return $jsondata;
}

}

function WritePATConfig() {

if ($file = fopen("/etc/patpibox/user.cfg", "+w")) {
        $line = fgets($file);
        $line = str_replace(array("\t", "\n", "\r"),'',$line);
        $path = "/home/" . $line . "/.wl2k/config.json";

  $json_data['mycall'] = $_POST['mycall'];
  $json_data['secure_login_password'] = $_POST['secure_login_password'];
  $json_data['auxiliary_addresses'] = array();
  $json_data['locator'] = $_POST['locator'];
  $json_data['http_addr'] = $_POST['httpaddr'];
  $json_data['motd'] = $arrMotd2;

//  $json_data['connect_aliases'] = $_POST['connect_aliases']['telnet'];

//  $json_data['connect_aliases'] = $arrConnectaliases2;
  $json_data['listen'] = '';
  $json_data['hamlib'] = '';
  $json_data['ax25']['port'] = $_POST['ax25_port'];
  $json_data['ax25']['beacon']['every'] = $_POST['ax25_beacon_every'];
  $json_data['ax25']['beacon']['message'] = $_POST['ax25_beacon_message'];
  $json_data['ax25']['beacon']['destination'] = $_POST['ax25_beacon_destination'];
  $json_data['ax25']['rig'] = $_POST['ax25_rig_port'];
  $json_data['serial-tnc']['path'] = $_POST['serialtnc_path'];
  $json_data['serial-tnc']['baudrate'] = $_POST['serialtnc_baud'];
  $json_data['serial-tnc']['type'] = $_POST['serialtnc_type'];
  $json_data['winmor']['addr'] = $_POST['winmor_path'];
  $json_data['winmor']['inbound_bandwidth'] = $_POST['winmor_inbound_bandwidth'];
  $json_data['winmor']['drive_level'] = $_POST['winmor_drive_level'];
  $json_data['winmor']['rig'] = $_POST['winmor_rig'];
  $json_data['winmor']['ptt_ctrl'] = $_POST['winmor_ptt_ctrl'];
  $json_data['ardop']['addr'] = $_POST['ardop_path'];
  $json_data['ardop']['arq_bandwidth']['Forced'] = $_POST['ardop_arq_bandwidth'];
  $json_data['ardop']['arq_bandwidth']['Max'] = $_POST['ardop_arq_max'];
  $json_data['ardop']['rig'] = $_POST['ardop_rig'];
  $json_data['ardop']['ptt_ctrl'] = $_POST['ardop_ptt_ctrl'];
  $json_data['ardop']['beacon_interval'] = $_POST['ardop_beacon_interval'];
  $json_data['ardop']['cwid_enabled'] = $_POST['ardop_cwid_enabled'];
  $json_data['telnet']['listen_addr'] = $_POST['telnet_listen_addr'];
  $json_data['telnet']['password'] = $_POST['telnet_password'];
  $json_data['gpsd_addr'] = $_POST['gpsd'];
  $json_data['version_reporting_disabled'] = $_POST['schedule'];

//  $json_data[''] = $_POST[''];

  $new_json_data = json_encode($json_data);
  file_put_contents($path, $new_json_data);
echo $path;
  fclose($file);
}
}

?>

