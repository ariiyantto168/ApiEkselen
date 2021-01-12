<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Models\Classes;
use App\Models\OrdersDetails;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;



class OrdersController extends Controller
{
    public function __construct(Request $request)
    {
        // $this->middleware('auth:api');
        // $this->request = $request;
        // // Set midtrans configuration
        // \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        // \Midtrans\Config::$clientKey    = config('services.midtrans.clientKey');
        // \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        // \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        // \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function create_save(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $all_total = 0;
        foreach ($request->details as $pr){
            $all_total += $pr['price'];
        }

        $saveOrders = new Orders;
        $saveOrders->idusers = Auth::user()->idusers;
        $saveOrders->total =  $all_total; // total semua harga kelas
        $saveOrders->codeorder = $this->code_orders();
        $saveOrders->status_order = 'pending';
        $saveOrders->status_payments = 'unpaid';
        $saveOrders->save();

        $details = [];
        $data_item = array();

         foreach ($request->details as $idx => $val) {
            $saveDetail = new OrdersDetails;
            $saveDetail->idclass = $val['idclass'];
            $saveDetail->price = $val['price'];
            $saveDetail->save();
           
            $data_item[$idx]['id'] = $val['idclass'];
            $data_item[$idx]['price'] = $val['price']; // get data price kelas
                       
            array_push($details, $saveDetail);
        }

    

        $transaction_details = array(
            'order_id'    => $this->code_orders(),
            'gross_amount'  => $saveOrders->total 
          );

        
        $items = json_decode( $data_item);
        

        // $customer_details = array(
        //     'first_name'       => "Andri",
        //     'last_name'        => "Setiawan",
        //     'email'            => "test@test.com",
        //     'phone'            => "081322311801",

        // );

        // $transaction_data = array(
        //     'transaction_details' => $transaction_details,
        //     'item_details'        => $items,
        //     'customer_details'    => $customer_details
        // );

        // // $token = $this->snaptoken($transaction_data);
        // $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);


        return response()->json([
            'headers' => $saveOrders,
            'details' => $details,
            // 'data_item' => $data_item ,
            // 'token' => $snapToken ,
            'code' => 200,
            'message' => 'Succesfull'
        ]);

    }

    protected function code_orders()
    {
        $date_ym = date('ym');
        $date_between =  [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')];
        $dataOrders = Orders::select('codeorder')
  			->whereBetween('created_at',$date_between)
  			->orderBy('codeorder','desc')
  			->first();
  		if(is_null($dataOrders)) {
  			$nowcode = '00001';
  		} else {
  			$lastcode = $dataOrders->codeorder;
  			$lastcode1 = intval(substr($lastcode, -5))+1;
  			$nowcode = str_pad($lastcode1, 5, '0', STR_PAD_LEFT);
  		}

  		return 'PO-'.$date_ym.'-'.$nowcode;

    }

    protected function snaptoken($transaction_data)
    {
        // $order = Orders::select('idorders');
        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $order,
        //         'gross_amount' => 10000,
        //     ),
        //     'customer_details' => array(
        //         'first_name' => 'budi',
        //         'last_name' => 'pratama',
        //         'email' => 'budi.pra@example.com',
        //         'phone' => '08111222333',
        //     ),
        // );

        // return $snapToken;
    }

    protected function total_orders()
    {
        return 'ok';
    }
}
