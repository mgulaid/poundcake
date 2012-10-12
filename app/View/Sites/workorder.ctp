<?php
/**
 * Include the required Class file
 */
//include('ExcelWriterXML.php');
App::import('Vendor','ExcelWriterXML/ExcelWriterXML');


/**
 * Create a new instance of the Excel Writer
 */

$filename = 'Work Order '.$site['Site']['site_vf'].'.xml';

$xml = new ExcelWriterXML( $filename );

/**
 * Add some general properties to the document
 */
$xml->docTitle('Inveneo Work Order');
$xml->docAuthor('Tower DB');
$xml->docCompany('Inveneo');
$xml->docManager('');

/**
 * Choose to show any formatting/input errors on a seperate sheet
 */
$xml->showErrorSheet(true);

/**
 * Show the style options
 */
$fmt1 = $xml->addStyle('format1-header');
$fmt1->alignHorizontal('Left');
$fmt1->fontSize('24');

$fmt2 = $xml->addStyle('format2');
$fmt2->alignHorizontal('Left');
$fmt2->fontSize('12');
$fmt2->fontBold();

$fmt3 = $xml->addStyle('format3');
$fmt3->alignHorizontal('Right');
$fmt3->fontSize('12');
$fmt3->fontBold();

$fmt4 = $xml->addStyle('value');
$fmt4->alignHorizontal('Left');
$fmt4->fontSize('12');
$fmt4->alignWraptext();

$fmt5 = $xml->addStyle('border');
$fmt5->border('Bottom',2,'Black','Continuous');

// Excel color picker:
// http://dmcritchie.mvps.org/excel/colors.htm#colorindex
$fmtBanner = $xml->addStyle('banner');
$fmtBanner->bgColor('#000000');
$fmtBanner->fontColor('#FFFFFF');
//$fmtBanner->bgColor('#BEBEBE');
$fmtBanner->alignHorizontal('Center');
$fmtBanner->alignVertical('Center');
$fmtBanner->fontBold();
$fmtBanner->fontSize('16');
$fmtBannerHeight = 25;

// Create a new sheet with the XML document
//$sheet1 = $xml->addSheet('Work Order '.$site['Site']['site_vf']);
$sheet1 = $xml->addSheet('Work Order '.$site['Site']['site_code']);


$row = 1;
$sheet1->writeString($row,1,'Inveneo Site Install Work Order',$fmt1);
$sheet1->columnWidth(1,'150'); // Column A
$sheet1->columnWidth(2,'200'); // Column B
$sheet1->columnWidth(3,'20'); // Column C
$sheet1->columnWidth(4,'150'); // Column D
$sheet1->columnWidth(5,'200'); // Column E

$today = date("D M j G:i:s T Y");
$sheet1->writeString($row,5,'Work Order generated: '.$today,$fmt3);

$row += 2;
// col 1
$sheet1->writeString($row,1,'Install Team',$fmt3);
$sheet1->writeString($row,2,$site['InstallTeam']['name'],$fmt4);
// col 2
$sheet1->writeString($row,4,'GPS Coordinates',$fmt3);
$coordinates = sprintf("%01.5f",$site['Site']['lat']).' '.sprintf("%01.5f",$site['Site']['lon']);
$sheet1->writeString($row,5,$coordinates,$fmt4);
$row++;

// col 1
$sheet1->writeString($row,1,'Install Date',$fmt3);
$date = new DateTime($site['Site']['install_date']);
$sheet1->writeString($row,2,$date->format('Y-m-d'),$fmt4);
// col 2
$sheet1->writeString($row,4,'Tower Mount',$fmt3);
$sheet1->writeString($row,5,$site['TowerMount']['name'],$fmt4);
$row++;

// col 1
$sheet1->writeString($row,1,'Site',$fmt3);
$sheet1->writeString($row,2,$site['Site']['site_vf'],$fmt4);
//$sheet1->writeString($row,2,$site['Site']['site_name'].' ('.$site['Site']['site_name'].')',$fmt4);
// col 2
$sheet1->writeString($row,4,'Tower Type',$fmt3);
$sheet1->writeString($row,5,$site['TowerType']['name'],$fmt4);
$row++;

// col 1
$sheet1->writeString($row,1,'Tower Owner',$fmt3);
$sheet1->writeString($row,2,$site['TowerOwner']['name'],$fmt4);
// col 2
$sheet1->writeString($row,4,'Power Type',$fmt3);
$sheet1->writeString($row,5,$site['PowerType']['name'],$fmt4);
$row++;

