<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WisataResource;
use App\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Return the lokasi wisata list location for gis
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_wisata(Request $request)
    {
        $wisatas = Wisata::query()->with(['facilities', 'category']);
        $wisatas = $wisatas->where('latitude', '!=', NULL)
        ->where('latitude', '!=', '')
        ->where('longitude', '!=', NULL)
        ->where('longitude', '!=', '')
        ->get();

        $resourceWisata = WisataResource::collection($wisatas);

        return response()->json($resourceWisata);
    }

    public function get_all_wisata_front(Request $request)
    {
        $wisatas = Wisata::query()->with(['facilities', 'category']);
        $wisatas = $wisatas->where('latitude', '!=', NULL)
        ->where('latitude', '!=', '')
        ->where('longitude', '!=', NULL)
        ->where('longitude', '!=', '')
        ->get();

        $resourceWisata = WisataResource::collection($wisatas);

        return response()->json($resourceWisata);
    }
}
