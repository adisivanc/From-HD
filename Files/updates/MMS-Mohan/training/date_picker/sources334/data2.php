<?php
/**
 *
 * Highcharts - deeper practice for real statistics
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Script Tutorials
 * http://www.script-tutorials.com/
 */

function splitByPairs($array) {
    $odd = array();
    $even = array();
    $both = array(&$even, &$odd);
    array_walk($array, function($v, $k) use ($both) { $both[$k % 2][] = $v; });
    return array($odd, $even);
}

require_once('parsecsv.lib.php');

// select filename
$sFilename = (isset($_GET['extra'])) ? '2011gender_table11.csv' : '2011gender_table10.csv';

// parse CSV
$csv = new parseCSV($sFilename, 4); // 4 is offset (of rows with comments)

// get all categories from the first table
$aCats = array();
foreach ($csv->data[0] as $s) {
    if ($s = trim($s)) {
        $aCats[] = $s;
    }
}

// prepare array of series (range of tables)
$iStart = 3;
$iEnd = 17;
$aSeries = array();

for ($x = $iStart; $x <= $iEnd; $x++) {

    // Get exact Stat info by ID
    $sTitle = $csv->data[$x]['Sex and age'];
    $aDataSlc = array_slice($csv->data[$x], 3); // we can remove (slice) first three fields (they contain title and total information)
    $aData = array();
    foreach ($aDataSlc as $s) {
        $aData[] = $s;
    }

    // separate $aData array to odd and even pairs
    list($aPerc, $aVals) = splitByPairs($aData);

    // prepare separated array of percentages with category names
    $i = 0;
    $aPercRows = array();
    foreach ($aCats as $s) {
        $fPercent = str_replace(',', '.', $aPerc[$i]);
        $fPercent = ((float)$fPercent) ? (float)$fPercent : 0;
        $aPercRows[] = array('name' => $s, 'val' => $fPercent);

        $i++;
    }

    $aSeries[] = array(
        'name' => trim($sTitle),
        'values' => $aPercRows
    );
}

// echo JSON data
$aJson = array();
$aJson['categories'] = $aCats;
$aJson['series'] = $aSeries;
echo json_encode($aJson);