// col 1
$sheet1->writeString($row,1,'Tower Guard',$fmt3);
$sheet1->writeString($row,2,$site['Site']['tower_guard'],$fmt4);
// col 2
$sheet1->writeString($row,4,'Tower Member',$fmt3);
$sheet1->writeString($row,5,$site['TowerMember']['name'],$fmt4);
$row++;

// col 1
$sheet1->writeString($row,1,'Technical Contact(s)',$fmt3);
$n = count($towercontacts);
$i = 0;
$c = '';
foreach ($towercontacts as $contact) {
//    echo '<pre>';
//    print_r($contact); 
//    echo '</pre>';
    $c .= $contact['Contact']['name_vf'];
    $c .= ' '.$contact['Contact']['mobile'];
    if ($i < $n-1) {
        $c .= ', ';
    }
    $i++;
}
$sheet1->writeString($row,2,$c,$fmt4);

// col 2
$sheet1->writeString($row,4,'Install Team',$fmt3);
$sheet1->writeString($row,5,$site['InstallTeam']['name'],$fmt4);
$row++;

$sheet1->writeString($row,4,'Equipment Space',$fmt3);
$sheet1->writeString($row,5,$site['EquipmentSpace']['name'],$fmt4);
$row++;

// ****************************************************************************
// Notes
// ****************************************************************************
$row += 2;
$sheet1->writeString($row,1,'NOTES',$fmtBanner);
$sheet1->cellMerge($row,1,4,0);
$sheet1->rowHeight($row,$fmtBannerHeight);
$row += 2;

// Merge (2,1) with 4 columns to the right and 2 rows down
//$sheet1->cellMerge(2,1,4,2);

$sheet1->writeString($row,1,"Description",$fmt3);
$sheet1->writeString($row,2,"Row ".$row." ".$site['Site']['description'],$fmt4);
//$sheet1->writeString($row,2,"Testing",$fmt4);
$sheet1->cellMerge($row,2,3,0);
$row++;

$sheet1->writeString($row,1,"Mounting",$fmt3);
$sheet1->writeString($row,2,$site['Site']['mounting'],$fmt4);
$sheet1->cellMerge($row,2,3,0);
$row++;

$sheet1->writeString($row,1,"Access",$fmt3);
$sheet1->writeString($row,2,$site['Site']['access'],$fmt4);
$sheet1->cellMerge($row,2,3,0);
$row++;

$sheet1->writeString($row,1,"Accommodations",$fmt3);
$sheet1->writeString($row,2,$site['Site']['accommodations'],$fmt4);
$sheet1->cellMerge($row,2,3,0);
$row++;

$sheet1->writeString($row,1,"Notes",$fmt3);
$sheet1->writeString($row,2,$site['Site']['notes'],$fmt4);
$sheet1->cellMerge($row,2,3,0);
$row++;


// ****************************************************************************
// Router
// ****************************************************************************
$row += 2;
$sheet1->writeString($row,1,'ROUTER',$fmtBanner);
$sheet1->cellMerge($row,1,4,0);
$sheet1->rowHeight($row,$fmtBannerHeight);
$row += 2;

$sheet1->writeString($row,1,"Name",$fmt3);
$sheet1->writeString($row,2,$site['NetworkRouter']['name'],$fmt4);
$row++;

$sheet1->writeString($row,1,"Manufacturer",$fmt3);
$sheet1->writeString($row,2,$router['RouterType']['manufacturer'],$fmt4);
$row++;

$sheet1->writeString($row,1,"Model",$fmt3);
$sheet1->writeString($row,2,$router['RouterType']['model'],$fmt4);
$row++;

$sheet1->writeString($row,1,"Connection",$fmt3);
$sheet1->writeString($row,2,'Router port 1 always on switch GB uplink',$fmt4);
$row++;

