@extends ('plantilla.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
	<h3>Detalle Producto: {{ $producto->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

		<!--<h3>Listado de Productos <a href="/producto/create"><button class="btn btn-success">Nuevo</button></a></h3>-->
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>marca</th>
					<th>Subcategoria</th>
				</thead>
              <!--@foreach ($producto as $pro)-->
				<tr>

					<!--<td>{{ $producto->id_producto}}</td>
					<td>{{ $producto->nombre}}</td>
					<td>{{ $producto->descripcion}}</td>
					<td>{{ $producto->marca}}</td>
					<td>{{ $producto->id_subcategoria}}</td>-->
					<td>
						<a href="/producto"><button class="btn btn-info">volver</button></a>
                        <!-- <a href="" data-target="#modal-delete-{{$pro->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>-->
                         
					</td>
				</tr>
				@include('producto.modal')
				<!--@endforeach-->
			</table>
		</div>
		{{$producto->render()}}
	</div>
</div>

@endsection