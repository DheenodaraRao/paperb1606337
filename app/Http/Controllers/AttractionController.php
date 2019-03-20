<?php

namespace App\Http\Controllers;
use App\Attraction;
use App\Http\Resources\AttractionResource;
use App\Http\Resources\AttractionCollection;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attract = Attraction::with('city')->get();
        
        return new AttractionCollection($attract);
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
        $attract = Attraction::create($request->all());
        return response()->json([
            'id' => $attract->id,
            'created_at' => $attract->created_at,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attract = Attraction::with('city')->find($id);
        if(!$attract){
            return response()->json([
                'error'=> 404,
                'message'=> 'Not found'
            ], 404);
        }
        
        return new AttractionResource($attract);
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
        $attract = Attraction::find($id);
        if(!$attract) {
            return response()->json([
                'error' => 404,
                'message' => 'Not found'
            ], 404);
        }
        $attract->update($request->all());
        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attract = Attraction::find($id);
        if(!$attract) {
            return response()->json([
                'error' => 404,
                'message' => 'Not found'
            ], 404);
        }
        $attract->delete();
        return response()->json(null, 204);
    }
}
