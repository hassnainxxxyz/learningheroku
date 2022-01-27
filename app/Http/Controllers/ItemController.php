<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemCollection;
use App\ModelPage;
use App\Brand;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $r = request();
        if($r->search) {
            return new ItemCollection(Item::where('name', 'like', "%".$r->search."%")->orderBy('id', 'desc')->paginate(request()->limit));


        }

        return new ItemCollection(Item::orderBy('id', 'desc')->paginate(request()->limit));
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
    public function store(Request $r)
    {

        $errors = [];
        if($r->name === null) {
            $errors['name'] = 'Name Field is required';

        }


        if($r->brand_id == "") {
            $errors['brand'] = 'Brand Field is required';


        }


        if($r->model_id == "") {
            $errors['model'] = 'Model Field is required';


        }

        if(count($errors) > 0) return response()->json(['errors' => $errors]);




        $brand = Brand::find((int) $r->brand_id);
        $model = ModelPage::find((int) $r->model_id);


        $i = Item::create([
           'name' => $r->name,
           'brand_id' => $brand->id,
           'model_id' => $model->id,
        ]);


        if($i) {
            return 1;
        }


        return 0;







    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($i)
    {
        $x = [];
        $x['models'] = ModelPage::all();
        $x['brands'] = Brand::all();

        return $x;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Item $item)
    {



        $errors = [];
        if($r->name === null) {
            $errors['name'] = 'Name Field is required';

        }


        if($r->brand_id == "") {
            $errors['brand'] = 'Brand Field is required';


        }


        if($r->model_id == "") {
            $errors['model'] = 'Model Field is required';


        }

        if(count($errors) > 0) return response()->json(['errors' => $errors]);




        $brand = Brand::find((int) $r->brand_id);
        $model = ModelPage::find((int) $r->model_id);
















        if($item) {
            $i = $item->update([
                'name' => $r->name,
                 'brand_id' => $r->brand_id,
                'model_id' => $r->model_id,

            ]);

            if($i) {
                return 1;
            }



            return 0;








        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {

        if($item) {
            $item->delete();
            return 1;

        }

        return 0;
    }
}
