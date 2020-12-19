<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Middleware\Roles;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(Roles::class)->except('index', 'bid', 'bidPost', 'finish');
    }

    public function index()
    {
        $title = 'Auction';

        $products = Product::where('finish_time', '>', \DB::raw('NOW()'))->get();

        return view('products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
  
        $imageName = time().'.'.$request->image->extension();
  
        $request->image->move(public_path('img/'), $imageName);

        $product = new Product;

        $product->name = $request->input('name');
        $product->image = 'img/'.$imageName;
        $product->start_bid = $request->input('start_bid');
        $product->finish_time = $request->input('finish_time');
        $product->save();

        return redirect('products')->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $product)
    {
        $product = Product::find($product->id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Product $product)
    {
        $product = Product::find($product->id);

        return view('products.edit', compact('product'));
    }

    public function bid(Product $product)
    {
        $product = Product::find($product->id);
        
        return view('products.bid', compact('product'));
    }

    public function bidPost(Request $request, $id)
    {
        $product = Product::find($id);

        $username = auth()->user()->name;

        if($product->last_bid_user == '')
        {
            $user = User::where('name', $username)->first();
            
            $user->balance = $user->balance - $request->start_bid;
        }
        elseif($product->last_bid_user == $username)
        {
            $products = Product::where('finish_time', '>', \DB::raw('NOW()'))->get();

            return redirect()->back()->with('danger', 'You have bid on this product');
        }
        else
        {
            $user = User::where('name', $username)->first();
            
            $user->balance = $user->balance - $request->start_bid;

            $user1 = User::where('name', $product->last_bid_user)->first();
            
            $user1->balance = $user1->balance + $product->start_bid;
        }

        if( $user->balance < 0)
        {
            $products = Product::where('finish_time', '>', \DB::raw('NOW()'))->get();
            return redirect()->back()->with('danger', 'You cant bid more than your credits');
        }
        else
        {
            $user->save();
            if(isset($user1))
                $user1->save();
        }
            
        
        $product->start_bid = $request->start_bid;
        $product->last_bid_user = $username;
        $product->save();

        $products = Product::where('finish_time', '>', \DB::raw('NOW()'))->get();

        return redirect('products')->with('success', 'You have bid successfully');
        
    }

    public function finish()
    {
        $products = Product::where('finish_time', '<', \DB::raw('NOW()'))->get();
        
        return view('products.finish', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
        $product = Product::find($product->id);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
  
        $imageName = time().'.'.$request->image->extension();
  
        $request->image->move(public_path('img/'), $imageName);

        $product->name = $request->input('name');
        $product->image = 'img/'.$imageName;
        $product->start_bid = $request->input('start_bid');
        $product->finish_time = $request->input('finish_time');
        $product->save();

        return redirect('products')->with('success', 'Product Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        $product->delete();

      return redirect('/products')->with('danger', 'Product Deleted');
    }
}
