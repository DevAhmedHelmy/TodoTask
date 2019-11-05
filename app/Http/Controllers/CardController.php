<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use App\Http\Resources\CardResource;
use Symfony\Component\HttpFoundation\Response;
use App\Item;
use App\Todo;
class CardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Todo $todo,Item $item)
    {
         

       
        
        return CardResource::collection($item->cards);
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
    public function store(Request $request, Todo $todo,Item $item)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
            ]);
        // if (\Auth::user()->id !== $todo->user_id) {
        //     return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        // }

        
        $newCard = $todo->items()->find($item->id)->cards()->create($request->all());
        return response()->json(['message' => 'success','card' => $newCard], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
         return new CardResource($card);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Card $card)
    {
         

        // if (\Auth::user()->id !== $card->item->todo->user_id) {
        //     return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        // }
        

        
        // $card->update($request->all());
        $card = Card::findOrFail($card->id);
        $card->item_id = $request->item_id;
        if($card->save()){
            return response()->json(['message' => 'success','card' => $card], 200);
        }else {
            return response()->json(['message' => 'fail'], 200);
        }

        // return response()->json(['message' => 'success', 'card' => $card], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
         

        if (\Auth::user()->id !== $card->item->todo->user_id) {
            return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        }

        if ($card->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Card Deleted Successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
         
    }
}
