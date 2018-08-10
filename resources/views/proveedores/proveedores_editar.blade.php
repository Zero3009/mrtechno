@extends('layouts.admin')

@section('main-content')
<form method="POST" action="/admin/proveedores/editar/post" accept-charset="UTF-8" class="form-horizontal">
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
	            	@if (session('status'))
	                    <div class="alert alert-success" id="ocultar">
	                        {{ session('status') }}
	                    </div>
                	@endif
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombre:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="nombre" type="text" required value="{{$prov->nombre}}">
                        </div>
                        <label class="control-label col-sm-2">Telefono:</label>
                        <div class="col-sm-4">
                            <input class="form-control" style="width: 100%" name="tel" type="text" value="{{$prov->tel}}">
                        </div>
                    </div>
	            </div>
	            <div class="panel-footer">
	            	<input name="id" type="hidden" value="{{$prov->id}}">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	                <input class="btn btn btn-success" tabindex="1" type="submit" value="Finalizar edición">
	            </div>  
	        </div>
	    </div>
    </div>
</form>
@stop
@push('scripts')
@section('js')
<script>
$("#ocultar").fadeTo(8000, 500).slideUp(500, function(){
    $("ocultar").alert('close');
});
</script>
@endsection