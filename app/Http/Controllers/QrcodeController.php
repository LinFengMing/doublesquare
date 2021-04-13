<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrcode;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qrcodes = Qrcode::all();

        $result = [];
        foreach ($qrcodes as $qrcode) {
            $result['items'][] = [
                'icon_dark' => $qrcode->icon_dark,
                'icon_light' => $qrcode->icon_light,
                'link' => $qrcode->link,
                'qr' => (boolean) $qrcode->qr,
                'id' => $qrcode->id,
                'order' => $qrcode->order
            ];
        }

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        try {
            $qrcode = Qrcode::create([
                'icon_dark' => $data['icon_dark'],
                'icon_light' => $data['icon_light'],
                'link' => $data['link'],
                'qr' => $data['qr'],
                'order' => $data['order']
            ]);
        } catch (\Exception $e) {
            $error = [
                'error' => '500'
                ];

            return response()->json($error);
        }
        $result = [
            'id' => $qrcode->id
        ];

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $data = $request->json()->all();
        // $id = $data['id'];
        $form = $request->all();
        $id =  $form['id'];
        $qrcode = Qrcode::find($id);
            if(!$qrcode) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        $dataJson = json_encode($qrcode);
        $data = json_decode($dataJson);

        $result = [
            'icon_dark' => $data->icon_dark,
            'icon_light' => $data->icon_light,
            'link' => $data->link,
            'qr' => (boolean) $data->qr,
            'order' => $data->order
        ];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();
        $id = $data['id'];
        $qrcode = Qrcode::find($id);
            if(!$qrcode) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        try {
            $qrcode->fill([
                'icon_dark' => $data['icon_dark'],
                'icon_light' => $data['icon_light'],
                'link' => $data['link'],
                'qr' => $data['qr'],
                'order' => $data['order']
            ]);
            $qrcode->save();
        } catch (\Exception $e) {
            $error = [
                'error' => '500'
                ];

            return response()->json($error);
        }

        return response()->json(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        $id = $data['id'];
        $qrcode = Qrcode::find($id);
            if(!$qrcode) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        $qrcode->delete();

        return response()->json(null);
    }
}
