<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Location;
use App\Models\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
  private $ProductObj;
  private $LocationObj;

  public function __construct()
  {
    $this->ProductObj = new Product();
    $this->LocationObj = new Location();
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = $this->ProductObj->all();
      $locations = $this->LocationObj->all();
      return view('index', compact('products', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
      $this->ProductObj->create([
        'id_location'=>$request->location,
        'name'=>$request->product,
        'description'=>$request->description,
        'price'=>$request->price,
      ]);
      return redirect('products');
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
      $product = $this->ProductObj->find($id);
      $locations = $this->LocationObj->all();
      return view('index', compact('product', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
      $this->ProductObj->where(['id'=>$id])->update([
        'id_location'=>$request->location,
        'name'=>$request->product,
        'description'=>$request->description,
        'price'=>$request->price
      ]);
      return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->ProductObj->destroy($id);
        return $deleted ? "OK deleting Product $id" : "FAIL deleting Product $id";
    }

    public function getData()
    {
      return json_encode($this->ProductObj->all());
    }
}
