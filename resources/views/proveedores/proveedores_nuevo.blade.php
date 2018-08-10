@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/proveedores/nuevo/post" accept-charset="UTF-8" class="form-horizontal">
	<div class="row">
	    <div class="col-md-12" >
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
	                <div class="row">
	                    <div class="col-md-4" style="float: left;">
	                        <h3 class="panel-title" style="margin-top: 10px;">Nuevo proveedor</h3>
	                    </div>
	            	</div>
	            </div>
	            <div class="panel-body" style="background: #D7D7D7">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombre:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="nombre" type="text" required>
                        </div>
                        <label class="control-label col-sm-2">Telefono:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="tel" type="text">
                        </div>
                    </div>
	            </div>
	            <div class="panel-footer">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Crear proveedor">
	            </div>  
	        </div>
	    </div>
    </div>
</form>
@stop