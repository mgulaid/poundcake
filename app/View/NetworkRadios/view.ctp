<?php
//    echo "<pre>";
//    print_r($networkradio);
//    echo "</pre>";
?>

<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->MyHTML->linkIfAllowed(__('Edit Radio'), array('action' => 'edit', $networkradio['NetworkRadio']['id']))?></li>
        <li><?php echo $this->Html->link(__('List Radios'), array('action' => 'index')); ?></li>
        <li><?php echo $this->MyHTML->postLinkIfAllowed(__('Delete'), array('action' => 'delete', $networkradio['NetworkRadio']['id']), null, __('Are you sure you want to delete radio %s?', $networkradio['NetworkRadio']['name'])); ?></li>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->
<div class="span9">
    <h2>View Radio</h2>
    <?php
//    echo "<pre>";
//    print_r( $networkradio );
//    echo "</pre>";
    ?>
    <P><B>Name:</B>&nbsp;<?php echo $networkradio['NetworkRadio']['name']; ?></P>
    <P><B>Site:</B>&nbsp;<?php echo $networkradio['Site']['site_name']; ?></P>
    <P><B>Serial No:</B>&nbsp;<?php echo $networkradio['NetworkRadio']['serial']; ?></P>
    <P><B>Sector:</B>&nbsp;<?php echo ($networkradio['NetworkRadio']['sector'] > 0 ? "Yes" : "No"); ?>
    <P><B>Radio Type:</B>&nbsp;<?php echo $networkradio['RadioType']['name']; ?></P>
    <P><B>Antenna:</B>&nbsp;<?php echo $networkradio['AntennaType']['name']; ?></P>
    <P><B>Radio Mode:</B>&nbsp;
        <?php echo $networkradio['RadioMode']['name'];
        if ($networkradio['NetworkRadio']['sector'] = 0)
            echo '<BR><I>Radio Mode for '.$links[0]['network_radios']['name'].': '.$links[0]['radio_modes']['radio_mode_name'] . '</I>';        
    ?></P>    
    <?php
        // if this is a sector radio, show the true/mag azimuth values from the database
        if ($networkradio['NetworkRadio']['sector'] > 0) {
            echo '<P><B>True Azimuth:</B>&nbsp;';
            echo sprintf("%01.2f",$networkradio['NetworkRadio']['true_azimuth']).'°';
            echo '</P>';
            echo '<P><B>Magnetic Azimuth:</B>&nbsp;';
            echo sprintf("%01.2f",$networkradio['NetworkRadio']['mag_azimuth']).'°';
            echo '</P>';
        }
    ?>
    <P><B>Elevation:</B>&nbsp;<?php
        if (isset($networkradio['NetworkRadio']['elevation']))
            echo $networkradio['NetworkRadio']['elevation'].'°';
    ?>
    </P>
    <P><B>Min. Height (meters):</B>&nbsp;<?php echo $networkradio['NetworkRadio']['min_height']; ?></P>
    <P><B>Frequency:</B>&nbsp;
        <?php echo $networkradio['NetworkRadio']['frequency'];
        if ($networkradio['NetworkRadio']['sector'] = 0)
            echo '<BR><I>Frequency for '.$links[0]['network_radios']['name'].': '.$links[0]['network_radios']['frequency'] . '</I>';
        ?></P>
    <P><B>SSID:</B>&nbsp;
        <?php echo $networkradio['NetworkRadio']['ssid'];
        if ($networkradio['NetworkRadio']['sector'] = 0)
            echo '<BR><I>SSID for '.$links[0]['network_radios']['name'].': '.$links[0]['network_radios']['ssid'] . '</I>';
        ?></P>
    <P><B>Switch:</B>&nbsp;<?php echo $networkradio['NetworkSwitch']['name']; ?></P>
    <P><B>Switch Port:</B>&nbsp;<?php echo $networkradio['NetworkRadio']['switch_port']; ?></P>
    <?php 
//    echo '<pre>';
//    print_r($networkradio);
//    echo '</pre>';
    ?>
    <P><B>Link Information:</B>&nbsp;
        <?php foreach ($links as $link) { ?>
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>Radio Name</th>
                <th>Distance</th>
                <th>True Azimuth</td>
                <th>Magnetic Azimuth</td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->MyHtml->linkIfAllowed(
                            $link['network_radios']['name'],
                            array('action' => 'view',
                                $link['radios_radios']['dest_radio_id']
                                )
                            );
                    ?>
                </td>
                <td>
                    <?php echo sprintf("%01.2f",$link['network_radios']['link_distance']) .' Km'; ?>
                </td>
                <td>
                    <?php echo sprintf("%01.2f",$link['network_radios']['true_azimuth']) . '° to ' . $link['network_radios']['name']; ?>
                </td>
                <td>
                   <?php echo sprintf("%01.2f",$link['network_radios']['mag_azimuth']) . '° to ' . $link['network_radios']['name']; ?>
                </td>
            </tr>
        </table>
    <?php } ?>
    <?php echo $this->element('Common/addrpool_data'); ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->


