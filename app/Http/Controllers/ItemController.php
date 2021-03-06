<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Symfony\Component\HttpFoundation\Response;
use App\Todo;
class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Todo $todo)
    {
        return ItemResource::collection($todo->items);
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
    public function store(Request $request, Todo $todo)
    {
        $validator = \Validator::make($request->all(), ['name'=> 'required']);
        
        if ($validator->fails()) {
    
            //pass validator errors as errors object for ajax response

          return response()->json(['errors'=>$validator->errors()]);
        }
        // if($todo->user_id !== \Auth::id())
        // {
        //     return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        // }
        $item = $todo->items()->create($request->all());
       
        return response(["hello",'item'=>$item,Response::HTTP_ACCEPTED]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validator = \Validator::make($request->all(), ['name'=> 'required']);
        
        if ($validator->fails()) {
    
            //pass validator errors as errors object for ajax response

          return response()->json(['errors'=>$validator->errors()]);
        }
        $item->update(['name' => $request->name]);

        return response('updated',Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, Item $item)
    {
        $item->delete();
        return response('Deleted',Response::HTTP_ACCEPTED);
    }
}
