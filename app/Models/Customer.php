<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Customer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'contact_person',
        'phone',
        'email',
        'address_street',
        'address_street_2',
        'town',
        'state',
        'zipcode',
        'shipping_street',
        'shipping_street_2',
        'shipping_town',
        'shipping_state',
        'shipping_zipcode',
    ];


    public function packagingorders()
    {
        return $this->hasMany(PackagingOrder::class, 'customerId');
    }

    public function Duplicatepackagingorders()
    {
        return $this->hasMany(DuplicatePackagingOrder::class, 'customerId');
    }
}
