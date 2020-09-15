<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Location;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{

  private $LocationObj;

  public function __construct()
  {
    $this->LocationObj = new Location();
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $locations = $this->LocationObj->all();
      return view('locations', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-location');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
      $stored = $this->LocationObj->create([
        'aisle'=>$request->aisle,
        'shelf'=>$request->shelf,
        'side'=>$request->side,
      ]);
      return redirect('locations');
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
      $location = $this->LocationObj->find($id);
      return view('create-location', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
      $this->LocationObj->where(['id'=>$id])->update([
        'aisle'=>$request->aisle,
        'shelf'=>$request->shelf,
        'side'=>$request->side
      ]);
      return redirect('locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->LocationObj->destroy($id);
        return $deleted ? "OK deleting Location $id" : "FAIL deleting Location $id";
    }
}
