<?php

namespace App\Http\Controllers;

use App\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $audioPath = false;
        if ($request->audio_recorded && $request->audio_recorded !== '') {
            $request->validate([
                'title' => 'required',
                'contact' => 'required',
            ]);
            $audioPath = $request->audio_recorded;
        } else {
            if ($request->hasFile('audio')) {
                $request->validate([
                    'title' => 'required',
                    'contact' => 'required',
                    'audio' => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
                ]);
                $audioPath = $this->processAudio($request);
                if (!is_array($audioPath)) {
                    echo $audioPath;
                } else {
                    return redirect()->back()->with('error', $audioPath['message']);
                }
                /*$uniqueid = uniqid();
                $original_name = $request->file('audio')->getClientOriginalName();
                $size = $request->file('audio')->getSize();
                $extension = $request->file('audio')->getClientOriginalExtension();
                $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;
                $audiopath = url('/storage/uploads/files/audio/' . $filename);
                $path = $request->audio->storeAs('public/uploads/files/audio/', $filename);
                $all_audios = $audiopath;*/
            }
        }
        if ($audioPath) {
            $call->title = $request->title;
            $call->audio = $audioPath;
            $call->contact = $request->contact;
            $save = $call->save();

            if ($save) {
                $username = 'MallaminKiwo'; // use 'sandbox' for development in the test environment
                $apiKey   = 'd9f408632536a46f0a79dbca8fb19a5bb80786dd17765ca7ab4417f54d247445'; // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);


                $voice = $AT->voice();

                $result   = $voice->call([
                    //'to'   => '+2347017580224',
                    'to'   => '+2348101075316',
                    'from' => '+2348132554349'
                ]);

                if ($result) {
                    return redirect()->back()->with('success', 'Audio message sent successfully');
                } else {
                    return redirect()->back()->with('error', 'An error occured');
                }
            } else {
                return redirect()->back()->with('error', 'An error occured');
            }
        } else {
            return redirect()->back()->with('error', 'No audio message was sent');
        }
    }

    /**
     * Process Audio and save to server
     *
     * @param  Request $request
     * @return Response
     */
    public function processAudio(Request $request)
    {
        if ($request->file('audio') && !$_FILES['audio']['error']) {
            $accepted = ['wav', 'ogg', 'mp3', 'aac'];
            if (in_array($request->file('audio')->getClientOriginalExtension(), $accepted)) {
                $fname = 'audio' . Carbon::now()->format('Ymd') . '_' . uniqid() . '.' . $request->file('audio')->getClientOriginalExtension();
                $path = $request->file('audio')->storeAs('audios', $fname);
                if ($path) {
                    $returnedPath = 'audios/' . $fname;
                    if (request()->ajax()) {
                        return response()->json($returnedPath, 200);
                    } else {
                        return $returnedPath;
                    }
                }
                if (request()->ajax()) {
                    return response()->json(['message' => 'Audio could not be saved!'], 200);
                } else {
                    return ['message' => 'Audio could not be saved!'];
                }
            }
            if (request()->ajax()) {
                return response()->json(['message' => 'File extension is not supported'], 200);
            } else {
                return ['message' => 'File extension is not supported'];
            }
        }
    }

    /**
     * Delete Audio from server
     *
     * @param  Request $request
     * @return Response
     */
    public function deleteAudio(Request $request)
    {
        $true = Storage::delete($request->fileName);
        if (request()->ajax()) {
            return response()->json($true, 200);
        } else {
            return $true;
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
