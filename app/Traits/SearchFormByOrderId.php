<?php

namespace App\Traits;

use App\Models\DuplicatePackagingOrder;
use App\Models\PackagingOrder;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;

trait SearchFormByOrderId
{
    /**
     * Fetch order details, revisions, and orders based on the given order ID.
     *
     * @param int $orderId
     * @param string $tbName

     * @return array|null
     */
    public function searchFormByOrderId($orderId, $tbName)
    {
        try {

            if ($tbName == 'Customer Order') {
                $orderDetails = PackagingOrder::with('customers')->find($orderId);
            } elseif ($tbName == 'Production Order') {
                $orderDetails = DuplicatePackagingOrder::with('customers')->find($orderId);
            }

            // $orderDetails = PackagingOrder::with('customers', 'audits')->find($orderId);

            $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $orderId)
                ->where('event', 'updated')
                ->count();

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();

            return compact('orderDetails', 'orders', 'rev');
        } catch (\Exception $e) {
            Log::error('Error in SearchFormByOrderId Trait: ' . $e->getMessage());
            return null;
        }
    }
}
