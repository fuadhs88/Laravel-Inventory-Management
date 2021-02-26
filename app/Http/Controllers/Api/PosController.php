<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PosController extends Controller
{
    public function GetProduct($id)
    {
        $product=DB::table('products')
            ->where('category_id',$id)
            ->get();
        return response()->json($product);
    }


    public function OrderDone(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
        ]);

        $data=array();
        $data['customer_id']=$request->customer_id;
        $data['qty']=$request->qty;
        $data['sub_total']=$request->subtotal;
        $data['vat']=$request->vat;
        $data['total']=$request->total;
        $data['payby']=$request->payby;
        $data['pay']=$request->pay;
        $data['due']=$request->due;
        $data['order_date']=date('Y-m-d');
        $data['order_month']=date('F');
        $data['order_year']=date('Y');
        $order_id=DB::table('orders')->insertGetId($data);  

        $contents=DB::table('pos')->get();

        $odata=array();
        foreach ($contents as $content) {
            $odata['order_id']=$order_id;
            $odata['product_id']=$content->pro_id;
            $odata['pro_quantity']=$content->pro_quantity;
            $odata['product_price']=$content->product_price;
            $odata['sub_total']=$content->sub_total;
            DB::table('order_details')->insert($odata);

            DB::table('products')
                ->where('id',$content->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity -' .$content->pro_quantity)]);

        }

        DB::table('pos')->delete();
        return response('done');
    }


//----------------------------------------- Card Dashboard Component
    public function MonthlySell()
    {
        $month = date('m');
        $year = date('Y');
        $sell = DB::table("orders")
            ->whereMonth('order_date',$month)
            ->whereYear('order_date',$year)
            ->sum('total');
        return response()->json($sell);
    }

    public function MonthlyIncome()
    {
        $month = date('m');
        $year = date('Y');
        $income = DB::table("orders")
            ->whereMonth('order_date',$month)
            ->whereYear('order_date',$year)
            ->sum('pay');
        return response()->json($income);
    }

    public function MonthlyDue()
    {
        $month = date('m');
        $year = date('Y');
        $due = DB::table("orders")
            ->whereMonth('order_date',$month)
            ->whereYear('order_date',$year)
            ->sum('due');
        return response()->json($due);
    }

    public function MonthlyExpense()
    {
        $month = date('m');
        $year = date('Y');
        $expense = DB::table("orders")
            ->whereMonth('order_date',$month)
            ->whereYear('order_date',$year)
            ->sum('amount');
        return response()->json($expense);
    }

    public function Stockout()
    {
        $stockout = DB::table("products")->get();
        return response()->json($stockout);
    }

}
