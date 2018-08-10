@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/stock/editar/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-12" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Editar stock</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Código de barras:</label>
                        <div class="col-sm-4">
                            <select id="codbarras" class="form-control" style="width: 100%" name="codbarras" type="text" required>
                            	<!--<option id=1>{{$stock->codbarras}}</option>-->
                            </select>
                        </div>
                        <label class="control-label col-sm-2">Modelo:</label>
                        <div class="col-sm-4">
                            <select id="modelo" class="form-control" style="width: 100%" name="modelo" type="text" value="">
                            	<option value="{{$stock->prodsid}}" selected>{{$stock->modelo}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Serial:</label>
                    	<div class="col-sm-4">
                    		<input class="form-control" id="serial" name="serial" type="text" value="{{$stock->serial}}">
                    	</div>
                    	<label class="control-label col-sm-2">Fecha:</label>
                    	<div class="col-sm-4">	
                    		<input placeholder="Fecha:" value="{{$stock->fechaEntrada}}" type="text" class="form-control" id="fecha" name="fecha"readonly="true" >
                    	</div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Proveedor:</label>
                    	<div class="col-sm-4">
                    		<select id="proveedor" class="form-control" style="width: 100%" name="proveedor" type="text" required></select>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Precio Entrada:</label>
                        <div class="col-sm-4">
                    		<input type="number" value="{{$stock->precioEntrada}}" class="form-control" name="precioEntrada" id="precioEntrada">
                     	</div>
                    </div>
	            </div>
	            <div class="panel-footer">
	            	<input name="id" type="hidden" value="{{$stock->id}}">
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
			//console.log("{{$stock->codbarras}}")
			//console.log(["{{$stock->codbarras}}"]);
			//$('#serial').append('<option id="1" selected>'+" {{$stock->serial}}"+'</option>');
			$('#proveedor').select2();
			$('#modelo').select2();
			
			$.getJSON('/ajax/codbarras',null,function(data){
				var filtered = data.filter(function(item) { 
					if (item.text == "{{$stock->codbarras}}") {
						$('#codbarras').append('<option value="'+item.id+'" selected>'+item.text+'</option>');
					}else{
						return item;	
					}
				     
				});
				$('#codbarras').select2({
					placeholder: 'Código de barras',
					data: filtered
				});
			});
			$.getJSON('/ajax/proveedores',null,function(data){
				var filteredProv = data.filter(function(item){
					if(item.text == "{{$stock->nombre}}") {
						$('#proveedor').append('<option value="'+item.id+'" selected>'+item.text+'</option>');
					}else{
						return item;
					}
				});
				console.log(filteredProv);
				$('#proveedor').select2({
					placeholder: 'Proveedor',
					data: filteredProv
				});
			});
			
			$("#fecha").datepicker({
                    dateFormat: 'yy-mm-dd',
                    todayHighlight: true,
                    numberOfMonths: 1,   
                    showAnim: "slideDown",
                    onClose: function(selectedDate) {
                    },
                    onSelect: function(dateText, inst) {
                        $('#fecha').attr('value',dateText);
                    }
                }).datepicker();
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