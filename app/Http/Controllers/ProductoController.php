<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Storage;
use DB;
use App\Http\Requests\ProductoFormRequest;
use App\Http\Requests\ProductoEditFormRequest;
use App\Http\Requests\SubCategoriaFormRequest;
use App\Producto;
use App\Subcategoria;
use App\Imagen;

use App\Http\Controller\SubcategoriaController;

class ProductoController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth');
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
 
        $file = Input::file('imagen');
        $producto = new Producto($request->all());
       
        $producto->nombre=$request->get('nombre');
        $producto->descripcion=$request->get('descripcion');
        $producto->marca=$request->get('marca');
        $producto->id_subcategoria=$request->get('subcategoria');
        $producto->save();

          
        if ($request->file('imagen')){            
                 foreach ($file as $value) {
              
                  $nombre_img = $value->getClientOriginalName();                 
                  $ruta = public_path().'\productos';
                  $destinacion = 'productos';
                  $filename = 'PRO_' . time() . '.' . $nombre_img;
                  //$filename = 'PRO_'. str_random(4) . '_' .$nombre_img;
                  $upload = $value->move($destinacion, $filename);
                  $imagen=new Imagen();
                  $imagen->nombre=$filename;
                  $imagen->ruta=$ruta;
                  
                  $imagen->save();
                  $producto->imagenes()->attach($imagen);
             }

        }


        return Redirect::to('producto');

    }
/*-----------------------????????????------------------------------------------------------------*/
    public function show($id)    
    {

     // $producto=Producto::findOrFail($id);
       // return view("producto.show",["producto"=>Producto::findOrFail($id)]);
       return view("producto.show",["producto"=>Producto::findOrFail($id)]);

    }
    public function edit($id)    
    {
    	$data['subcategoria'] = Subcategoria::lists('nombre', 'id_categoria');
        return view("producto.edit",["producto"=>Producto::findOrFail($id)],$data);
    }

    public function update(ProductoEditFormRequest $request ,$id)
    {
        $producto=Producto::findOrFail($id);
        $file = Input::file('imagen');
        //$producto = new Producto();
        //$producto = new Producto($request->all());        
        $producto->nombre=$request->get('nombre');
        $producto->descripcion=$request->get('descripcion');
        $producto->marca=$request->get('marca');
        $producto->id_subcategoria=$request->get('subcategoria');
        $producto->update();
      
        
          
        if ($request->file('imagen')){            
                 foreach ($file as $value) {
              
                  $nombre_img = $value->getClientOriginalName();                 
                  $ruta = public_path().'\productos';
                  $destinacion = 'productos';
                  $filename = 'PRO_' . time() . '.' . $nombre_img;
                  //$filename = 'PRO_'. str_random(4) . '_' .$nombre_img;
                  $upload = $value->move($destinacion, $filename);
                  $imagen1=new Imagen();
                  $imagen1->nombre=$filename;
                  $imagen1->ruta=$ruta;
                  
                  $imagen1->save();

                  $producto->imagenes()->attach($imagen1);
             }

        }


        return Redirect::to('producto');

    }

    /*-----------------------????????????------------------------------------------------------------*/


    public function destroy($id)
    {
        try {

          $producto=Producto::findOrFail($id);
         // $producto->imagenes()->detach();

        /*$categoria->condicion='0';*/
          //$imagenes=DB::table('imagenes')->where('nombre','LIKE','%'.$query.'%')

          $producto->imagenes()->detach();
          $producto->delete();

        return Redirect::to('producto');
            
        } catch (\Illuminate\Database\QueryException $e ) {
            return Redirect::to('producto')
        ->with('message','No puede eliminar el producto,por que tiene subcategorias asociadas');            
        }
    }

}
