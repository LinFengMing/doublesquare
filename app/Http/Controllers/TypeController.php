<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        $result = [];
        foreach ($types as $type) {
            $result['types'][] = [
                'id' => $type->id,
                'order' => $type->order,
                'tw' => $type->tw,
                'en' => $type->en
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
            $type = Type::create([
                'tw' => $data['tw'],
                'en' => $data['en'],
                'order' => $data['order']
            ]);
        } catch (\Exception $e) {
            $error = [
                'error' => '500'
                ];

            return response()->json($error);
        }
        $result = [
            'id' => $type->id
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
        $type = Type::find($id);
            if(!$type) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        $dataJson = json_encode($type);
        $data = json_decode($dataJson);

        $result = [
            'id' => $data->id,
            'order' => $data->order,
            'tw' => $data->tw,
            'en' => $data->en
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
        $type = Type::find($id);
            if(!$type) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        try {
            $type->fill([
                'tw' => $data['tw'],
                'en' => $data['en'],
                'order' => $data['order']
            ]);
            $type->save();
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

        $type = TYpe::find($id);
        if(!$type) {
            $error = [
                'error' => 'INVALID_ID'
            ];

            return response()->json($error);
        }

        $parms = DB::select("select type from ds_exhibitions where type = ?", [$type->id]);
        if($parms) {
            $error = [
                'error' => 'NOT_EMPTY_TYPE'
            ];

            return response()->json($error);
        }
        $type->delete();

        return response()->json(null);
    }
}
