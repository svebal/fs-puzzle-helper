<?php
/**
 * Cut images to cell-images (portals).
 * 
 * Requires PHP 5.5 or higher (due to using e.g. `imagecrop`).
 */
date_default_timezone_set("Europe/Warsaw");
ini_set("memory_limit", "2048M");

require_once "./inc/Cutter.php";
require_once "./inc/FileHelper.php";

/**/
$testing = false;
// $testing = true;
if (!$testing) {
	$dir = './input/*.jpg';
	$files = FileHelper::filesByTime($dir);
	if (empty($files)) {
		die('[ERROR] No files in input dir.');
	}
	$newest_file = array_pop($files);
	echo "Cutting: $newest_file\n";

	$cutter = new Cutter($newest_file, "../img-auto-cut/cells/", "../img-auto-cut/");
	$cutter->cut();

} else {
	// testing
	echo "\nWARNING! Running in test mode!\n";

	// $cutter = new Cutter("raw.jpg", "../img-auto-cut/cells_/", "../img-auto-cut/");
	// // $cutter->cut(2);
	// $cutter->cut();

	$files = glob("*.jpg");
	foreach ($files as $file) {
		echo "\n.\n.\n[TEST] file: $file\n";
		$cutter = new Cutter($file, "../img-auto-cut/cells_/", "../img-auto-cut/");
		$cutter->cut(-1);
	}
	
	echo "\nWARNING! Running in test mode!\n";
}

/**

// pseudo cut uneven columns
$baseDir = '../img-auto-cut/';
$dir = $baseDir.'col_*.jpg';
$files = glob($dir);
$colCounts = (require($baseDir."cut-data.php"));
if (empty($files)) {
	die('[ERROR] No files in input dir.');
}
$cutter = new Cutter($files[0], $baseDir."cells/", $baseDir."");
$cutter->clearCells();
foreach ($files as $file) {
	$fileName = basename($file);
	$column = intval(preg_replace('#[^0-9]+#', '', $fileName));
	$colCount = $colCounts[$fileName];
	echo "\n[INFO] file: $fileName; $colCount";
	$cutter = new Cutter($file, $baseDir."cells/", $baseDir."");
	$cutter->cutUneven($column, $colCount);
}
/**/

echo "\nDone\n";