$sheet1->writeString($row,1,"VLAN2 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN11 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN12 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN13 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN14 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN15 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN16 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN17 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN18 IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"VLAN99 IP",$fmt3);
$row++;

// ****************************************************************************
// Switch
// ****************************************************************************
$row += 2;
$sheet1->writeString($row,1,'SWITCH',$fmtBanner);
$sheet1->cellMerge($row,1,4,0);
$sheet1->rowHeight($row,$fmtBannerHeight);
$row += 2;

$sheet1->writeString($row,1,'Name',$fmt3);
$sheet1->writeString($row,2,$switch['SwitchType']['name'],$fmt4);
$row++;

$sheet1->writeString($row,1,'Manufacturer',$fmt3);
$sheet1->writeString($row,2,$switch['SwitchType']['manufacturer'],$fmt4);
$row++;

$sheet1->writeString($row,1,'Model',$fmt3);
$sheet1->writeString($row,2,$switch['SwitchType']['model'],$fmt4);
$row++;

$sheet1->writeString($row,1,'Ports',$fmt3);
$sheet1->writeString($row,2,$switch['SwitchType']['ports'],$fmt4);
$row++;

$sheet1->writeString($row,1,"Power",$fmt3);
$row++;

$sheet1->writeString($row,1,"Remote Mgmt. IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"Remote Mgmt. VLAN",$fmt3);
$row++;

$sheet1->writeString($row,1,"Local Mgmt. IP",$fmt3);
$row++;

$sheet1->writeString($row,1,"Local Mgmt. VLAN",$fmt3);
$row++;

$sheet1->writeString($row,1,"Local Mgmt. Port",$fmt3);
$row++;

$sheet1->writeString($row,1,"Mgmt. Gateway",$fmt3);
$row++;

$sheet1->writeString($row,1,"Bridged Ports",$fmt3);
$row++;


// ****************************************************************************
// Radios
// ****************************************************************************
$row += 2;
$sheet1->writeString($row,1,'RADIOS',$fmtBanner);
$sheet1->cellMerge($row,1,4,0);
$sheet1->rowHeight($row,$fmtBannerHeight);
$row += 2;

foreach ($radios as $radio) {
    $sheet1->writeString($row,1,'Name',$fmt3);
    $sheet1->writeString($row,2,$radio['NetworkRadios']['name'],$fmt4);
    $sheet1->writeString($row,4,'Min. Height (meters)',$fmt3);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['min_height'],$fmt4);
    $row++;
    
    $sheet1->writeString($row,1,'Radio Type',$fmt3);
    $sheet1->writeString($row,2,$radio['RadioType']['name'],$fmt4);
    $sheet1->writeString($row,4,'Frequency',$fmt3);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['frequency'],$fmt4);
    $row++;
    
    $sheet1->writeString($row,1,'Antenna Type',$fmt3);
    $sheet1->writeString($row,2,$radio['AntennaType']['name'],$fmt4);
    $sheet1->writeString($row,4,'SSID',$fmt3);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['ssid'],$fmt4);
    $row++;
    
    $sheet1->writeString($row,1,'Link Distance',$fmt3);
    $d = sprintf("%01.2f",$radio['NetworkRadios']['distance']);
    $sheet1->writeString($row,2,$d." Km",$fmt4);
    $sheet1->writeString($row,4,'Switch Port',$fmt3);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['switch_port'],$fmt4);
    $row++;
    
    $sheet1->writeString($row,1,'Azimuth (True)',$fmt3);
    //$d = sprintf("%01.2f",$radio['NetworkRadios']['true_azimuth']);
    $d = round($radio['NetworkRadios']['true_azimuth']);
    $sheet1->writeString($row,2,$d."°",$fmt4);
    $sheet1->writeString($row,4,'IP',$fmt3);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['ip_address'],$fmt4);
    $row++;
    
    if ($radio['NetworkRadios']['true_azimuth'] > 0) {
        $mag_azimuth = $radio['NetworkRadios']['true_azimuth'] - $site['Site']['declination'];
    } else {
        $mag_azimuth = 0;
    }
    $sheet1->writeString($row,1,'Azimuth (Magnetic)',$fmt3);
    //$d = sprintf("%01.2f",$mag_azimuth);
    $d = round($mag_azimuth);
    $sheet1->writeString($row,2,$d."°",$fmt4);
    $sheet1->writeString($row,4,'Gateway',$fmt3);
    //$sheet1->writeString($row,5,'',$fmt4);
    $sheet1->writeString($row,5,$radio['NetworkRadios']['gw_address'],$fmt4);
    $row++;
    
    $sheet1->writeString($row,1,'Elevaton',$fmt3);
    $sheet1->writeString($row,2,$radio['NetworkRadios']['elevation'],$fmt4);
    $sheet1->writeString($row,4,'Mode',$fmt3);
    $sheet1->writeString($row,5,$radio['RadioMode']['name'],$fmt4);
    
    $row++;
    for ($u = 1; $u <= 5; $u++) {
        $sheet1->writeString($row,$u,'',$fmt5);
    }
    
    $row += 2;    
}

// Send the headers, then output the data
$xml->sendHeaders();
$xml->writeData();

?>