<?php

namespace App\Imports;

use App\Models\PackagingOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PackagingOrderImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $validator = Validator::make($row, [
            'orderdate' => 'required|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for row: ' . json_encode($row));
        }




        $compName = json_encode(explode(', ', $row['compname'] ?? ''));
        $compDesc = json_encode(explode(', ', $row['compdesc'] ?? ''));
        $compCode = json_encode(explode(', ', $row['compcode'] ?? ''));
        $indexSetting = json_encode(explode(', ', $row['indexsetting'] ?? ''));


        $existingOrder = DB::table('packaging_orders')
            ->where('orderId', $row['orderid'])
            ->exists();

        if ($existingOrder) {
            return null;
        }


        $customerIdKey = DB::table('customers')->where('customer_id', $row['customerid'])->first();

        return new PackagingOrder([
            'orderId' => (isset($row['orderid']) && is_numeric($row['orderid']) && strlen($row['orderid']) == 4)
                ? (int)$row['orderid']
                : 1000,
            // 'orderDate' => Carbon::parse($row['orderdate'])->format('Y-m-d'),

            'orderDate' => Carbon::parse($row['orderdate']),




            'customerId' => $customerIdKey->id ?? null,
            'productName' => $row['productname'] ?? null,
            'genericName' => $row['genericname'] ?? null,
            'PO' => $row['po'],
            'fProduct' => $row['fproduct'] ?? null,
            'formula' => $row['formula'] ?? null,
            'WO' => $row['wo'] ?? null,
            'LOT' => $row['lot'] ?? null,
            'Exp' => $row['exp'],
            'orderQty' => isset($row['orderqty']) ? (int)$row['orderqty'] : null,
            'poQty' => isset($row['poqty']) ? (int)$row['poqty'] : null,
            'dosageForm' => $row['dosageform'] ?? null,
            'ofDosesUnit' => $row['ofdosesunit'] ?? null,
            'bluckProdLot' => $row['bluckprodlot'] ?? null,
            'prodSuplyBy' => $row['prodsuplyby'] ?? null,
            'ndcUpc' => $row['ndcupc'] ?? null,
            'unitDescription' => $row['unitdescription'] ?? null,
            'customerInfo' => $customerIdKey->address_street ?? $row['customerinfo'],
            'compName' => $compName,
            'compDesc' => $compDesc,
            'compCode' => $compCode,
            'packInstruction' => $row['packinstruction'] ?? null,
            'toolingNumber' => $row['toolingnumber'] ?? null,
            'toolingDrawing' => $row['toolingdrawing'] ?? null,
            'testToolingSpecfication' => $row['testtoolingspecfication'] ?? null,
            'pkgSize' => $row['pkgsize'] ?? null,
            'matWidth' => $row['matwidth'] ?? null,
            'foilYield' => $row['foilyield'] ?? null,
            'foilcode' => $row['foilcode'] ?? null,
            'PvcYield' => $row['pvcyield'] ?? null,
            'PbvCode' => $row['pbvcode'] ?? null,
            'visualInspection' => $row['visualinspection'] ?? null,
            'testOne' => $row['testone'] ?? null,
            'testTwo' => $row['testtwo'] ?? null,
            'testThree' => $row['testthree'] ?? null,
            'testFour' => $row['testfour'] ?? null,
            'testFive' => $row['testfive'] ?? null,
            'processParameter' => $row['processparameter'] ?? null,
            'peopleAssigment' => $row['peopleassigment'] ?? null,
            'inspectionInst' => $row['inspectioninst'] ?? null,
            'document' => $row['document'] ?? null,
            'masterOrd' => $row['masterord'] ?? null,
            'newOrderCreatedBy' => $row['newordercreatedby'] ?? null,
            'indexSetting' => $indexSetting,
        ]);
    }
}
