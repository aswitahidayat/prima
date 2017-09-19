<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mititi;

class MititiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return Mititi::where('deleted', 0)
                ->orderBy('id', 'asc')
                ->paginate(10);
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
        $this->validate($request, [
            'file' => 'required|max:500',
            'keterangan' => 'required|max:500'
        ]);

        return Mititi::firstOrCreate([ 
            'file' => $request->file,
            'keterangan' => $request->keterangan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Mititi::where('deleted', 0)
                ->where('id', $id)
                ->first();
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
        $this->validate($request, [
            'file' => 'required|max:500',
            'keterangan' => 'required|max:500'
        ]);

        return Mititi::where('deleted', 0)
        ->where('id', $id)
        ->update([
            'file' => $request->file,
            'keterangan' => $request->keterangan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Mititi::where('deleted', 0)
                ->where('id', $id)
                ->update(['deleted' => 1]);
                
    }
}
