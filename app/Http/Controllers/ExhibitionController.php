<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use App\Models\ExhibitionAareas;
use App\Models\ExhibitionBareas;
use App\Models\ExhibitionCareaElements;
use App\Models\ExhibitionCareas;
use App\Models\ExhibitionDareas;
use App\Models\ExhibitionDareaLeftElements;
use App\Models\ExhibitionDareaMiddleElements;
use App\Models\ExhibitionDareaRightElements;
use App\Models\ExhibitionEareas;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exhibitions = Exhibition::all();

        $result = [];
        foreach ($exhibitions as $exhibition) {
            $result['exhibitions'][] = [
                'date' => $exhibition->date,
                'title' => [
                    'tw' => $exhibition->title_tw,
                    'en' => $exhibition->title_en
                ],
                'artist' => [
                    'tw' => $exhibition->artist_tw,
                    'en' => $exhibition->artist_en
                ],
                'desc' => [
                    'tw' => $exhibition->desc_tw,
                    'en' => $exhibition->desc_en
                ],
                'banner' => [
                    'pc' => $exhibition->banner_pc,
                    'mobile' => $exhibition->banner_mobile
                ],
                'id' => $exhibition->id,
                'type' => $exhibition->type
            ];
        }

        $parms = DB::select("select name, value from ds_parms where name IN ('news_tw', 'news_en')");
        foreach ($parms as $parm) {
            $result['news'][substr($parm->name, -2)] = $parm->value;
        }

        $types = Type::all();
        foreach ($types as $type) {
            $result['types'][] = [
                'id' => $type->id,
                'order' => $type->order,
                'tw' => $type->tw,
                'en' => $type->en
            ];
        }

        // $json = json_encode($result);
        // return response($json);
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
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //$data = $request->json()->all();
        $form = $request->all();
        if(count($form) > 0) {
            //$id = $data['id'];
            $id =  $form['id'];
            $check = Exhibition::find($id);
            if(!$check) {
                $error = [
                    'error' => 'INVALID_ID'
                    ];

                return response()->json($error);
            }
        }

        if(isset($id)) {
            $exhibition = Exhibition::with(['exhibitionAarea',
                                        'exhibitionBarea',
                                        'exhibitionCarea',
                                        'exhibitionDarea',
                                        'exhibitionEarea',
                                        'exhibitionCareaElements',
                                        'exhibitionDareaLeftElements',
                                        'exhibitionDareaMiddleElements',
                                        'exhibitionDareaRightElements'])
                                        ->where('id', $id)
                                        ->first();
        } else {
            $exhibition = Exhibition::with(['exhibitionAarea',
                                        'exhibitionBarea',
                                        'exhibitionCarea',
                                        'exhibitionDarea',
                                        'exhibitionEarea',
                                        'exhibitionCareaElements',
                                        'exhibitionDareaLeftElements',
                                        'exhibitionDareaMiddleElements',
                                        'exhibitionDareaRightElements'])
                                        ->orderBy('date','desc')
                                        ->take(1)
                                        ->first();
        }

        $dataJson = json_encode($exhibition);
        $data = json_decode($dataJson);

        $exhibitionAreas = DB::select(DB::raw('select * from ds_exhibitions where id <> :id LIMIT 3'), array(
            'id' => $data->id
        ));

        $exhibitions = [];
        foreach ($exhibitionAreas as $exhibitionArea) {
            array_push($exhibitions, [
                'date' => $exhibitionArea->date,
                'title' => [
                    'tw' => $exhibitionArea->title_tw,
                    'en' => $exhibitionArea->title_en
                ],
                'artist' => [
                    'tw' => $exhibitionArea->artist_tw,
                    'en' => $exhibitionArea->artist_en
                ],
                'desc' => [
                    'tw' => $exhibitionArea->desc_tw,
                    'en' => $exhibitionArea->desc_en
                ],
                'banner' => [
                    'pc' => $exhibitionArea->banner_pc,
                    'mobile' => $exhibitionArea->banner_mobile
                ],
                'id' =>$exhibitionArea->id,
                'type' =>$exhibitionArea->type
            ]);
        }

        $parmDatas = DB::select('select name, value from ds_parms');
        $parm = [];
        foreach ($parmDatas as $parmData) {
            $parm[$parmData->name] = $parmData->value;
        }

        $cImages = [];
        foreach ($data->exhibition_carea_elements as $careaElement) {
            array_push($cImages, [
                'src' => $careaElement->c_img_src,
                'video' => $careaElement->c_img_video,
                'form' => (boolean) $careaElement->c_img_form,
                'name' => [
                    'tw' => $careaElement->c_img_name_tw,
                    'en' => $careaElement->c_img_name_en
                ],
                'artist' => [
                    'tw' => $careaElement->c_img_artist_tw,
                    'en' => $careaElement->c_img_artist_en
                ],
                'year' => $careaElement->c_img_year,
                'size' => [
                    'tw' => $careaElement->c_img_size_tw,
                    'en' => $careaElement->c_img_size_en
                ],
                'media' => [
                    'tw' => $careaElement->c_img_media_tw,
                    'en' => $careaElement->c_img_media_en
                ],
            ]);
        }

        $dLeftImages = [];
        foreach ($data->exhibition_darea_left_elements as $dareaLeftElement) {
            array_push($dLeftImages, [
                'src' => $dareaLeftElement->d_left_img_src,
                'video' => $dareaLeftElement->d_left_img_video,
                'form' => (boolean) $dareaLeftElement->d_left_img_form,
                'name' => [
                    'tw' => $dareaLeftElement->d_left_img_name_tw,
                    'en' => $dareaLeftElement->d_left_img_name_en
                ],
                'artist' => [
                    'tw' => $dareaLeftElement->d_left_img_artist_tw,
                    'en' => $dareaLeftElement->d_left_img_artist_en
                ],
                'year' => $dareaLeftElement->d_left_img_year,
                'size' => [
                    'tw' => $dareaLeftElement->d_left_img_size_tw,
                    'en' => $dareaLeftElement->d_left_img_size_en
                ],
                'media' => [
                    'tw' => $dareaLeftElement->d_left_img_media_tw,
                    'en' => $dareaLeftElement->d_left_img_media_en
                ],
            ]);
        }

        $dMiddleImages = [];
        foreach ($data->exhibition_darea_middle_elements as $dareaMiddleElement) {
            array_push($dMiddleImages, [
                'src' => $dareaMiddleElement->d_middle_img_src,
                'video' => $dareaMiddleElement->d_middle_img_video,
                'form' => (boolean) $dareaMiddleElement->d_middle_img_form,
                'name' => [
                    'tw' => $dareaMiddleElement->d_middle_img_name_tw,
                    'en' => $dareaMiddleElement->d_middle_img_name_en
                ],
                'artist' => [
                    'tw' => $dareaMiddleElement->d_middle_img_artist_tw,
                    'en' => $dareaMiddleElement->d_middle_img_artist_en
                ],
                'year' => $dareaMiddleElement->d_middle_img_year,
                'size' => [
                    'tw' => $dareaMiddleElement->d_middle_img_size_tw,
                    'en' => $dareaMiddleElement->d_middle_img_size_en
                ],
                'media' => [
                    'tw' => $dareaMiddleElement->d_middle_img_media_tw,
                    'en' => $dareaMiddleElement->d_middle_img_media_en
                ],
            ]);
        }

        $dRightImages = [];
        foreach ($data->exhibition_darea_right_elements as $dareaRightElement) {
            array_push($dRightImages, [
                'src' => $dareaRightElement->d_right_img_src,
                'video' => $dareaRightElement->d_right_img_video,
                'form' => (boolean) $dareaRightElement->d_right_img_form,
                'name' => [
                    'tw' => $dareaRightElement->d_right_img_name_tw,
                    'en' => $dareaRightElement->d_right_img_name_en
                ],
                'artist' => [
                    'tw' => $dareaRightElement->d_right_img_artist_tw,
                    'en' => $dareaRightElement->d_right_img_artist_en
                ],
                'year' => $dareaRightElement->d_right_img_year,
                'size' => [
                    'tw' => $dareaRightElement->d_right_img_size_tw,
                    'en' => $dareaRightElement->d_right_img_size_en
                ],
                'media' => [
                    'tw' => $dareaRightElement->d_right_img_media_tw,
                    'en' => $dareaRightElement->d_right_img_media_en
                ],
            ]);
        }

        $dItems[0] = [
            'imgs' => $dLeftImages,
            'desc' => [
                'tw' => $data->exhibition_darea->d_left_desc_tw,
                'en' => $data->exhibition_darea->d_left_desc_en
            ]
        ];

        $dItems[1] = [
            'imgs' => $dMiddleImages,
            'desc' => [
                'tw' => $data->exhibition_darea->d_middle_desc_tw,
                'en' => $data->exhibition_darea->d_middle_desc_en
            ]
        ];

        $dItems[2] = [
            'imgs' => $dRightImages,
            'desc' => [
                'tw' => $data->exhibition_darea->d_right_desc_tw,
                'en' => $data->exhibition_darea->d_right_desc_en
            ]
        ];

        $result = [
            'id' => $data->id,
            'date' => $data->date,
            'title' => [
                'tw' => $data->title_tw,
                'en' => $data->title_en
            ],
            'artist' => [
                'tw' => $data->artist_tw,
                'en' => $data->artist_en
            ],
            'banner' => [
                'pc' => $data->banner_pc,
                'mobile' => $data->banner_mobile
            ],
            'desc' => [
                'tw' => $data->desc_tw,
                'en' => $data->desc_en
            ],
            'aside' => [
                [
                    'tw' => $data->aside_left_tw,
                    'en' => $data->aside_left_en
                ],
                [
                    'tw' => $data->aside_right_tw,
                    'en' => $data->aside_right_en
                ]
            ],
            'a' => [
                'img' => [
                    'src' => $data->exhibition_aarea->a_img_src,
                    'video' => $data->exhibition_aarea->a_img_video,
                    'form' => (boolean) $data->exhibition_aarea->a_img_form,
                    'name' => [
                        'tw' => $data->exhibition_aarea->a_img_name_tw,
                        'en' => $data->exhibition_aarea->a_img_name_en
                    ],
                    'artist' => [
                        'tw' => $data->exhibition_aarea->a_img_artist_tw,
                        'en' => $data->exhibition_aarea->a_img_artist_en
                    ],
                    'year' => $data->exhibition_aarea->a_img_year,
                    'size' => [
                        'tw' => $data->exhibition_aarea->a_img_size_tw,
                        'en' => $data->exhibition_aarea->a_img_size_en
                    ],
                    'media' => [
                        'tw' => $data->exhibition_aarea->a_img_media_tw,
                        'en' => $data->exhibition_aarea->a_img_media_en
                    ],
                ],
                'desc' => [
                    'tw' => $data->exhibition_aarea->a_desc_tw,
                    'en' => $data->exhibition_aarea->a_desc_en
                ],
                'order' => $data->exhibition_aarea->a_order
            ],
            'b' => [
                'left_img' => [
                    'src' => $data->exhibition_barea->b_left_img_src,
                    'video' => $data->exhibition_barea->b_left_img_video,
                    'form' => (boolean) $data->exhibition_barea->b_left_img_form,
                    'name' => [
                        'tw' => $data->exhibition_barea->b_left_img_name_tw,
                        'en' => $data->exhibition_barea->b_left_img_name_en
                    ],
                    'artist' => [
                        'tw' => $data->exhibition_barea->b_left_img_artist_tw,
                        'en' => $data->exhibition_barea->b_left_img_artist_en
                    ],
                    'year' => $data->exhibition_barea->b_left_img_year,
                    'size' => [
                        'tw' => $data->exhibition_barea->b_left_img_size_tw,
                        'en' => $data->exhibition_barea->b_left_img_size_en
                    ],
                    'media' => [
                        'tw' => $data->exhibition_barea->b_left_img_media_tw,
                        'en' => $data->exhibition_barea->b_left_img_media_en
                    ],
                ],
                'right_img' => $data->exhibition_barea->b_right_img_src,
                'right_desc' => [
                    'tw' => $data->exhibition_barea->b_right_desc_tw,
                    'en' => $data->exhibition_barea->b_right_desc_en
                ],
                'order' => $data->exhibition_barea->b_order
            ],
            'c' => [
                'imgs' => $cImages,
                'desc' => [
                    'tw' => $data->exhibition_carea->c_desc_tw,
                    'en' => $data->exhibition_carea->c_desc_en
                ],
                'order' => $data->exhibition_carea->c_order,
            ],
            'd' => [
                'items' => $dItems,
                'order' => $data->exhibition_darea->d_order
            ],
            'e' => [
                'desc' => [
                    'tw' => $data->exhibition_earea->e_desc_tw,
                    'en' => $data->exhibition_earea->e_desc_en
                ],
                'order' => $data->exhibition_earea->e_order
            ],
            'type' => $data->type,
            'exhibitions' => $exhibitions,
            'footer_exhibition' => $parm['footer_exhibition'],
            'footer_artist' => $parm['footer_artist']
        ];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function edit(Exhibition $exhibition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
