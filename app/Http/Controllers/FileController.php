<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class FileController extends Controller
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
        $xmlstr = file_get_contents('php://input');
        $image = $xmlstr; //得到post过来的二进制原始数据
        $bin = substr($image, 0, 2);
        $strInfo = @unpack('C2chars', $bin);
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        $fileType = '';
        switch ($typeCode) {
         case 7790:
             $fileType = 'exe';
             break;
         case 7784:
             $fileType = 'midi';
             break;
         case 8297:
             $fileType = 'rar';
             break;
         case 255216:
             $fileType = 'jpg';
             break;
         case 7173:
             $fileType = 'gif';
             break;
         case 6677:
             $fileType = 'bmp';
             break;
         case 13780:
             $fileType = 'png';
             break;
         default:
             echo 'unknown';
        }

        if($fileType == 'unknown') {
            $error = [
                'error' => '400'
                ];

            return response()->json($error);
        }

        $fileName = Carbon::now()->timestamp. '.' .$fileType;
        $file = fopen(public_path('images/').$fileName, "w");//打开文件准备写入
        fwrite($file, $image);//写入
        fclose($file);//关闭
        $photoURL = url('images/'.$fileName);
        $url = [
            'src' => $photoURL
            ];

        return response()->json($url);
        // $file = $request->file('image');
        // $fileName = $file->getClientOriginalName();
        // $path = $file->move(public_path('/images'), $fileName);
        // $photoURL = url('images/'.$fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
