@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/productos/editar/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-12" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Editar proveedor</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body" style="background: #D7D7D7">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="tipo" type="text" value="{{$producto->tipo}}" required>
                        </div>
                        <label class="control-label col-sm-2">Marca:</label>
	                    <div class="col-sm-4"> 
	                        <!--<select class="form-control" name="tipo" required="true" id="tipo">
							</select>-->
							<input class="form-control" type="text" name="marca" value="{{$producto->marca}}" required>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Modelo:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="modelo" type="text" value="{{$producto->modelo}}" required>
                        </div>
                        <label class="control-label col-sm-2">Código de barras:</label>
	                    <div class="col-sm-4"> 
	                        <!--<select class="form-control" name="tipo" required="true" id="tipo">
							</select>-->
							<input class="form-control" type="text" name="codbarras" value="{{$producto->codbarras}}">
						</div>
                    </div>
	            </div>
	            <div class="panel-footer">
	            	<input name="id" type="hidden" value="{{$producto->id}}">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Finalizar edición">
	            </div>  
	        </div>
	    </div>
    </div>
</form>
@stop