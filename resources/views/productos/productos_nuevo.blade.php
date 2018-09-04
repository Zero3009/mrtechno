@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/productos/nuevo/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-12" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Nuevo producto</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body" style="background: #D7D7D7">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo:</label>
                        <div class="col-sm-4">
                        	<select name="tipo" class="form-control" style="width: 100%" id="tipo" required></select>
                        </div>
                        <label class="control-label col-sm-2">Marca:</label>
	                    <div class="col-sm-4"> 
	                        <!--<select class="form-control" name="tipo" required="true" id="tipo">
							</select>-->
							<select name="marca" class="form-control" style="width: 100%" id="marca" required></select>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Modelo:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="modelo" type="text" required>
                        </div>
                        <label class="control-label col-sm-2">Código de barras:</label>
	                    <div class="col-sm-4"> 
	                        <!--<select class="form-control" name="tipo" required="true" id="tipo">
							</select>-->
							<input class="form-control" type="text" name="codbarras">
						</div>
                    </div>
	            </div>
	            <div class="panel-footer">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Crear producto">
	            </div>  
	        </div>
	    </div>
    </div>
</form>
@stop
@section('js')
@push('scripts')
<script>
	$(document).ready(function(){
		$('#tipo').select2({
			placeholder: 'Tipo de producto',
			tags: true,
			ajax: {
					url: '/ajax/tiposprods',
					data: function(params){
						var query ={
							search: params.term,
						}
						return query;
					},
					dataType: 'json',
					processResults: function(data){
						data.forEach(function(e){
							e.id = e.text;
						});
						return {
							results: data
						}
					}
			}
		});
		$('#marca').select2({
			placeholder: 'Marca',
			tags: true,
			ajax: {
				url: '/ajax/marcas',
				data: function(params){
					var query ={
						search: params.term,
					}
					return query;
				},
				dataType: 'json',
				processResults: function(data){
					data.forEach(function(e){
						e.id = e.text;
					});
					return {
						results: data
					}
				}
			}
		});
	});
	/*$.getJSON("/ajax/productos", function (json) {
		console.log(json);
	    $.each(json, function(i, item) {
	       $('#tipo').append('<option value="'+item.nombre+'">'+item.nombre+'</option>');
	    });
	});*/
</script>
@endsection