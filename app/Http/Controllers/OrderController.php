<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Orders;
use App\OrdersItem;
use App\payment_method;
use App\OrderTransaction;
use Symfony\Component\HttpFoundation\File;

class OrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('order.index');
    }

    public function orderReport() {
        return view('order.order-report');
    }
    
    public function orderReportToday() {
        return view('order.order-report-today');
    }

    public function orderspaidreport() {
        return view('order.paid');
    }

    public function orderscancelreport() {
        return view('order.cancel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $cat = Customer::all();
        $pro = Product::all();
        return view('order.create', ['cat' => $cat, 'pro' => $pro]);
    }

    public function filterorderproduct(Request $request) {
        $query = DB::table('products')->where('id', $request->pid)->get();
        return response()->json($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'due_date' => 'required',
            'invoice_date' => 'required',
            'cid' => 'required',
            'pid' => 'required'
        ]);







        $pro = new Orders;
        $pro->tracking = $request->tracking;
        $pro->cid = $request->cid;
        $pro->invoice_date = date('Y-m-d', strtotime($request->invoice_date));
        $pro->due_date = date('Y-m-d', strtotime($request->due_date));
        $pro->order_status = "Pending";
        $pro->save();

        $order_id = $pro->id;
        //print_r($request->tid);


        if (count($request->pid) != 0) {
            foreach ($request->pid as $index => $pid):
                if (!empty($request->pid[$index])) {
                    $protag = new OrdersItem();
                    $protag->pid = $request->pid[$index];
                    $protag->order_id = $order_id;
                    $protag->tracking = $request->tracking;
                    $protag->quantity = $request->quantity[$index];
                    $protag->unit_price = $request->unit_price[$index];
                    $protag->tax_rate = $request->tax_rate[$index];
                    $protag->tax_amount = $request->tax_amount[$index];
                    $protag->row_total = $request->row_total[$index];
                    $protag->save();
                }
            endforeach;
        }

        \Session::flash('status', 'Successfully Added To Order List');
        //->with('status', 'Successfully Added To Product List.')
        return redirect()->action('OrderController@index');
    }

    public function makepayment(Request $request) {
        $this->validate($request, [
            'amount' => 'required',
            'oid' => 'required',
            'paid' => 'required',
            'pm' => 'required',
            'os' => 'required'
        ]);
        $id = $request->oid;
        $order = Orders::find($id);
        $order->order_status = $request->os;
        $order->save();

        if ($request->os == 'Paid') {
            $jsoncus = DB::table('orders')
                    ->leftjoin('customers', 'orders.cid', '=', 'customers.id')
                    ->select('customers.*', 'customers.name', 'customers.email')
                    ->where('orders.id',$id)
                    ->first();
            $jsonorder = DB::table('orders')
                    ->leftjoin('customers', 'orders.cid', '=', 'customers.id')
                    ->select('orders.*', 'orders.cart', 'orders.order_status')
                    ->where('orders.id',$id)
                    ->first();
            $jsonamount = DB::table('orders')
                    ->leftjoin('order_transactions', 'orders.id', '=', 'order_transactions.order_id')
                    ->select('order_transactions.*', 'order_transactions.amount', 
                            
                            DB::raw("(SELECT payment_methods.name from payment_methods WHERE payment_methods.id=order_transactions.pm) AS payment")
                            )
                    ->where('orders.id',$id)
                    ->first();
            //echo '<pre>';
            //print_r($jsonamount);
            //exit();
            $customer_name = $jsoncus->name;
            $customer_email = $jsoncus->email;
            $invoice = $jsonorder->cart;
            $payment_method = $jsonamount->payment;
            $amount =$jsonamount->amount;
            

            $mail = new EmailController();
            $subject = "Thank You, You are successfully Paid with HiChoice.";
//        $htmlBody="Order Detail";
//        $htmlBody .="nextt dfdsf";

            $htmlBody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                        <head>
                          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                          <meta name="viewport" content="width=device-width">
                        </head>
                        <body style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;box-sizing:border-box;color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;min-width:100%;padding:0;text-align:left;width:100%!important; background-color: #ededed; padding-top:40px; padding-bottom:40px;">

     
                                  <table align="center" class="container booking-confirmation-payment" style="background:#fff;border-collapse:collapse;border-spacing:0;margin:0 auto;Margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px;">
                                    <tbody>
                                      <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td style="-moz-hyphens:none;-webkit-hyphens:none;border-collapse:collapse!important;color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;hyphens:none;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left;vertical-align:top;word-break:normal;word-wrap:normal">
                                          <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                              <tr style="padding:0;text-align:left;vertical-align:top; margin-top:10px">
                                                <th class="small-7 large-7 columns first" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:50px;padding-right:8px;text-align:left;width:322.33px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:left">Invoice No:</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                                <th class="small-5 large-5 columns last" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:8px;padding-right:50px;text-align:left;width:225.67px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p class="text-right" style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:right">'.$invoice.'</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                              <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-7 large-7 columns first" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:50px;padding-right:8px;text-align:left;width:322.33px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:left">Payment Method:</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                                <th class="small-5 large-5 columns last" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:8px;padding-right:50px;text-align:left;width:225.67px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p class="text-right" style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:right">'.$payment_method.'</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                              <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-7 large-7 columns first" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:50px;padding-right:8px;text-align:left;width:322.33px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:left">Amount:</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                                <th class="small-5 large-5 columns last" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:8px;padding-right:50px;text-align:left;width:225.67px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <p class="text-right" style="color:#6e6e6e;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;margin-bottom:4px;Margin-bottom:4px;padding:0;text-align:right">'.$amount.'</p>
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </th>
                                              </tr>
                                            </tbody>
                                          </table>


                                          <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                              <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;Margin:0 auto;padding:0;padding-bottom:0;padding-left:50px;padding-right:50px;text-align:left;width:564px">
                                                  <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                      <th style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0;text-align:left">
                                                        <h4 style="color:#09f;font-family:Helvetica,Arial,sans-serif;font-size:11px;font-weight:700;letter-spacing:-.03px;line-height:1.3;margin:0;Margin:0;margin-bottom:8px;Margin-bottom:8px;margin-top:8px;Margin-top:8px;padding:0;text-align:left;word-wrap:normal" align="center"><h3>Congrasulation,<br/> ' . $customer_name . ' You Order is successfully Paid with HiChoice</h3></h4>
                                                      </th>
                                                      <th class="expander" style="color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;Margin:0;padding:0!important;text-align:left;visibility:hidden;width:0"></th>
                                                    </tr>
                                                  </table>
                                                </th>
                                              </tr>
                                            </tbody>
                                          </table>';


            $htmlBody .= '<table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                                            <tbody>
                                              <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td height="16px" style="-moz-hyphens:none;-webkit-hyphens:none;border-collapse:collapse!important;color:#4d4d4d;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:none;line-height:16px;margin:0;Margin:0;padding:0;text-align:left;vertical-align:top;word-break:normal;word-wrap:normal">&#xA0;</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                          
                                          
                                          
                                          
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  


                          <!-- prevent Gmail on iOS font size manipulation -->
                          <div style="display:none;white-space:nowrap;font:15px courier;line-height:0; margin-bottom:20px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                         
                            </body>

                        </html>';
            $mail->sendEmail($subject, $htmlBody, $customer_email, $customer_name);
        }

        $pro = new OrderTransaction;
        $pro->order_id = $request->oid;
        $pro->amount = $request->paid;
        $pro->pm = $request->pm;
        $pro->save();

        $this->OrderStausUpdate($request->oid);

        $json = array($request->amount, $request->oid);
        $pm = payment_method::all();
        //->with('status', 'Successfully Added To Product List.')
        return redirect('admin-ecom/orders-view/' . $request->oid)->with('status', 'Payment Completed Successfully');
    }

    public function OrderStausUpdate($id) {
        $jsontrans = DB::table('order_transactions as ot')
                ->join('payment_methods as pm', 'ot.pm', '=', 'pm.id')
                ->select('ot.id', 'ot.amount', 'pm.name', 'ot.status')
                ->where('ot.order_id', '=', $id)
                ->orderBy('ot.id', 'ASC')
                ->get();

        $jsonitem = DB::table('orders as o')
                ->join('orders_items as oi', 'oi.order_id', '=', 'o.id')
                ->join('products as p', 'oi.pid', '=', 'p.id')
                ->select('oi.id', 'oi.tax_amount', 'oi.row_total')
                ->where('o.id', '=', $id)
                ->orderBy('oi.id', 'ASC')
                ->get();
        $order_total = 0;
        $vat_total = 0;
        $paid = 0;
        if (!empty($jsonitem)) {
            foreach ($jsonitem as $item):
                $order_total += $item->row_total;
                $vat_total += $item->tax_amount;
            endforeach;
        }

        if (!empty($jsontrans)) {
            foreach ($jsontrans as $item):
                $paid += $item->amount;
            endforeach;
        }

        $total = $order_total + $vat_total;
        $due = $total - $paid;
        if ($due < 0) {
            $ord = Orders::find($id);
            $ord->order_status = "Paid";
            $ord->save();
        }
    }

    public function orderdetail($id) {
        $json = DB::table('orders as o')
                ->leftjoin('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->where('o.id', '=', $id)
                ->orderBy('o.id', 'desc')
                ->get();


        $jsonitem = DB::table('orders as o')
                ->leftjoin('orders_items as oi', 'oi.order_id', '=', 'o.id')
                ->leftjoin('products as p', 'oi.pid', '=', 'p.id')
                ->select('oi.id', 'oi.pid', 'oi.unit', 'oi.color', 'p.name', 'oi.quantity', 'oi.unit_price', 'oi.tax_rate', 'oi.tax_amount', 'oi.row_total')
                ->where('o.id', '=', $id)
                ->orderBy('oi.id', 'ASC')
                ->get();

        $jsontrans = DB::table('order_transactions as ot')
                ->leftjoin('payment_methods as pm', 'ot.pm', '=', 'pm.id')
                ->select('ot.id', 'ot.amount', 'pm.name', 'ot.status')
                ->where('ot.order_id', '=', $id)
                ->orderBy('ot.id', 'ASC')
                ->get();

        

        return view('order.view', ['order' => $json, 'order_item' => $jsonitem, 'ot' => $jsontrans]);
    }

    public function payment($amount, $order_id) {
        $json = array($amount, $order_id);
        $pm = payment_method::all();
        return view('order.payment', ['order' => $json, 'pm' => $pm]);
    }

    public function showjson() {
        $json = DB::table('orders as o')
                ->leftjoin('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->orderBy('o.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function showReportjson() {
        $json = DB::table('orders as o')
                ->leftjoin('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->orderBy('o.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }
    public function showReporttodayjson() {
        $json = DB::table('orders as o')
                ->Leftjoin('customers as c', 'c.id', '=', 'o.cid')
                ->where('o.invoice_date',date('Y-m-d'))
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->orderBy('o.id', 'desc')
                ->groupBy('o.id')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function showjsonpaid() {
        $json = DB::table('orders as o')
                ->join('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->where('o.order_status', '=', 'Paid')
                ->orderBy('o.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function showjsonpening() {
        $json = DB::table('orders as o')
                ->join('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->where('o.order_status', '=', 'Pending')
                ->orderBy('o.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function showjsoncancel() {
        $json = DB::table('orders as o')
                ->join('customers as c', 'c.id', '=', 'o.cid')
                ->select('o.id', 'o.tracking', 'c.name', 'o.invoice_date', 'o.due_date', 'o.order_status', 'o.created_at')
                ->where('o.order_status', '=', 'Cancel')
                ->orderBy('o.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $cat = category::all();
        $brand = Brand::all();
        $tag = Tag::all();
        $subcat = SubCategory::all();
        $json = Product::find($id);

        $producttag = DB::table('product_tags as pt')
                ->select('pt.tid')
                ->where('pt.pid', '=', $id)
                ->get();
        $tpt = array();
        foreach ($producttag as $td):
            array_push($tpt, $td->tid);
        endforeach;

        //print_r($tpt);
        //exit();
        return view('product.edit', ['data' => $json, 'cat' => $cat, 'subcat' => $subcat, 'pt' => $tpt, 'tag' => $tag, 'brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'pcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'cid' => 'required',
            'scid' => 'required'
        ]);




        $filename = "";
        if (!empty($request->file('brandimage'))) {
            $img = $request->file('brandimage');
            $upload = 'upload\product';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }


        $pid = $request->id;
        $pro = Product::find($pid);
        $pro->pcode = $request->pcode;
        $pro->name = $request->name;
        $pro->price = $request->price;
        $pro->old_price = $request->old_price;
        $pro->cid = $request->cid;
        $pro->scid = $request->scid;
        $pro->bid = $request->bid;
        $pro->photo = $filename;
        $pro->description = $request->description;
        $pro->isactive = $request->isactive;
        $pro->save();


        //print_r($request->tid);


        if (count($request->tid) != 0) {
            $cleantag = DB::table('product_tags')->where('pid', '=', $pid)->delete();
            foreach ($request->tid as $index => $td):
                $protag = new ProductTag();
                $protag->pid = $pid;
                $protag->tid = $td;
                $protag->isactive = 1;
                $protag->save();
            endforeach;
        }

        \Session::flash('status', 'Successfully Updated To Product List');
        //->with('status', 'Successfully Added To Product List.')
        return redirect()->action('ProductController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $cleantag = DB::table('product_tags')->where('pid', '=', $id)->delete();
        $delinfo = Product::find($id);
        $delinfo->delete();
        //\Session::flash('status', 'Successfully Updated To Product List');
        //
        return response()->json(1);
    }

}
