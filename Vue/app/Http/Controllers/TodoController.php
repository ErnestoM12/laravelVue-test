<?php

namespace App\Http\Controllers;

use App\todo;
use App\types;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Http;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  


   $res = Http::get('https://my-json-server.typicode.com/TASNETWORK/Prueba-DJunior/products');
   return $todos=$res->json();

         
    }
    
     public function categories()
    { 
        $res = Http::get('https://my-json-server.typicode.com/TASNETWORK/Prueba-DJunior/categories');
      return $categories=$res->json();


    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,  $id)
    {



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = todo::findOrFail($id);
        $todo->delete();
        return todo::latest()->get();
    }
}
