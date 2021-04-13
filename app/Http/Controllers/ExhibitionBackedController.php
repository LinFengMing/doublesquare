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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExhibitionBackedController extends Controller
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
                // 'desc' => [
                //     'tw' => $exhibition->desc_tw,
                //     'en' => $exhibition->desc_en
                // ],
                // 'banner' => [
                //     'pc' => $exhibition->banner_pc,
                //     'mobile' => $exhibition->banner_mobile
                // ],
                'id' => $exhibition->id
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
        $data = $request->json()->all();
        DB::beginTransaction();
        try {
            $exhibition = Exhibition::create([
                'type' => $data['type'],
                'date' => $data['date'],
                'title_tw' => $data['title']['tw'],
                'title_en' => $data['title']['en'],
                'artist_tw' => $data['artist']['tw'],
                'artist_en' => $data['artist']['en'],
                'banner_pc' => $data['banner']['pc'],
                'banner_mobile' => $data['banner']['mobile'],
                'desc_tw' => $data['desc']['tw'],
                'desc_en' => $data['desc']['en'],
                'aside_left_tw' => $data['aside'][0]['tw'],
                'aside_left_en' => $data['aside'][0]['en'],
                'aside_right_tw' => $data['aside'][1]['tw'],
                'aside_right_en' => $data['aside'][1]['en']
            ]);

            $exhibitionAareas = ExhibitionAareas::create([
                'exhibition_id' => $exhibition->id,
                'a_img_src' => $data['a']['img']['src'],
                'a_img_video' => $data['a']['img']['video'],
                'a_img_form' => $data['a']['img']['form'],
                'a_img_name_tw' => $data['a']['img']['name']['tw'],
                'a_img_name_en' => $data['a']['img']['name']['en'],
                'a_img_artist_tw' => $data['a']['img']['artist']['tw'],
                'a_img_artist_en' => $data['a']['img']['artist']['en'],
                'a_img_year' => $data['a']['img']['year'],
                'a_img_size_tw' => $data['a']['img']['size']['tw'],
                'a_img_size_en' => $data['a']['img']['size']['en'],
                'a_img_media_tw' => $data['a']['img']['media']['tw'],
                'a_img_media_en' => $data['a']['img']['media']['en'],
                'a_desc_tw' => $data['a']['desc']['tw'],
                'a_desc_en' => $data['a']['desc']['en'],
                'a_order' => $data['a']['order']
            ]);

            $exhibitionBareas = ExhibitionBareas::create([
                'exhibition_id' => $exhibition->id,
                'b_left_img_src' => $data['b']['left_img']['src'],
                'b_left_img_video' => $data['b']['left_img']['video'],
                'b_left_img_form' => $data['b']['left_img']['form'],
                'b_left_img_name_tw' => $data['b']['left_img']['name']['tw'],
                'b_left_img_name_en' => $data['b']['left_img']['name']['en'],
                'b_left_img_artist_tw' => $data['b']['left_img']['artist']['tw'],
                'b_left_img_artist_en' => $data['b']['left_img']['artist']['en'],
                'b_left_img_year' => $data['b']['left_img']['year'],
                'b_left_img_size_tw' => $data['b']['left_img']['size']['tw'],
                'b_left_img_size_en' => $data['b']['left_img']['size']['en'],
                'b_left_img_media_tw' => $data['b']['left_img']['media']['tw'],
                'b_left_img_media_en' => $data['b']['left_img']['media']['en'],
                'b_right_img_src' => $data['b']['right_img'],
                'b_right_desc_tw' => $data['b']['right_desc']['tw'],
                'b_right_desc_en' => $data['b']['right_desc']['en'],
                'b_order' =>$data['b']['order']
            ]);

            $exhibitionCareas = ExhibitionCareas::create([
                'exhibition_id' => $exhibition->id,
                'c_desc_tw' => $data['c']['desc']['tw'],
                'c_desc_en' => $data['c']['desc']['en'],
                'c_order' => $data['c']['order']
            ]);

            $careaElements = $data['c']['imgs'];
            foreach ($careaElements as $careaElement) {
                $exhibitionCareaElements = ExhibitionCareaElements::create([
                    'c_area_id' => $exhibitionCareas->id,
                    'c_img_src' => $careaElement['src'],
                    'c_img_video' => $careaElement['video'],
                    'c_img_form' => $careaElement['form'],
                    'c_img_name_tw' => $careaElement['name']['tw'],
                    'c_img_name_en' => $careaElement['name']['en'],
                    'c_img_artist_tw' => $careaElement['artist']['tw'],
                    'c_img_artist_en' => $careaElement['artist']['en'],
                    'c_img_year' => $careaElement['year'],
                    'c_img_size_tw' => $careaElement['size']['tw'],
                    'c_img_size_en' => $careaElement['size']['en'],
                    'c_img_media_tw' => $careaElement['media']['tw'],
                    'c_img_media_en' => $careaElement['media']['en']
                ]);
            }

            $exhibitionDareas = ExhibitionDareas::create([
                'exhibition_id' => $exhibition->id,
                'd_left_desc_tw' => $data['d']['items'][0]['desc']['tw'],
                'd_left_desc_en' => $data['d']['items'][0]['desc']['en'],
                'd_middle_desc_tw' => $data['d']['items'][1]['desc']['tw'],
                'd_middle_desc_en' => $data['d']['items'][1]['desc']['en'],
                'd_right_desc_tw' => $data['d']['items'][2]['desc']['tw'],
                'd_right_desc_en' => $data['d']['items'][2]['desc']['en'],
                'd_order' => $data['d']['order']
            ]);

            $dareaLeftElements = $data['d']['items'][0]['imgs'];
            foreach ($dareaLeftElements as $dareaLeftElement) {
                $exhibitionDareaLeftElements = ExhibitionDareaLeftElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_left_img_src' => $dareaLeftElement['src'],
                    'd_left_img_video' => $dareaLeftElement['video'],
                    'd_left_img_form' => $dareaLeftElement['form'],
                    'd_left_img_name_tw' => $dareaLeftElement['name']['tw'],
                    'd_left_img_name_en' => $dareaLeftElement['name']['en'],
                    'd_left_img_artist_tw' => $dareaLeftElement['artist']['tw'],
                    'd_left_img_artist_en' => $dareaLeftElement['artist']['en'],
                    'd_left_img_year' => $dareaLeftElement['year'],
                    'd_left_img_size_tw' => $dareaLeftElement['size']['tw'],
                    'd_left_img_size_en' => $dareaLeftElement['size']['en'],
                    'd_left_img_media_tw' => $dareaLeftElement['media']['tw'],
                    'd_left_img_media_en' => $dareaLeftElement['media']['en']
                ]);
            }

            $dareaMiddleElements = $data['d']['items'][1]['imgs'];
            foreach ($dareaMiddleElements as $dareaMiddleElement) {
                $exhibitionDareaMiddleElements = ExhibitionDareaMiddleElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_middle_img_src' => $dareaMiddleElement['src'],
                    'd_middle_img_video' => $dareaMiddleElement['video'],
                    'd_middle_img_form' => $dareaMiddleElement['form'],
                    'd_middle_img_name_tw' => $dareaMiddleElement['name']['tw'],
                    'd_middle_img_name_en' => $dareaMiddleElement['name']['en'],
                    'd_middle_img_artist_tw' => $dareaMiddleElement['artist']['tw'],
                    'd_middle_img_artist_en' => $dareaMiddleElement['artist']['en'],
                    'd_middle_img_year' => $dareaMiddleElement['year'],
                    'd_middle_img_size_tw' => $dareaMiddleElement['size']['tw'],
                    'd_middle_img_size_en' => $dareaMiddleElement['size']['en'],
                    'd_middle_img_media_tw' => $dareaMiddleElement['media']['tw'],
                    'd_middle_img_media_en' => $dareaMiddleElement['media']['en']
                ]);
            }

            $dareaRightElements = $data['d']['items'][2]['imgs'];
            foreach ($dareaRightElements as $dareaRightElement) {
                $exhibitionDareaRightElements = ExhibitionDareaRightElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_right_img_src' => $dareaRightElement['src'],
                    'd_right_img_video' => $dareaRightElement['video'],
                    'd_right_img_form' => $dareaRightElement['form'],
                    'd_right_img_name_tw' => $dareaRightElement['name']['tw'],
                    'd_right_img_name_en' => $dareaRightElement['name']['en'],
                    'd_right_img_artist_tw' => $dareaRightElement['artist']['tw'],
                    'd_right_img_artist_en' => $dareaRightElement['artist']['en'],
                    'd_right_img_year' => $dareaRightElement['year'],
                    'd_right_img_size_tw' => $dareaRightElement['size']['tw'],
                    'd_right_img_size_en' => $dareaRightElement['size']['en'],
                    'd_right_img_media_tw' => $dareaRightElement['media']['tw'],
                    'd_right_img_media_en' => $dareaRightElement['media']['en']
                ]);
            }

            $exhibitionEareas = ExhibitionEareas::create([
                'exhibition_id' => $exhibition->id,
                'e_desc_tw' => $data['e']['desc']['tw'],
                'e_desc_en' =>  $data['e']['desc']['en'],
                'e_order' => $data['e']['order']
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //return response(500, $e->getMessage());
            $error = [
                'error' => '500'
                ];

            return response()->json($error);
        }
        DB::commit();

        $result = [
            'id' => $exhibition->id
        ];

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $data = $request->json()->all();
        // $id = $data['id'];
        $form = $request->all();
        $id =  $form['id'];
        $check = Exhibition::find($id);
            if(!$check) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        $exhibition = Exhibition::with(['exhibitionAarea',
                                        'exhibitionBarea',
                                        'exhibitionCarea',
                                        'exhibitionDarea',
                                        'exhibitionEarea',
                                        'exhibitionCareaElements',
                                        'exhibitionDareaLeftElements',
                                        'exhibitionDareaMiddleElements',
                                        'exhibitionDareaRightElements'])
                                        ->where('id', $id)->first();

        $dataJson = json_encode($exhibition);
        $data = json_decode($dataJson);

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
                ]
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
                ]
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
                ]
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
                ]
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
            'type' => $data->type,
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
                    ]
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
                    ]
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
                'order' => $data->exhibition_carea->c_order
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
            ]
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
        $data = $request->json()->all();
        $id = $data['id'];
        $check = Exhibition::find($id);
            if(!$check) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }
        DB::beginTransaction();
        try {
            $exhibition = Exhibition::find($data['id']);
            $exhibition->fill([
                'type' => $data['type'],
                'date' => $data['date'],
                'title_tw' => $data['title']['tw'],
                'title_en' => $data['title']['en'],
                'artist_tw' => $data['artist']['tw'],
                'artist_en' => $data['artist']['en'],
                'banner_pc' => $data['banner']['pc'],
                'banner_mobile' => $data['banner']['mobile'],
                'desc_tw' => $data['desc']['tw'],
                'desc_en' => $data['desc']['en'],
                'aside_left_tw' => $data['aside'][0]['tw'],
                'aside_left_en' => $data['aside'][0]['en'],
                'aside_right_tw' => $data['aside'][1]['tw'],
                'aside_right_en' => $data['aside'][1]['en']
            ]);
            $exhibition->save();

            $exhibitionAareas = ExhibitionAareas::where('exhibition_id', $exhibition->id)->first();
            $exhibitionAareas->fill([
                'a_img_src' => $data['a']['img']['src'],
                'a_img_video' => $data['a']['img']['video'],
                'a_img_form' => $data['a']['img']['form'],
                'a_img_name_tw' => $data['a']['img']['name']['tw'],
                'a_img_name_en' => $data['a']['img']['name']['en'],
                'a_img_artist_tw' => $data['a']['img']['artist']['tw'],
                'a_img_artist_en' => $data['a']['img']['artist']['en'],
                'a_img_year' => $data['a']['img']['year'],
                'a_img_size_tw' => $data['a']['img']['size']['tw'],
                'a_img_size_en' => $data['a']['img']['size']['en'],
                'a_img_media_tw' => $data['a']['img']['media']['tw'],
                'a_img_media_en' => $data['a']['img']['media']['en'],
                'a_desc_tw' => $data['a']['desc']['tw'],
                'a_desc_en' => $data['a']['desc']['en'],
                'a_order' => $data['a']['order']
            ]);
            $exhibitionAareas->save();

            $exhibitionBareas = ExhibitionBareas::where('exhibition_id', $exhibition->id)->first();
            $exhibitionBareas->fill([
                'b_left_img_src' => $data['b']['left_img']['src'],
                'b_left_img_video' => $data['b']['left_img']['video'],
                'b_left_img_form' => $data['b']['left_img']['form'],
                'b_left_img_name_tw' => $data['b']['left_img']['name']['tw'],
                'b_left_img_name_en' => $data['b']['left_img']['name']['en'],
                'b_left_img_artist_tw' => $data['b']['left_img']['artist']['tw'],
                'b_left_img_artist_en' => $data['b']['left_img']['artist']['en'],
                'b_left_img_year' => $data['b']['left_img']['year'],
                'b_left_img_size_tw' => $data['b']['left_img']['size']['tw'],
                'b_left_img_size_en' => $data['b']['left_img']['size']['en'],
                'b_left_img_media_tw' => $data['b']['left_img']['media']['tw'],
                'b_left_img_media_en' => $data['b']['left_img']['media']['en'],
                'b_right_img_src' => $data['b']['right_img'],
                'b_right_desc_tw' => $data['b']['right_desc']['tw'],
                'b_right_desc_en' => $data['b']['right_desc']['en'],
                'b_order' =>$data['b']['order']
            ]);
            $exhibitionBareas->save();

            $exhibitionCareas = ExhibitionCareas::where('exhibition_id', $exhibition->id)->first();
            $exhibitionCareas->fill([
                'c_desc_tw' => $data['c']['desc']['tw'],
                'c_desc_en' => $data['c']['desc']['en'],
                'c_order' => $data['c']['order']
            ]);
            $exhibitionCareas->save();

            ExhibitionCareaElements::where('c_area_id', $exhibitionCareas->id)->delete();
            $careaElements = $data['c']['imgs'];
            foreach ($careaElements as $careaElement) {
                $exhibitionCareaElements = ExhibitionCareaElements::create([
                    'c_area_id' => $exhibitionCareas->id,
                    'c_img_src' => $careaElement['src'],
                    'c_img_video' => $careaElement['video'],
                    'c_img_form' => $careaElement['form'],
                    'c_img_name_tw' => $careaElement['name']['tw'],
                    'c_img_name_en' => $careaElement['name']['en'],
                    'c_img_artist_tw' => $careaElement['artist']['tw'],
                    'c_img_artist_en' => $careaElement['artist']['en'],
                    'c_img_year' => $careaElement['year'],
                    'c_img_size_tw' => $careaElement['size']['tw'],
                    'c_img_size_en' => $careaElement['size']['en'],
                    'c_img_media_tw' => $careaElement['media']['tw'],
                    'c_img_media_en' => $careaElement['media']['en']
                ]);
            }

            $exhibitionDareas = ExhibitionDareas::where('exhibition_id', $exhibition->id)->first();
            $exhibitionDareas->fill([
                'd_left_desc_tw' => $data['d']['items'][0]['desc']['tw'],
                'd_left_desc_en' => $data['d']['items'][0]['desc']['en'],
                'd_middle_desc_tw' => $data['d']['items'][1]['desc']['tw'],
                'd_middle_desc_en' => $data['d']['items'][1]['desc']['en'],
                'd_right_desc_tw' => $data['d']['items'][2]['desc']['tw'],
                'd_right_desc_en' => $data['d']['items'][2]['desc']['en'],
                'd_order' => $data['d']['order']
            ]);
            $exhibitionDareas->save();

            ExhibitionDareaLeftElements::where('d_area_id', $exhibitionDareas->id)->delete();
            $dareaLeftElements = $data['d']['items'][0]['imgs'];
            foreach ($dareaLeftElements as $dareaLeftElement) {
                $exhibitionDareaLeftElements = ExhibitionDareaLeftElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_left_img_src' => $dareaLeftElement['src'],
                    'd_left_img_video' => $dareaLeftElement['video'],
                    'd_left_img_form' => $dareaLeftElement['form'],
                    'd_left_img_name_tw' => $dareaLeftElement['name']['tw'],
                    'd_left_img_name_en' => $dareaLeftElement['name']['en'],
                    'd_left_img_artist_tw' => $dareaLeftElement['artist']['tw'],
                    'd_left_img_artist_en' => $dareaLeftElement['artist']['en'],
                    'd_left_img_year' => $dareaLeftElement['year'],
                    'd_left_img_size_tw' => $dareaLeftElement['size']['tw'],
                    'd_left_img_size_en' => $dareaLeftElement['size']['en'],
                    'd_left_img_media_tw' => $dareaLeftElement['media']['tw'],
                    'd_left_img_media_en' => $dareaLeftElement['media']['en']
                ]);
            }

            ExhibitionDareaMiddleElements::where('d_area_id', $exhibitionDareas->id)->delete();
            $dareaMiddleElements = $data['d']['items'][1]['imgs'];
            foreach ($dareaMiddleElements as $dareaMiddleElement) {
                $exhibitionDareaMiddleElements = ExhibitionDareaMiddleElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_middle_img_src' => $dareaMiddleElement['src'],
                    'd_middle_img_video' => $dareaMiddleElement['video'],
                    'd_middle_img_form' => $dareaMiddleElement['form'],
                    'd_middle_img_name_tw' => $dareaMiddleElement['name']['tw'],
                    'd_middle_img_name_en' => $dareaMiddleElement['name']['en'],
                    'd_middle_img_artist_tw' => $dareaMiddleElement['artist']['tw'],
                    'd_middle_img_artist_en' => $dareaMiddleElement['artist']['en'],
                    'd_middle_img_year' => $dareaMiddleElement['year'],
                    'd_middle_img_size_tw' => $dareaMiddleElement['size']['tw'],
                    'd_middle_img_size_en' => $dareaMiddleElement['size']['en'],
                    'd_middle_img_media_tw' => $dareaMiddleElement['media']['tw'],
                    'd_middle_img_media_en' => $dareaMiddleElement['media']['en']
                ]);
            }

            ExhibitionDareaRightElements::where('d_area_id', $exhibitionDareas->id)->delete();
            $dareaRightElements = $data['d']['items'][2]['imgs'];
            foreach ($dareaRightElements as $dareaRightElement) {
                $exhibitionDareaRightElements = ExhibitionDareaRightElements::create([
                    'd_area_id' => $exhibitionDareas->id,
                    'd_right_img_src' => $dareaRightElement['src'],
                    'd_right_img_video' => $dareaRightElement['video'],
                    'd_right_img_form' => $dareaRightElement['form'],
                    'd_right_img_name_tw' => $dareaRightElement['name']['tw'],
                    'd_right_img_name_en' => $dareaRightElement['name']['en'],
                    'd_right_img_artist_tw' => $dareaRightElement['artist']['tw'],
                    'd_right_img_artist_en' => $dareaRightElement['artist']['en'],
                    'd_right_img_year' => $dareaRightElement['year'],
                    'd_right_img_size_tw' => $dareaRightElement['size']['tw'],
                    'd_right_img_size_en' => $dareaRightElement['size']['en'],
                    'd_right_img_media_tw' => $dareaRightElement['media']['tw'],
                    'd_right_img_media_en' => $dareaRightElement['media']['en']
                ]);
            }

            $exhibitionEareas = ExhibitionEareas::where('exhibition_id', $exhibition->id)->first();
            $exhibitionEareas->fill([
                'e_desc_tw' => $data['e']['desc']['tw'],
                'e_desc_en' =>  $data['e']['desc']['en'],
                'e_order' => $data['e']['order']
            ]);
            $exhibitionEareas->save();
        } catch (\Exception $e) {
            DB::rollback();
            //return response(500, $e->getMessage());
            $error = [
                'error' => '500'
                ];

            return response()->json($error);
        }
        DB::commit();

        return response()->json(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        $id = $data['id'];
        $check = Exhibition::find($id);
            if(!$check) {
                $error = [
                    'error' => 'INVALID_ID'
                ];

            return response()->json($error);
        }

        $carea = ExhibitionCareas::where('exhibition_id', $id)->first();
        $careaid = $carea->id;
        $darea = ExhibitionDareas::where('exhibition_id', $id)->first();
        $dareaid = $darea->id;

        DB::beginTransaction();
        try {
            ExhibitionCareaElements::where('c_area_id', $careaid)->delete();
            ExhibitionDareaLeftElements::where('d_area_id', $dareaid)->delete();
            ExhibitionDareaMiddleElements::where('d_area_id', $dareaid)->delete();
            ExhibitionDareaRightElements::where('d_area_id', $dareaid)->delete();
            ExhibitionAareas::where('exhibition_id', $id)->delete();
            ExhibitionBareas::where('exhibition_id', $id)->delete();
            ExhibitionCareas::where('exhibition_id', $id)->delete();
            ExhibitionDareas::where('exhibition_id', $id)->delete();
            ExhibitionEareas::where('exhibition_id', $id)->delete();
            Exhibition::find($id)->delete();
        } catch (\Exception $e) {
            DB::rollback();

            return response(500, $e->getMessage());
        }
        DB::commit();

        return response()->json(null);
    }
}
