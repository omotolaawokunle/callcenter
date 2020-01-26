<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SMS;
use AfricasTalking\SDK\AfricasTalking;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('sms.index');
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
        $validateData = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'contact' => 'required'
        ]);
        $sms = SMS::create($request->all());

        if ($sms) {
           $username = 'MallaminKiwo'; // use 'sandbox' for development in the test environment
            $apiKey   = 'd9f408632536a46f0a79dbca8fb19a5bb80786dd17765ca7ab4417f54d247445'; // use your sandbox app API key for development in the test environment
            $AT = new AfricasTalking($username, $apiKey);

            // Get one of the services
            $sms      = $AT->sms();

            // Use the service
            $result   = $sms->send([
                'to'      => '+2348132554349',
                'message' => $request->message,
                'from' => '9323'
            ]);

            if ($result) {
                return redirect()->back()->with('success', 'Message sent successfully');
            } else {
                return redirect()->back()->with('error', 'An error occured');
            }

            } else {
                return redirect()->back()->with('error', "An error occured");
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
