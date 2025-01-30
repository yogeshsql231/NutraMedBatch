<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class PackagingOrder extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;




    protected $fillable = [
        'orderId',
        'orderDate',
        'customerId',
        'productName',
        'genericName',
        'po',
        'fProduct',
        'formula',
        'WO',
        'LOT',
        'Exp',
        'orderQty',
        'poQty',
        'dosageForm',
        'ofDosesUnit',
        'bluckProdLot',
        'prodSuplyBy',
        'ndcUpc',
        'unitDescription',
        'customerInfo',
        'compName',
        'compDesc',
        'compCode',
        'packInstruction',
        'toolingNumber',
        'toolingDrawing',
        'testToolingSpecfication',
        'pkgSize',
        'matWidth',
        'foilYield',
        'foilcode',
        'PvcYield',
        'PbvCode',
        'visualInspection',
        'testOne',
        'testTwo',
        'testThree',
        'testFour',
        'testFive',
        'processParameter',
        'peopleAssigment',
        'inspectionInst',
        'document',
        'masterOrd',
        'newOrderCreatedBy',
        'indexSetting',
    ];


    protected $dates = [
        'orderDate',
    ];


    // Alternatively, you can use casts
    protected $casts = [
        'orderDate' => 'date',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }
}
