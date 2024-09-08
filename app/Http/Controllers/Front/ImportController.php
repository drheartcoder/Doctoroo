<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class ImportController extends Controller
{
    public function __construct()
	{
		
	}

	public function import()
	{
		$file = "your-file.xls";
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			$name = $filesop[0];
			$email = $filesop[1];

			$sql = mysql_query("INSERT INTO xls (name, email) VALUES ('$name','$email')");
		}

		if($sql)
		{
			echo "You database has imported successfully";
		}
		else
		{
			echo "Sorry! There is some problem.";
		}
		
	} // end import

	public function process_import()
	{
		$temp_file_name = $request->file('file')->getClientOriginalName();
		$isUpload 		= $request->file('file')->move($this->csv_base_img_path, $temp_file_name);

		$file = fopen(url('/').'/uploads/csv_upload/export_cat.csv', "r");	

	} // end process_import



}
