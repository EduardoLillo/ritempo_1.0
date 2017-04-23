@extends ('plantilla.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de SubCategorías <a href="/subcategoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('subcategoria.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>categoria</th>
				</thead>
               @foreach ($subcategorias as $subcat)
				<tr>
					<td>{{ $subcat->id_subcategoria}}</td>
					<td>{{ $subcat->nombre}}</td>
					<td>{{ $subcat->id_categoria}}</td>
					<td>
						<a href="{{URL::action('SubcategoriaController@edit',$subcat->id_subcategoria)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$subcat->id_subcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('subcategoria.modal')
				@endforeach
			</table>
		</div>
		{{$subcategorias->render()}}
	</div>
</div>

@endsection