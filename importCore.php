<?php
//import.php
// DB CONFIGURATION //
$dbName = 'r32256vo_portaImport';
$dbUser = 'r32256vo_porta';
$dbPass = '&~j&XC%D7+~W';
$dbHost = 'localhost';
// END DB CONFIGURATION //
sleep(3);
$output = '';

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
	$valid_extension = array('xml');
	$file_data = explode('.', $_FILES['file']['name']);
	$file_extension = end($file_data);
	if (in_array($file_extension, $valid_extension)) {
		$data = simplexml_load_file($_FILES['file']['tmp_name']);
		$connect = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUser, $dbPass);
		$query = "
	  INSERT INTO comenzi 
	   (CreatedDate, OrderName, OrderNo, CatalogDescription, CatalogNumber, Configuration, Ean, LineNo, OrderCurrency, OrderedQuantity, PlannedDate, ShippedQuantity, SupplierItemCode, TotalDiscount, TotalWeight, UnitGrossPriceDiscount, UnitNetPrice, UnitNetPriceDiscount, UnitOfWeight) 
	   VALUES(:CreatedDate, :OrderName, :OrderNo, :CatalogDescription, :CatalogNumber, :Configuration, :Ean, :LineNo, :OrderCurrency, :OrderedQuantity, :PlannedDate, :ShippedQuantity, :SupplierItemCode, :TotalDiscount, :TotalWeight, :UnitGrossPriceDiscount, :UnitNetPrice, :UnitNetPriceDiscount, :UnitOfWeight);
	  ";
		$statement = $connect -> prepare($query);
		for ($i = 0; $i < count($data); $i++) {
			$statement -> execute(array(':name' => $data -> employee[$i] -> name, ':address' => $data -> employee[$i] -> address, ':gender' => $data -> employee[$i] -> gender, ':designation' => $data -> employee[$i] -> designation, ':age' => $data -> employee[$i] -> age));

		}
		$result = $statement -> fetchAll();
		if (isset($result)) {
			$output = '<div class="alert alert-success">Import Data Done</div>';
		}
	} else {
		$output = '<div class="alert alert-warning">Invalid File</div>';
	}
} else {
	$output = '<div class="alert alert-warning">Please Select XML File</div>';
}

echo $output;
?>
