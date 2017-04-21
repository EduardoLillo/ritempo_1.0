<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subcategoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SubcategoriaFormRequest;
use DB;
use App\Categoria;
use App\Http\Requests\CategoriaFormRequest;
use App\Http\Controller\CategoriaControler;




class SubcategoriaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $subcategorias=DB::table('subcategorias')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id_subcategoria','desc')
            ->paginate(5);
            //prueba listbox
            
            return view('subcategoria.index',["subcategorias"=>$subcategorias,"searchText"=>$query,]);
        }
    }
    public function create()
    {
        
    $categorias =Categoria::all();
        return view("subcategoria.create",compact('categorias'));
        //return view('subcategoria.create',compact('categorias'));
    }
    public function store (SubcategoriaFormRequest $request)
    {
        $subcategoria=new Subcategoria;
        $subcategoria->nombre=$request->get('nombre');
        $subcategoria->descripcion=$request->get('descripcion');
        $subcategoria->categoria=$request->get('categoria');

        $subcategoria->save();
        return Redirect::to('subcategoria');

    }
    public function show($id)
    {
        return view("subcategoria.show",["subcategoria"=>subcategoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("subcategoria.edit",["subcategoria"=>subcategoria::findOrFail($id)]);
    }
    public function update(SubCategoriaFormRequest $request,$id)
    {
        $subcategoria=subcategoria::findOrFail($id);
        $subcategoria->nombre=$request->get('nombre');
        $subcategoria->descripcion=$request->get('descripcion');
        $subcategoria->categoria=$request->get('categoria');
        $subcategoria->update();
        return Redirect::to('subcategoria');
    }
    public function destroy($id)
    {
        $subcategoria=subcategoria::findOrFail($id);
        /*$categoria->condicion='0';*/
       	  $subcategoria->delete();

        return Redirect::to('subcategoria');
    }
}
