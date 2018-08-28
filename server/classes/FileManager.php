<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 21/05/2018
 * Time: 13:13
 */

class FileManager {
	public static function convertToExcel($array,$filename) {
		if(file_exists($filename)){
			unlink($filename);
		}
		$file = fopen($filename,'w');
		foreach ($array as $value){
			fputcsv($file,$value);
		}
		fclose($file);
	}
	public static function createFileImage($filename,$base64){ //the total extension
		if(file_exists($filename)){
			unlink($filename);
		}
		$file = fopen($filename,'w');
//		tbc
	}
}
