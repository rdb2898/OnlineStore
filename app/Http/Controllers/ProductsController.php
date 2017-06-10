<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\brand;
use App\image;
use App\product;
use Storage;
use Img;
use Session;
class ProductsController extends Controller
{

    public function __construct()
    {
      $this->middleware('admin',['except'=>['show','AddCart','index','MotorCategory','CarsCategory','VansCategory','DisplayCartList']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=brand::all();
        $NewProduct=product::take(1)->orderBy('created_at','DESC')->get();
        return view('onlinestore.AddProduct',compact('brands','NewProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->ProductsValidator($request);
      $prodTB= new product;
      $prodTB->name = $request->name;
      $prodTB->description = $request->description;
      $prodTB->stock = $request->stock;
      $prodTB->size = $request->size;
      $prodTB->color = $request->color;
      $prodTB->price = str_replace(",","",$request->price);
      $prodTB->category = $request->category;
      $prodTB->brand_id = $request->brand_id;
      $prodTB->save();
      if ($request->hasFile('image')) {
        foreach ($request->image as $image)
        {

        $picsize=$image->getClientSize();
        $picname=$image->hashName();
        Storage::putFile('public\uploads',$image);

          $imageTB = new image;
          $imageTB->name = $picname;
          $imageTB->size = $picsize;
          $imageTB->imageable_type = 'App\product';
          $imageTB->imageable_id = $prodTB->id;
          $imageTB->save();

        }

      }else {
        return redirect('products/create');
      }
      return redirect('products/create');


    }
    public function ProductsValidator($request)
    {
      $this->validate($request,[
        'name'=>'required|max:100',
        'description'=> 'required|max:191|min:5',
        'stock'=> 'required|max:11',
        'size'=> 'required|max:100',
        'color'=> 'required|max:191',
        'price'=> 'required|max:18',
        'category'=> 'required',
        'brand_id'=> 'required',
        'image'=> 'required',
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
        $product=product::find($id);
        $relateProducts=product::inRandomOrder()->take(5)->get();
        $topsellings=product::take(4)->orderBy('created_at')->get();
        return view('onlinestore.eachItemView',compact('product','relateProducts','topsellings'));
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

    public function MotorCategory()
    {
      $brands=brand::all();
      $motors=product::where('category', 'motorcycles')->orderBy('created_at','DESC')->paginate(9);
      return view('onlinestore.MotorView',compact('motors','brands'));
    }
    public function CarsCategory()
    {
      $brands=brand::all();
      $cars= product::where('category', 'cars')->orderBy('created_at','DESC')->paginate(9);
      return view('onlinestore.CarsView',compact('cars','brands'));
    }
    public function VansCategory()
    {
      $brands=brand::all();
      $vans=product::where('category', 'vans')->orderBy('created_at','desc')->paginate(9);
      return view('onlinestore.VansView',compact('vans','brands'));
    }
    public function AddCart($id)
    {
      $product=product::find($id);

      if ($product->stock >0)
       {
         foreach (Session::get('carted-products') as $cartedAlready) {
           if ($id == $cartedAlready->id) {
             Session::flash('notice','You already have this item in your cart');
             return redirect()->back();
           }
         }
        Session::push('carted-products',$product);
        Session::flash('recently-added',$product);
        return redirect()->back();
        //return Session::get('recently-added');
      }
      else
      {
        Session::flash('errorDisplays','Sorry, This item is out of stock.');
      }
    }
    public function DisplayCartList()
    {
      return view('onlinestore.cartedlistings');
    }
}
