@extends ('plantilla.admin')
@section('contenido')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Categoría</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'categoria','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre" class="col-sm-2 control-label">Nombre :</label>
                <div class="col-sm-10">
				<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
				</div>
            	
            </div>
            <br><hr>
            <div class="form-group">
            	<label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
            	<div class="col-sm-10">
                 
      <textarea name="descripcion" class="form-control" maxlength="100" placeholder="Descripción..."></textarea>
            	
 <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción...">-->
            	</div>
            </div>
            <br><hr>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            	
            </div>
			{!!Form::close()!!}		
            
		</div>
	</div>
	@endsection