<?php

namespace App\Http\Controllers;

use App\Call;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use Carbon\Carbon;


class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('call.index');
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
    public function store(Request $request, Call $call)
    {
        //
        if($request->hasFile('audio')){
            $request->validate([
                'title' => 'required',
                'contact' => 'required',
                'audio' =>'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
            ]);

         $uniqueid=uniqid();
         $original_name=$request->file('audio')->getClientOriginalName();
         $size=$request->file('audio')->getSize();
         $extension=$request->file('audio')->getClientOriginalExtension();
         $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
         $audiopath=url('/storage/uploads/files/audio/'.$filename);
         $path=$request->audio->storeAs('public/uploads/files/audio/',$filename);
         $all_audios=$audiopath;

         $call->title = $request->title;
         $call->audio = $filename;
         $call->contact = $request->contact;
         $save = $call->save();

         if ($save) {
            $username = 'MallaminKiwo'; // use 'sandbox' for development in the test environment
             $apiKey   = 'd9f408632536a46f0a79dbca8fb19a5bb80786dd17765ca7ab4417f54d247445'; // use your sandbox app API key for development in the test environment
             $AT = new AfricasTalking($username, $apiKey);


             $voice = $AT->voice();

             $result   = $voice->call([
                    'to'   => '+2347017580224',
                    'from' => '+2348132554349'
                ]);

             if ($result) {
                return redirect()->back()->with('success', 'Audio message sent successfully');
             } else {
                 return redirect()->back()->with('error', 'An error occured');
             }
             
        }else{
            return redirect()->back()->with('error', 'An error occured');
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Call $call)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
        //
    }
}
