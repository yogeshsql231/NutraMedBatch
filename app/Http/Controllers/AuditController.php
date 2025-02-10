<?php

namespace App\Http\Controllers;

use App\Models\PackagingOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{

    // view audit log of order table (changeControlForm)
    public function changeControlForm(Request $request)
    {
        try {

            if (!Auth::user()->can('Search-change_Control_Form')) {
                return redirect()->back()->with('error', 'You do not have permission to view the chnage control form.');
            }

            $AuditOrders = '';

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('audit.changeControleForm', compact('orders', 'AuditOrders'));
        } catch (\Exception $e) {
            Log::error('chnage control form open' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }



    //chnage Controle Packaging Order search by orderId
    public function chnageControlePackagingOrder(Request $request)
    {
        try {
            $AuditOrders = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $request->orderId)->with('user')->get();
            $AuditOrderDetails = PackagingOrder::with('customers')->find($request->orderId);
            $orders = PackagingOrder::select('id', 'orderId', 'productName',)->get();

            return view('audit.changeControleForm', compact('AuditOrders', 'orders', 'AuditOrderDetails'));
        } catch (\Exception $e) {
            Log::error('chnage control form open' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    //audit log of hole proect

    public function AuditLogReport(Request $request)
    {
        try {
            $auditReport = null;
            return view('audit.auditLogReport', compact('auditReport'));
        } catch (\Exception $e) {
            Log::error('view audit logs', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    //Genrate Audit Repoert

    public function generateAuditReport(Request $request)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate'
        ]);

        try {


            $auditReport = Audit::when(
                $request->startDate === $request->endDate,
                function ($query) use ($request) {
                    return $query->whereDate('created_at', $request->startDate);
                },
                function ($query) use ($request) {
                    return $query->whereBetween('created_at', [
                        Carbon::parse($request->startDate)->startOfDay(),
                        Carbon::parse($request->endDate)->endOfDay(),
                    ]);
                }
            )->get();


            if ($auditReport->isEmpty()) {
                return redirect()->back()->with('error', 'No records found.');
            }



            return view('audit.auditLogReport', compact('auditReport'));
        } catch (\Exception $e) {
            Log::error('filter the audit log report', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}