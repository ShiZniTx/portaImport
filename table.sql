--
-- Database: `portaImport`
--

-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE IF NOT EXISTS `comenzi` (
  `id` int(11) NOT NULL,
  `CreatedDate` varchar(250) NOT NULL,
  `OrderName` varchar(250) NOT NULL,
  `OrderNo` varchar(250) NOT NULL,
  `CatalogDescription` varchar(250) NOT NULL,
  `CatalogNumber` text NOT NULL,
  `Configuration` varchar(10) NOT NULL,
  `Ean` varchar(250) NOT NULL,
  `LineNo` varchar(100) NOT NULL,
  `OrderCurrency` varchar(250) NOT NULL,
  `OrderedQuantity` varchar(100) NOT NULL,
  `PlannedDate` varchar(100) NOT NULL,
  `ShippedQuantity` varchar(100) NOT NULL,
  `SupplierItemCode` varchar(100) NOT NULL,
  `TotalDiscount` varchar(100) NOT NULL,
  `TotalWeight` varchar(100) NOT NULL,
  `UnitGrossPriceDiscount` varchar(100) NOT NULL,
  `UnitNetPrice` varchar(100) NOT NULL,
  `UnitNetPriceDiscount` varchar(100) NOT NULL,
  `UnitOfWeight` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
