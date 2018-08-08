@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/proveedores/editar/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-10 col-md-offset-1" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Editar proveedor</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Código de barras:</label>
                        <div class="col-sm-4">
                            <select id="codbarras" class="form-control" style="width: 100%" name="codbarras" type="text" required value="">
                            	<option id=1>{{$stock->codbarras}}</option>
                            </select>
                        </div>
                        <label class="control-label col-sm-2">Modelo:</label>
                        <div class="col-sm-4">
                            <select id="modelo" class="form-control" style="width: 100%" name="modelo" type="text" value="">
                            	<option id="{{$stock->prodsid}}" selected>{{$stock->modelo}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Serial:</label>
                    	<div class="col-sm-4">
                    		<select id="serial" class="form-control" style="width: 100%">
                    			<option id="1">{{$stock->serial}}</option>
                    		</select>
                    	</div>
                    </div>
	            </div>
	            <div class="panel-footer">
	            	<input name="id" type="hidden" value="">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Finalizar edición">
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
			console.log("{{$stock->id}}")
			$('#modelo').select2();
			$.getJSON('/ajax/codbarras',null,function(data){

			});
			
			
			
			$('#codbarras').select2({
				placeholder: 'Código de barras',
	        	ajax: {
	                url: '/ajax/codbarras',
	                data: function (params) {
	                  var query ={
	                    search: params.term
	                  }
	                  return query;
	                },
	                dataType: 'json',
	                processResults: function (data) {
	      // Tranforms the top-level key of the response object from 'items' to 'results'
	                  return {
	                    results: data
	                  };
	                }
	                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
	        	},
			});
		
	})
	$('#codbarras').on("select2:select", function(e){
		$('#modelo').empty().trigger("change");
			$.getJSON('/ajax/productos', {
            	mod: e.params.data.text
	        },function(data){
	            $('#modelo').select2({
	                placeholder: 'Modelo',
	                data: data
            	});
	    });
	});



</script>
@endsection