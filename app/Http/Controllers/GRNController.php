<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GRN;
use App\Models\MedicineStoreRoom;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use App\Models\GRNDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemStock;

class GRNController extends Controller
{
    public function index()
    {
        $store_room = MedicineStoreRoom::select('medicine_store_rooms.id', 'medicine_store_rooms.name')->where('is_active', '1')->get();

        $grn_list = GRN::where('is_delete', '0')
            ->orderBy('g_r_n_s.id', 'DESC')
            ->get();

        return view('pharmacy.purchase.grn.grn-list', compact('grn_list', 'store_room'));
    }

    public function create_grn()
    {
        $po_list = PurchaseOrder::select('purchase_orders.id as po_id', 'purchase_orders.po_prefix')->where('purchase_orders.status', '>=', '17')->where('purchase_orders.grn_status', '!=', '1')
            ->get();
        return view('pharmacy.purchase.grn.grn-create', compact('po_list'));
    }

    public function get_po_item_details($po_id)
    {
        $po_list = PurchaseOrder::join('users', 'users.id', '=', 'purchase_orders.generated_by')->join('medicine_store_rooms', 'medicine_store_rooms.id', '=', 'purchase_orders.store_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'purchase_orders.status')
            ->join('vendors', 'vendors.id', '=', 'purchase_orders.vendor')
            ->select('vendors.vendor_name', 'purchase_orders.feedback', 'purchase_orders.expected_delivery_date', 'medicine_store_rooms.id as medicine_store_rooms_id_no', 'users.first_name', 'users.last_name', 'purchase_orders.id as po_id', 'medicine_store_rooms.name as store_room_name', 'purchase_orders.po_date', 'purchase_orders.status as po_status', 'working_statuses.status', 'purchase_orders.po_prefix', 'purchase_orders.total', 'purchase_orders.extra_charges_name', 'purchase_orders.extra_charges_value', 'purchase_orders.grand_total', 'vendors.id as vendor_id_no', 'purchase_orders.note')
            ->where('purchase_orders.is_delete', 0)
            ->where('purchase_orders.id', $po_id)
            ->first();


        $po_item = PurchaseOrderDetails::join('medicines', 'medicines.id', '=', 'purchase_order_details.medicine_name')
            ->join('medicine_units', 'medicine_units.id', '=', 'medicines.unit')
            ->join('medicine_catagories', 'medicine_catagories.id', '=', 'medicines.medicine_catagory')
            ->select('purchase_order_details.id as purchase_order_details_id', 'purchase_order_details.req_id', 'purchase_order_details.grn_qty', 'purchase_order_details.req_no', 'medicines.medicine_name', 'medicine_catagories.id as catagory_id', 'medicine_units.id as unit_id', 'medicines.id as medicine_id', 'medicine_catagories.medicine_catagory_name', 'purchase_order_details.quantity', 'medicine_units.medicine_unit_name')
            ->where('purchase_order_details.purchase_order_id', $po_id)
            ->where(
                function ($query) {
                    return $query
                        ->orwhere('purchase_order_details.grn_status', '=', '0')
                        ->orwhere('purchase_order_details.quantity', '=', 'purchase_order_details.grn_qty');
                }
            )
            ->get();

        return response()->json(array('po_list' => $po_list, 'po_item' => $po_item));
    }

    public function save_grn(Request $req)
    {

        $po_id = $req->po_no;

        $validator = $req->validate([
            'medicine_rec_date' => 'required',
        ]);

        $grn_prefix = DB::table('prefixes')->where('name', '=', 'grn')->first();
        $challan_copy = '';
        $invoice_copy = '';
        if ($req->hasfile('challan_copy')) {
            $file = $req->file('challan_copy');
            $challan_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("challan_copy/", $challan_copy);
        }
        if ($req->hasfile('invoice_copy')) {
            $file = $req->file('invoice_copy');
            $invoice_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("invoice_copy/", $invoice_copy);
        }

        $item_id = $req->post('medicine');
        $unit_id = $req->post('unit');
        $catagory_id = $req->post('catagory');
        $qty = $req->post('qty');
        $req_id = $req->post('req');
        $gst = $req->post('gst');
        $rate = $req->post('rate');
        $amount = $req->post('amount');
        $po_details_id = $req->post('po_details_id');

        $grn = new GRN();
        $grn->grn_prefix            =   $grn_prefix->prefix;
        $grn->po_no                 =   $po_id;
        $grn->vendor                =   $req->post('vendor');
        $grn->storeroom_id          =   $req->post('storeroom_id');
        $grn->grn_date              =   date('Y-m-d h:i');
        $grn->medicine_rec_date     =   $req->medicine_rec_date;
        $grn->bill_rec_date         =   $req->bill_rec_date;
        $grn->challan_no            =   $req->challan_no;
        $grn->challan_copy          =   $challan_copy;
        $grn->invoice_copy          =   $invoice_copy;
        $grn->challan_date          =   $req->challan_date;
        $grn->invoice_no            =   $req->invoice_no;
        $grn->invoice_date          =   $req->invoice_date;
        $grn->invoice_value         =   $req->invoice_value;
        $grn->po_value              =   $req->po_value;
        $grn->note                  =   $req->note;
        $grn->purpose               =   $req->purpose;
        $grn->generated_by          =   Auth::id();
        $grn->stock_update_status   =   0;
        $grn->status                =   1;
        $grn->is_delete             =   0;
        $grn->save();

        $grn_id = $grn->id;

        $no_of_item = count($item_id);

        for ($i = 0; $i < $no_of_item; $i++) {

            $details = PurchaseOrderDetails::where('id', $po_details_id[$i])->first();
            $qt = $details->grn_qty + $qty[$i];

            $grn_details = array(
                'grn_id'        => $grn_id,
                'req_id'        => $req_id[$i],
                'medicine_id'   => $item_id[$i],
                'catagory_id'   => $catagory_id[$i],
                'unit_id'       => $unit_id[$i],
                'quantity'      => $qty[$i],
                'gst'           => $gst[$i],
                'rate'          => $rate[$i],
                'amount'        => $amount[$i],
            );

            $grn_details_id = GRNDetail::insertGetId($grn_details);
            PurchaseOrderDetails::where('id', $po_details_id[$i])->update(['grn_qty' => $qt]);

            DB::table('purchase_order_details')
                ->join('purchase_orders', 'purchase_order_details.purchase_order_id', '=', 'purchase_orders.id')
                ->where('purchase_order_details.grn_qty', '=', DB::raw('purchase_order_details.quantity'))
                ->where('purchase_order_details.id', '=', $po_details_id[$i])
                ->update(['purchase_order_details.grn_status' => 1]);
        }

        DB::table('purchase_orders')
            ->where('id', '=', $po_id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('purchase_order_details')
                    ->whereRaw('purchase_order_details.purchase_order_id = purchase_orders.id')
                    ->where('purchase_order_details.grn_status', '<>', 1);
            })
            ->update(['grn_status' => 1]);

        if ($grn_details_id != null) {
            return redirect()->route('medicine-grn-list')->with('success', "GRN Added Sucessfully");
        } else {
            return redirect()->route('medicine-grn-list')->with('error', "Something Went Wrong");
        }
    }

