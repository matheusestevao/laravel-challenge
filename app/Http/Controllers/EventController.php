<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Auth;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allEvents = Event::where('user_id', Auth::user()->id)->get();

        return view('event.index', ['events' => $allEvents]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('event.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {

        $post = $request->all();
        
        $replaceDate = explode(" - ", $post['start_end_datetime']);

        $startDateTime = dateSysDB($replaceDate[0]);
        $endtDateTime  = dateSysDB($replaceDate[1]);

        $event = new Event();
        $event->user_id        = Auth::user()->id;
        $event->title          = $post['title'];
        $event->description    = $post['description'];
        $event->start_datetime = $startDateTime;
        $event->end_datetime   = $endtDateTime;
        $event->save();

        if ($event) {

            return redirect()
                        ->route('event.index')
                        ->with('success', 'Event Registration');

        } else {

            return redirect()
                        ->route('event.index')
                        ->with('error', 'Error Registering Event');

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
        
        $event = Event::find($id);
        
        return view('event.show', ['event' => $event]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $event = Event::find($id);
        $dateTime = dateDBSys($event->start_datetime).' - '.dateDBSys($event->end_datetime);
        
        return view('event.add', ['event' => $event, 'dateTime' => $dateTime]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        
        $post = $request->all();
        
        $event = Event::find($id);

        $replaceDate = explode(" - ", $post['start_end_datetime']);

        $startDateTime = dateSysDB($replaceDate[0]);
        $endtDateTime  = dateSysDB($replaceDate[1]);

        $event->title          = $post['title'];
        $event->description    = $post['description'];
        $event->start_datetime = $startDateTime;
        $event->end_datetime   = $endtDateTime;
        
        $update = $event->update();

        if ($update) {

            return redirect()
                        ->route('event.index')
                        ->with('sucess', 'Update Event');

        } else {

            return redirect()
                        ->route('event.index')
                        ->with('error', 'Event Update Error');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $event = Event::find($id)->delete();

        return 1;

    }

    public function import()
    {

        return view('event.import');

    }

    public function importsave(Request $request)
    {

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $userId = Auth::user()->id;

        unset($data[0]);

        foreach ($data as $value) {

            $event = new Event();
            $event->user_id        = $userId;
            $event->title          = $value[1];
            $event->description    = $value[2];
            $event->start_datetime = $value[3];
            $event->end_datetime   = $value[4];
            $event->save();

        }

        return redirect()
                    ->route('event.index')
                    ->with('sucess', 'CSV Import Successfully');

    }

    public function today()
    {

        $infoEvent = Array();

        $today = Event::where('user_id', Auth::user()->id)
                    ->whereRaw('? BETWEEN start_datetime AND end_datetime', date('Y-m-d H:i:s'))->get();

        ob_start();
        
        return ($infoEvent);

    }

    public function next()
    {   

        

    }

    public function all()
    {

        $infoEvent = Array();

        $allEvents = DB::table('events')
                            ->select('created_at', 'title', 'start_datetime', 'end_datetime')
                            ->where('user_id', Auth::user()->id)
                            ->where('id', 3)->get();

        foreach ($allEvents as $key => $value) {
            
            $infoEvent[] = array_values(get_object_vars($value));

        }
        
        return ($infoEvent);

    }

}
