<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;


class CategoriaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categorias')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id_categoria','desc')
            ->paginate(5);
            return view('categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("categoria.create");
    }
    public function store (CategoriaFormRequest $request)
    {
        $categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');

        $categoria->save();
        return Redirect::to('categoria');

    }
    public function show($id)
    {
        return view("categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('categoria');
    }
    public function destroy($id)
    {
        try {

          $categoria=Categoria::findOrFail($id);
        /*$categoria->condicion='0';*/
          $categoria->delete();

        return Redirect::to('categoria');
            
        } catch (\Illuminate\Database\QueryException $e ) {
            
            //return 'No puede eliminar la categoria,por que tiene subcategorias asociadas';
            return Redirect::to('categoria')
        ->with('message','No puede eliminar la categoria,por que tiene subcategorias asociadas');
            
        }

    }


}
