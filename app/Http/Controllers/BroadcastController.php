<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use AfricasTalking\SDK\AfricasTalking;
use App\Contact;


class BroadcastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $contacts = Contact::all();
        return view('broadcast.index')->with('contacts', $contacts);
    }

    /**       
     * Process Form
     *
     * @param  Request $request
     * @return Response
     */
    public function processForm(Request $request)
    {
        if ($request->contacts) {
            if ($request->audio_recorded && $request->audio_recorded !== '') {
                $audioPath = $request->audio_recorded;
            } else {
                if ($request->file('audio')) {
                    $audioPath = $this->processAudio($request);
                    if (!is_array($audioPath)) {
                        echo $audioPath;
                    } else {
                        return redirect()->back()->with('error', $audioPath['message']);
                    }
                } else {
                    return redirect()->back()->with('error', 'No audio file uploaded!');
                }
            }
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
            $accepted = ['wav', 'ogg', 'mp3'];
            if (in_array($request->file('audio')->getClientOriginalExtension(), $accepted)) {
                $fname = 'audio' . time() . rand(1000, 90000) . '.' . $request->file('audio')->getClientOriginalExtension();
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
}
