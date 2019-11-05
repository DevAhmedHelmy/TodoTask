<?php

namespace App\Http\Controllers;

use App\Card;
use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\Generator\CombGenerator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), ['comment'=> 'required']);
        
        if ($validator->fails()) {
    
            //pass validator errors as errors object for ajax response

          return response()->json(['errors'=>$validator->errors()]);
        }


        // auth()->user()->comments()->create($request->all());
        Comment::create($request->all());

        return response('Created',Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        
        $cooment =  $card->comments;
        return response()->json(['comments'=>$cooment]);

        // $comment = Comment::where('card_id',$id);
        // return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validator = \Validator::make($request->all(), ['comment'=> 'required']);
        
        if ($validator->fails()) {
    
            //pass validator errors as errors object for ajax response

          return response()->json(['errors'=>$validator->errors()]);
        }


        // auth()->user()->comments()->create($request->all());
        $comment->update($request->all());

        return response(['Updated','comment'=>$comment,Response::HTTP_ACCEPTED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response('Deleted',Response::HTTP_ACCEPTED);
    }
}