    public function grn_details($id)
    {
        $grn_id = base64_decode($id);
        $grn_list = GRN::where('g_r_n_s.is_delete', 0)
            ->where('g_r_n_s.id', $grn_id)
            ->first();

        $po_details = PurchaseOrder::where('id', $grn_list->po_no)->first();

        $grn_item = GRNDetail::where('g_r_n_details.grn_id', $grn_id)
            ->get();
        return view('pharmacy.purchase.grn.grn-details', compact('grn_item', 'grn_list', 'po_details'));
    }

    public function stock_update_after_grn($id)
    {
        try {
            DB::beginTransaction();

            $grn_id = base64_decode($id);

            $grn_main = GRN::join('medicine_store_rooms', 'medicine_store_rooms.id', '=', 'g_r_n_s.storeroom_id')
                ->select('medicine_store_rooms.name as storeroom_name', 'medicine_store_rooms.id as storeroom_id')
                ->where('g_r_n_s.is_delete', 0)
                ->where('g_r_n_s.id', $grn_id)
                ->first();

            $grn_item = GRNDetail::join('medicines', 'medicines.id', '=', 'g_r_n_details.medicine_id')
                ->join('medicine_units', 'medicine_units.id', '=', 'g_r_n_details.unit_id')
                ->join('medicine_catagories', 'medicine_catagories.id', '=', 'g_r_n_details.catagory_id')
                ->select('g_r_n_details.gst', 'g_r_n_details.quantity', 'g_r_n_details.rate', 'g_r_n_details.amount', 'g_r_n_details.req_id', 'medicine_units.medicine_unit_name', 'g_r_n_details.unit_id', 'medicines.medicine_name', 'medicine_catagories.id', 'g_r_n_details.medicine_id', 'g_r_n_details.catagory_id')
                ->where('g_r_n_details.grn_id', $grn_id)
                ->get();

            foreach ($grn_item as $item) {

                $itemstock = new ItemStock();
                $itemstock->grn_id                  = $grn_id;
                $itemstock->storeroom_id            = $grn_main->storeroom_id;
                $itemstock->medicine_id             = $item->medicine_id;
                $itemstock->medicine_unit_id        = $item->unit_id;
                $itemstock->medicine_catagory_id    = $item->catagory_id;
                $itemstock->quantity                = $item->quantity;
                $itemstock->gst                     = $item->gst;
                $itemstock->rate                    = $item->rate;
                $itemstock->amount                  = $item->amount;
                $itemstock->status                  = 'new_stock';
                $itemstock->save();
            }
            $de = GRN::where('id', $grn_id)->update(['stock_update_status' => '1']);

            DB::commit();
            if ($de != null) {
                return redirect()->route('medicine-grn-list')->with('success', "Stock Updated Sucessfully");
            } else {
                return redirect()->route('medicine-grn-list')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('medicine-grn-list')->with('error', "Something Went Wrong");
        }
    }

    public function grn_delete($id)
    {
        $grn_id = base64_decode($id);
        $res = GRN::where('id', $grn_id)->update(['is_delete' => '1']);
        if ($res != null) {
            return redirect()->route('medicine-grn-list')->with('success', "GRN Deleted Sucessfully");
        } else {
            return redirect()->route('medicine-grn-list')->with('error', "Something Went Wrong");
        }
    }

    public function grn_edit($id)
    {
        $user_workshop = Auth::user()->workshop;

        $grn_id = base64_decode($id);
        $grn_list = GRN::where('g_r_n_s.is_delete', 0)
            ->where('g_r_n_s.id', $grn_id)
            ->first();

        $po_list = PurchaseOrder::select('purchase_orders.id as po_id', 'purchase_orders.po_prefix')->where('purchase_orders.id', $grn_list->po_no)->first();

        $grn_item = GRNDetail::where('g_r_n_details.grn_id', $grn_id)->get();

        return view('pharmacy.purchase.grn.grn-edit', compact('po_list', 'grn_list', 'grn_item'));
    }

    public function update_grn(Request $req)
    {
        $po_id = $req->po_no;

        $validator = $req->validate([
            'medicine_rec_date' => 'required',
        ]);
        $grn_prefix = DB::table('prefixes')->where('name', '=', 'grn')->first();
        $challan_copy = '';
        $invoice_copy = '';
        if ($req->hasfile('challan_copy')) {
            $file = $req->file('challan_copy');
            $challan_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("challan_copy/", $challan_copy);
        }
        if ($req->hasfile('invoice_copy')) {
            $file = $req->file('invoice_copy');
            $invoice_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("invoice_copy/", $invoice_copy);
        }

        $item_id = $req->post('medicine');
        $unit_id = $req->post('unit');
        $catagory_id = $req->post('catagory');
        $qty = $req->post('qty');
        $req_id = $req->post('req');
        $gst = $req->post('gst');
        $rate = $req->post('rate');
        $amount = $req->post('amount');

        $po_details_id = $req->post('po_details_id');

        $grn = GRN::find('id', $req->grn_id)->first();
        $grn->grn_prefix            =   $grn_prefix->prefix;
        $grn->po_no                 =   $po_id;
        $grn->vendor                =   $req->post('vendor');
        $grn->storeroom_id          =   $req->post('storeroom_id');
        $grn->grn_date              =   date('Y-m-d h:i');
        $grn->medicine_rec_date     =   $req->medicine_rec_date;
        $grn->bill_rec_date         =   $req->bill_rec_date;
        $grn->challan_no            =   $req->challan_no;
        $grn->challan_copy          =   $challan_copy;
        $grn->invoice_copy          =   $invoice_copy;
        $grn->challan_date          =   $req->challan_date;
        $grn->invoice_no            =   $req->invoice_no;
        $grn->invoice_date          =   $req->invoice_date;
        $grn->invoice_value         =   $req->invoice_value;
        $grn->po_value              =   $req->po_value;
        $grn->note                  =   $req->note;
        $grn->purpose               =   $req->purpose;
        $grn->generated_by          =   Auth::id();
        $grn->stock_update_status   =   0;
        $grn->status                =   1;
        $grn->is_delete             =   0;
        $grn->save();

        $grn_id = $grn->id;

        GRNDetail::where('grn_id', $req->grn_id)->delete();

        $no_of_item = count($item_id);

        // DB::table('purchase_orders')
        //     ->where('id', $po_id)
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('purchase_order_details')
        //             ->whereRaw('purchase_order_details.purchase_order_id = purchase_orders.id')
        //             ->where('purchase_order_details.grn_status', '<>', '0');
        //     })
        //     ->update(['grn_status' => '0']);

        DB::statement('UPDATE purchase_orders
        SET grn_status = "0"
        WHERE id = ' . $po_id . '
          AND NOT EXISTS (
            SELECT 1
            FROM purchase_order_details
            WHERE purchase_order_details.purchase_order_id = purchase_orders.id
              AND purchase_order_details.grn_status <> "0"
         )');


        for ($i = 0; $i < $no_of_item; $i++) {

            $details = PurchaseOrderDetails::where('id', $po_details_id[$i])->first();
            $qt = $details->grn_qty + $qty[$i];

            $grn_details = array(
                'grn_id'        => $grn_id,
                'req_id'        => $req_id[$i],
                'medicine_id'   => $item_id[$i],
                'catagory_id'   => $catagory_id[$i],
                'unit_id'       => $unit_id[$i],
                'quantity'      => $qty[$i],
                'gst'           => $gst[$i],
                'rate'          => $rate[$i],
                'amount'        => $amount[$i],
            );

            $grn_details_id = GRNDetail::insertGetId($grn_details);
            PurchaseOrderDetails::where('id', $po_details_id[$i])->update(['grn_qty' => 0]);

            // DB::table('purchase_order_details')
            //     ->join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_details.purchase_order_id')
            //     ->where('purchase_order_details.grn_qty', '=', DB::raw('purchase_order_details.quantity'))
            //     ->where('purchase_order_details.id', '=', $po_details_id[$i])
            //     ->update(['purchase_order_details.grn_status' => '0']);

            DB::statement('UPDATE purchase_order_details,purchase_orders set purchase_order_details.grn_status = "0" where purchase_order_details.grn_qty = purchase_order_details.quantity and  purchase_order_details.id = ' . $po_details_id[$i]);

            PurchaseOrderDetails::where('id', $po_details_id[$i])->update(['grn_qty' => $qt]);

            // DB::table('purchase_order_details')
            //     ->join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_details.purchase_order_id')
            //     ->where('purchase_order_details.grn_qty', '=', DB::raw('purchase_order_details.quantity'))
            //     ->where('purchase_order_details.id', '=', $po_details_id[$i])
            //     ->update(['purchase_order_details.grn_status' => '1']);

            DB::statement('UPDATE purchase_order_details,purchase_orders set purchase_order_details.grn_status = "1" where purchase_order_details.grn_qty = purchase_order_details.quantity and  purchase_order_details.id = ' . $po_details_id[$i]);
        }

        // DB::table('purchase_orders')
        //     ->where('id', '=', $po_id)
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('purchase_order_details')
        //             ->whereRaw('purchase_order_details.purchase_order_id = purchase_orders.id')
        //             ->where('purchase_order_details.grn_status', '<>', '1');
        //     })
        //     ->update(['grn_status' => '1']);

        DB::statement('UPDATE purchase_orders
    SET grn_status = "1"
    WHERE id = ' . $po_id . '
      AND NOT EXISTS (
        SELECT 1
        FROM purchase_order_details
        WHERE purchase_order_details.purchase_order_id = purchase_orders.id
          AND purchase_order_details.grn_status <> "1"
     )');


        if ($grn_details_id != null) {
            return redirect()->route('medicine-grn-list')->with('success', "GRN Update Sucessfully");
        } else {
            return redirect()->route('medicine-grn-list')->with('error', "Something Went Wrong");
        }
    }

    
}
