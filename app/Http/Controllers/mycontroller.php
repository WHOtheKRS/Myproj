<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
class mycontroller extends Controller
{
    //
    function insert(Request $req){
        $name = $req->get('pname');
        $price = $req->get('pprice');
        $quantity = $req->get('pquantity');
        $image = $req->file('image')->getClientOriginalName();
        //move uploaded file
        $req->image->move(public_path('images'),$image);

        $prod = new product();
        $prod->PName = $name;
        $prod->PPrice = $price;
        $prod->PQuantity = $quantity;
        $prod->PImage = $image;
        $prod->save();
        return redirect('/');
    }

    function readdata(){
        $pdata = product::all();
        return view('insertRead',['data'=> $pdata]);
    }
    function updateordelete(Request $req){
        $id = $req->get('id');
        $name = $req->get('name');
        $price = $req->get('price');
        $quantity = $req->get('quantity');
        if($req->get('update') == 'Update'){
            return view('updateview',['pid' => $id, 'pname'=>$name, 'pprice' => $price, 'pquantity' => $quantity]);
        }
        else
        {
            $prod = product::find($id);
            $prod->delete();
        }
        return redirect('/');
    }
    function update(Request $req){
        $Id = $req->get('id'); 
        $Name = $req->get('name');
        $Price = $req->get('price');
        $Quantity = $req->get('quantity');
        $prod = product::find($Id);
        $prod->PName = $Name;
        $prod->PPrice = $Price;
        $prod->PQuantity = $Quantity;
        $prod->save();
        return redirect('/'); 
    }
}
 
?>