@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/etiquetas/nuevo/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-10 col-md-offset-1" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Nueva etiqueta</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombre:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="nombre" type="text" required>
                        </div>
                        <label class="control-label col-sm-2">Tipo:</label>
	                    <div class="col-sm-4"> 
	                        <select class="form-control" name="tipo" required="true">
							  <option value="marca">Marca</option> 
							  <option value="modelo" selected>Modelo</option>
							  <option value="tipo">Tipo de producto</option>
							</select>
						</div>
                    </div>
	            </div>
	            <div class="panel-footer">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Crear etiqueta">
	            </div>  
	        </div>
	    </div>
    </div>
</form>
@stop