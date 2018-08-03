@extends('layouts.admin')
@section('main-content')
<div class="row">
    <div class="col-md-10 col-md-offset-1" >
        <div class="panel panel-default">
            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
                <div class="row">
                    <div class="col-md-4" style="float: left;">
                        <h3 class="panel-title" style="margin-top: 10px;">Gestionar proveedores</h3>
                    </div>

                    <div class="col-md-8" style="float: right;">
                        <a class="btn btn-success" href="/admin/proveedores/nuevo" style="float: right;">
                        <i class="fa fa-plus"></i> Nuevo</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form>
                    <input class="form-control" type="text" name="" id="">
                    <input class="btn btn btn-success" tabindex="1" type="" name="hola" value="Finalizar edición">
                </form>
                <table class="table table-striped table-bordered tabla-filtro" width="100%" id="tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="POST" action="/admin/proveedores/eliminar" accept-charset="UTF-8" class="form-horizontal">
                <div class="modal-header" style="background: #4682B4; color: #FFFFFF;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="titulo"> Deshabilitar area</h4>
                </div>
                <div class="modal-body">
                    <p class="help-block">¿Esta seguro que desea deshabilitar este proveedor?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-success" value="Eliminar">
                    
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
@push('scripts')
<script>
    $('#hola').click(function(){
        console.log('hola');
    })


</script>

@endsection