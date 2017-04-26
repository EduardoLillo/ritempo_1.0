<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use DB;
use App\Producto;
use App\Subcategoria;
use App\Http\Requests\SubCategoriaFormRequest;
use App\Http\Controller\SubcategoriaController;

class ProductoController extends Controller
{
     public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $productos=DB::table('productos')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id_producto','desc')
            ->paginate(3);
            return view('producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }

    public function create()
    {
    	 $data['subcategoria'] = Subcategoria::lists('nombre', 'id_subcategoria');
        return view("producto.create",$data);
    }

    public function store (ProductoFormRequest $request)
    {
        return Redirect::to('producto');

    }

    public function show($id)
    {
        return view("producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id)    
    {
    	$data['subcategoria'] = Subcategoria::lists('nombre', 'id_categoria');
        return view("producto.edit",["producto"=>Producto::findOrFail($id)],$data);
    }

    public function update(ProductoFormRequest $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->nombre=$request->get('nombre');
        $producto->descripcion=$request->get('descripcion');
        $producto->marca=$request->get('marca');
        $producto->id_subcategoria=$request->get('subcategoria');
        $producto->update();
        return Redirect::to('producto');
    }
    public function destroy($id)
    {
        try {

          $producto=Producto::findOrFail($id);
        /*$categoria->condicion='0';*/
          $producto->delete();

        return Redirect::to('producto');
            
        } catch (\Illuminate\Database\QueryException $e ) {
            return Redirect::to('producto')
        ->with('message','No puede eliminar el producto,por que tiene subcategorias asociadas');            
        }
    }

}
