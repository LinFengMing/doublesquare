<?php

namespace App\Http\Controllers;

use App\Models\Parm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ParmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getFooter()
    {
        $parms = DB::select("select name, value from ds_parms where name IN ('footer_exhibition', 'footer_artist')");
        $result = [];
        foreach ($parms as $parm) {
            $result[$parm->name] = $parm->value;
        }

        return response()->json($result);
    }

    public function getContact()
    {
        $parms = DB::select("select name, value from ds_parms where name = 'email'");
        $result = [];
        foreach ($parms as $parm) {
            $result[$parm->name] = $parm->value;
        }

        return response()->json($result);
    }

    public function getNews()
    {
        $parms = DB::select("select name, value from ds_parms where name IN ('news_tw', 'news_en')");
        $result = [];
        foreach ($parms as $parm) {
            $result['news'][substr($parm->name, -2)] = $parm->value;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parm  $parm
     * @return \Illuminate\Http\Response
     */
    public function show(Parm $parm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parm  $parm
     * @return \Illuminate\Http\Response
     */
    public function edit(Parm $parm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parm  $parm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    public function updateFooter(Request $request)
    {
        $data = $request->json()->all();
        // $messages = [
        //     'required' => ':attribute 是必要的',
        //     'max' => ':attribute 的輸入超過上限',
        //     'url' => ':attribute 的輸入需為連結格式',
        // ];
        // $validator =  Validator::make($data, [
        //     'footer_exhibition' => 'required|max:255|url',
        //     'footer_artist' => 'required|max:255|url'
        // ]);

        // if($validator->fails()) {
        //     $error = [
        //         'error' => '400'
        //         ];

        //     return response()->json($error);
        // }
        //return response($validator->errors(), 400);
        //$footer_exhibition = $request->input('footer_exhibition');
        //$footer_artist = $request->input('footer_artist');
        $footer_exhibition = $data['footer_exhibition'];
        $footer_artist = $data['footer_artist'];

        DB::update("update ds_parms set value = ? where name = 'footer_exhibition'", [$footer_exhibition]);
        DB::update("update ds_parms set value = ? where name = 'footer_artist'", [$footer_artist]);

        return response()->json(null);
    }

    public function updateContact(Request $request)
    {
        $data = $request->json()->all();

        $email = $data['email'];

        DB::update("update ds_parms set value = ? where name = 'email'", [$email]);

        return response()->json(null);
    }

    public function updateNews(Request $request)
    {
        $data = $request->json()->all();

        $news_tw = $data['tw'];
        $news_en = $data['en'];

        DB::update("update ds_parms set value = ? where name = 'news_tw'", [$news_tw]);
        DB::update("update ds_parms set value = ? where name = 'news_en'", [$news_en]);

        return response()->json(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parm  $parm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parm $parm)
    {
        //
    }
}
