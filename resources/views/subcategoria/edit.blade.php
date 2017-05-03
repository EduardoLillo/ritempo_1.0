@extends ('plantilla.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar SubCategoría: {{ $subcategoria->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($subcategoria,['method'=>'PATCH','route'=>['subcategoria.update',$subcategoria->id_subcategoria]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$subcategoria->nombre}}" placeholder="Nombre...">
            </div>
           <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<textarea name="descripcion" maxlength="100" class="form-control" value="{{$subcategoria->descripcion}}" placeholder="Descripción..."></textarea>


            	<!--<input type="text" name="descripcion" class="form-control" value="{{$subcategoria->descripcion}}" placeholder="Descripción...">-->
            </div>
            <div class="form-group">
            
            {!! Form::label('id_categoria', 'Seleccion una Categoria   :') !!}		
			{!! Form::select('categoria',$categoria,null,['class'=>'select2-container form-control select2','placeholder'=>'Seleccione Nombre de Categoria','required']) !!}
            </div>
            


            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection