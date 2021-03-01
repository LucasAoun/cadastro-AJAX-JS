<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ControladorProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('produtos');
    }

    public function index()
    {
      $prods = Produto::all();
      return $prods->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categorias = Categoria::all();
      return view('novoproduto', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $prod = new Produto();
      $prod->nome = $request->nome;
      $prod->estoque = $request->estoque;
      $prod->preco = $request->preco;
      $prod->categoria_id = $request->categoria_id;
      $prod->save();
      return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $prod = Produto::find($id);
      if(isset($prod)){
        return json_encode($prod);
      }
      return response('Produto nao encontrado', 404);
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
      $prod = Produto::find($id);
      if(isset($prod)){
      $prod->nome = $request->nome;
      $prod->estoque = $request->estoque;
      $prod->preco = $request->preco;
      $prod->categoria_id = $request->categoria_id;
      $prod->save();
      return json_encode($prod);
     }
     return response('Produto nao encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $produto = Produto::find($id);
      if(isset($produto)){
        $produto->delete();
      }
      return response('Produto nao encontrado', 404);
    }

}
