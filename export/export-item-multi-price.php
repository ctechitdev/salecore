<?php

include("../setting/conn.php");

include('../Classes/PHPExcel.php');


$item_id = $_GET['item_id'];

$objPHPExcel  =  new  PHPExcel();


$objPHPExcel->setActiveSheetIndex(0);



$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'U_ACP_ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'U_SOLOMON_ID');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ItemsGroupCode');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ItemName');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'ForeignName');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'U_Packing');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'InventoryUOM');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'PurchaseUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'PurchaseQtyPerPackUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'SalesUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'SalesQtyPerPackUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'PurchaseItem');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'SalesItem');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'InventoryItem');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'AssetItem');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'SalesVATGroup');
$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'SalesItemsPerUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'SalesPackagingUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'PurchaseItemsPerUnit');
$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'PurchaseVATGroup');
$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'CustomsGroupCode');
$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'GLMethod');
$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'CostAccountingMethod');
$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Valid');
$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'ValidFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Frozen');
$objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'FrozenFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'U_Brand');


$header2 = array(
    "", "", "",

    "GLMethod", "EvalSystem", "ValidFor", "ValidFrom", "FrozenFor", "FrozenFrom", "U_Brand", "Properties5"
);



$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'U_ACP_ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'U_SOLOMON_ID');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'ItmsGrpCod');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'ItemName');
$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'FrgnName');
$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'U_Packing');
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'InvntryUom');

$objPHPExcel->getActiveSheet()->SetCellValue('I2', 'BuyUnitMsr');
$objPHPExcel->getActiveSheet()->SetCellValue('J2', 'PurPackUn');
$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'SalUnitMsr');
$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'SalPackUn');
$objPHPExcel->getActiveSheet()->SetCellValue('M2', 'PrchseItem');

$objPHPExcel->getActiveSheet()->SetCellValue('N2', 'SellItem');
$objPHPExcel->getActiveSheet()->SetCellValue('O2', 'InvntItem');
$objPHPExcel->getActiveSheet()->SetCellValue('P2', 'AssetItem');
$objPHPExcel->getActiveSheet()->SetCellValue('Q2', 'VatGourpSa');
$objPHPExcel->getActiveSheet()->SetCellValue('R2', 'NumInSale');
$objPHPExcel->getActiveSheet()->SetCellValue('S2', 'SalPackMsr');
$objPHPExcel->getActiveSheet()->SetCellValue('T2', 'NumInBuy');
$objPHPExcel->getActiveSheet()->SetCellValue('U2', 'VatGroupPu');
$objPHPExcel->getActiveSheet()->SetCellValue('V2', 'CstGrpCode');

$objPHPExcel->getActiveSheet()->SetCellValue('W2', 'GLMethod');
$objPHPExcel->getActiveSheet()->SetCellValue('X2', 'EvalSystem');
$objPHPExcel->getActiveSheet()->SetCellValue('Y2', 'ValidFor');
$objPHPExcel->getActiveSheet()->SetCellValue('Z2', 'ValidFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AA2', 'FrozenFor');
$objPHPExcel->getActiveSheet()->SetCellValue('AB2', 'FrozenFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AC2', 'U_Brand');


$rowCount = 3;



$stmt1 = $conn->prepare(" select full_code,item_code,item_group_code_b1,item_name, weight as u_packing,buy_unit,sale_unit,sale_tax_code,pack,purchase_tax_code,customer_item_code,
DATE_FORMAT(date_use, '%Y%m%d') AS date_use,brand_name
from tbl_item_code_list a
left join tbl_item_code b on a.it_id = b.it_id
left join tbl_item_company_code c on b.icc_id = c.icc_id 
where b.it_id = '$item_id' ");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {



        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($row1['full_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['item_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper('', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['item_group_code_b1'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper($row1['item_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, mb_strtoupper($row1['item_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, mb_strtoupper($row1['u_packing'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, mb_strtoupper('Pcs', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, mb_strtoupper($row1['buy_unit'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, mb_strtoupper('1', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, mb_strtoupper($row1['sale_unit'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, mb_strtoupper('1', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, mb_strtoupper('Y', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, mb_strtoupper('Y', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, mb_strtoupper('Y', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, mb_strtoupper('N', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, mb_strtoupper($row1['sale_tax_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, mb_strtoupper($row1['pack'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, mb_strtoupper($row1['sale_unit'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, mb_strtoupper($row1['pack'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, mb_strtoupper($row1['purchase_tax_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, mb_strtoupper($row1['customer_item_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, mb_strtoupper('C', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, mb_strtoupper('A', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, mb_strtoupper('Y', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, mb_strtoupper($row1['date_use'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, mb_strtoupper('N', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, mb_strtoupper('', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, mb_strtoupper($row1['brand_name'], 'UTF-8'));
        $rowCount++;
    }
}


$objPHPExcel->getActiveSheet()->setTitle('Item Data');


$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ParentKey');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PriceList');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Price');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Currency');

$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'PriceList');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Price');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'Currency');

$rowCount2  =  3;


$stmt2 = $conn->prepare(" select full_code,item_code,item_group_code_b1,item_name,ccy,
weight as u_packing,buy_unit,sale_unit,sale_tax_code,pack,purchase_tax_code,customer_item_code,
  DATE_FORMAT(date_use, '%Y%m%d') AS date_use,item_price,pl_id
 from tbl_item_code_list a
 left join tbl_item_code b on a.it_id = b.it_id
 left join tbl_item_company_code c on b.icc_id = c.icc_id 
 where b.it_id = '$item_id'  ");
$stmt2->execute();
if ($stmt2->rowCount() > 0) {
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount2, mb_strtoupper($row2['full_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount2, mb_strtoupper($row2['pl_id'] - 1, 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount2, mb_strtoupper($row2['pl_id'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount2, mb_strtoupper($row2['item_price'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount2, mb_strtoupper($row2['ccy'], 'UTF-8'));
        $rowCount2++;
    }
}

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Item Sell Price');



$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(2);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ParentKey');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PriceList');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Price');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Currency');

$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ItemCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'PriceList');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Price');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'Currency');

$rowCount3  =  3;


$stmt3 = $conn->prepare(" select full_code,item_code,item_group_code_b1,item_name,ccy,
weight as u_packing,buy_unit,sale_unit,sale_tax_code,pack,purchase_tax_code,customer_item_code,
  DATE_FORMAT(date_use, '%Y%m%d') AS date_use,item_price_purchase,pl_id
 from tbl_item_code_list a
 left join tbl_item_code b on a.it_id = b.it_id
 left join tbl_item_company_code c on b.icc_id = c.icc_id 
 where b.it_id = '$item_id'  ");
$stmt3->execute();
if ($stmt3->rowCount() > 0) {
    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount3, mb_strtoupper($row3['full_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount3, mb_strtoupper('11', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount3, mb_strtoupper('12', 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount3, mb_strtoupper($row3['item_price_purchase'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount3, mb_strtoupper($row3['ccy'], 'UTF-8'));
        $rowCount3++;
    }
}

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Item Purchase Price');


$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Add-Item.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>