<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\QRCode;
use Illuminate\Http\Request;

class QRCodeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data = QRCode::find(1);
        if (isset($data)) {
            return view('qrcode.index',['data'=>$data]);
        } else {
            return view('qrcode.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $this->validate($request, [
            'qrcode' => 'required',
        ]);

        //echo $request->name;
        //exit();
        $filename = "";
        if (!empty($request->file('qrcode'))) {
            $img = $request->file('qrcode');
            $upload = 'upload/qrcode';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }
        //echo $request->isactive;
        //exit();

        $bran = new QRCode;
        $bran->qrcode = $filename;
        $bran->save();

        return redirect('admin-ecom/qrcode')->with('status', 'qrcode Added Successfully!');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'qrcode' => 'required',
        ]);

        //echo $request->name;
        //exit();
        $filename = $request->exqrcode;
        if (!empty($request->file('qrcode'))) {
            $img = $request->file('qrcode');
            $upload = 'upload/qrcode';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }
        //echo $request->isactive;
        //exit();

        $bran = QRCode::find($request->id);
        $bran->QRCode = $filename;
        $bran->save();

        return redirect('admin-ecom/qrcode')->with('status', 'qrcode Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
   
}
