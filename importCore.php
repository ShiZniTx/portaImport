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
		$connect = new PDO('mysql:host=localhost;dbname=r32256vo_portaImport',$dbUser, $dbPass);
		$query = "
	  INSERT INTO comenzi
	   (CreatedDate, OrderName, OrderNo, CatalogDescription, CatalogNumber, Configuration, Ean, LineNo, OrderCurrency, OrderedQuantity, PlannedDate, ShippedQuantity, SupplierItemCode, TotalDiscount, TotalWeight, UnitGrossPriceDiscount, UnitNetPrice, UnitNetPriceDiscount, UnitOfWeight) 
	   VALUES(:CreatedDate, :OrderName, :OrderNo, :CatalogDescription, :CatalogNumber, :Configuration, :Ean, :LineNo, :OrderCurrency, :OrderedQuantity, :PlannedDate, :ShippedQuantity, :SupplierItemCode, :TotalDiscount, :TotalWeight, :UnitGrossPriceDiscount, :UnitNetPrice, :UnitNetPriceDiscount, :UnitOfWeight);
	  ";
		$statement = $connect -> prepare($query);
		for ($i = 0; $i < count($data); $i++) {
			$statement -> execute(array(':CreatedDate' => $data -> Header -> CreatedDate, ':OrderName' => $data -> Header -> OrderName, ':OrderNo' => $data -> Header -> OrderNo, ':CatalogDescription' => $data -> Lines -> Line[$i] -> CatalogDescription, ':CatalogNumber' => $data -> Lines -> Line[$i] -> CatalogNumber, ':Configuration' => $data -> Lines -> Line[$i] -> Configuration, ':Ean' => $data -> Lines -> Line[$i] -> Ean, ':LineNo' => $data -> Lines -> Line[$i] -> LineNo, ':OrderCurrency' => $data -> Lines -> Line[$i] -> OrderCurrency, ':OrderedQuantity' => $data -> Lines -> Line[$i] -> OrderedQuantity, ':PlannedDate' => $data -> Lines -> Line[$i] -> PlannedDate, ':ShippedQuantity' => $data -> Lines -> Line[$i] -> ShippedQuantity, ':SupplierItemCode' => $data -> Lines -> Line[$i] -> SupplierItemCode, ':TotalDiscount' => $data -> Lines -> Line[$i] -> TotalDiscount, ':TotalWeight' => $data -> Lines -> Line[$i] -> TotalWeight, ':UnitGrossPriceDiscount' => $data -> Lines -> Line[$i] -> UnitGrossPriceDiscount, ':UnitNetPrice' => $data -> Lines -> Line[$i] -> UnitNetPrice, ':UnitNetPriceDiscount' => $data -> Lines -> Line[$i] -> UnitNetPriceDiscount, ':UnitOfWeight' => $data -> Lines -> Line[$i] -> UnitOfWeight));

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
