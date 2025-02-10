<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $customer = Customer::where('customer_id', $row['customer_id'])->first();

        if (!$customer) {
            return new Customer([
                'customer_id'        => $row['customer_id'],
                'customer_name'      => $row['customer_name'],
                'contact_person'     => $row['contact_person'],
                'phone'              => $row['phone'],
                'address_street'     => $row['address_street'],
                'address_street_2'   => $row['address_street_2'],
                'town'               => $row['town'],
                'state'              => $row['state'],
                'zipcode'            => $row['zipcode'],
                'shipping_street'    => $row['shipping_street'],
                'shipping_street_2'  => $row['shipping_street_2'],
                'shipping_town'      => $row['shipping_town'],
                'shipping_state'     => $row['shipping_state'],
                'shipping_zipcode'   => $row['shipping_zipcode'],
            ]);
        }
        return null;
    }
}
