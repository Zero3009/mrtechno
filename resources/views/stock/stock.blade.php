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
                <form method="POST" action="/admin/stock/nuevo/post" accept-charset="UTF-8" class="form-horizontal">
                    <table class="table table-striped table-bordered" name="tabla" id="tabla">
                        <tr>
                            <th style="width:25%">Codigo de barras</th>
                            <th style="width:25%">Modelo</th>
                            <th style="width:25%">Serial</th>
                            <th style="width:15%">Proveedor</th>
                            <th style="width:10%">Accion</th>
                        </tr>
                        <tr id="row1">
                            <td><select data-ex="asd" data-row="1" class="form-control" name="codbarras[]" id="codbarras_1"></select></td>
                            <td><select name="modelo[]" class="form-control" id="modelo_1"></select></td>
                            <td><select name="serial[]" class="form-control" id="serial_1" multiple="multiple"></select></td>
                            <td><select name="proveedor[]" class="form-control" id="proveedor_1"></select></td>
                            <td><input data-bot="add" class="btn btn-success" onclick="addRow()" tabindex="1" type="button" name="add"  id="add_1" value="+"></td>
                        </tr>
                    </table>

                    <input class="btn btn btn-success" tabindex="1" type="submit" value="Cargar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
var ajaxProveedor = {
    url:'/ajax/proveedores',
    data: function (params) {
        var query ={
            search: params.term,
        }
        return query;
    },
    dataType: 'json',
    processResults: function(data){
        console.log(data);
        return {
            results: data
        }
    }
}
var ajax =  {
                url: '/ajax/codbarras',
                data: function (params) {
                  var query ={
                    search: params.term
                  }
                  return query;
                },
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
        };
var modelosAjax = {
    url: '/ajax/productos',
                data: function (params) {
                  var query ={
                    search: params.term
                  }
                  return query;
                },
                dataType: 'json',
                processResults: function (data) {
                    console.log(data);
                  return {
                    results: data
                  };
                }
};
$(document).ready(function(){
    $('#codbarras_1').select2({
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
                        console.log(data);
      // Tranforms the top-level key of the response object from 'items' to 'results'
                  return {
                    results: data
                  };
                }
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        },
          
    });
    $('#proveedor_1').select2({
        placeholder: 'Proveedores',
        ajax:{
            url:'/ajax/proveedores',
            data: function (params) {
                var query ={
                    search: params.term,
                }
                return query;
            },
            dataType: 'json',
            processResults: function(data){
                console.log(data);
                return {
                    results: data
                }
            }
        }
    });
})
var i = 1;
function addRow(){
    console.log('work');
    i++;
    for(j = 1;j<i;j++){
        $('#codbarras_'+i).select2("destroy");
        $('#proveedor_'+i).select2("destroy");   
    }
    
    $('#tabla').append('<tr id="row'+i+'"><td style="width:25%"><select data-ex="added" data-row="'+i+'" class="form-control" name="codbarras[]" id="codbarras_'+i+'"></select></td><td style="width:25%"><select name="modelo[]" class="form-control" id="modelo_'+i+'"></select></td><td style="width:25%"><select name="serial[]" class="form-control" id="serial_'+i+'"></select></td><td style="width:15%"><select name="proveedor[]" class="form-control" id="proveedor_'+i+'"></select></td><td style="width:10%"><input  data-bot="add" class="btn btn-success" tabindex="1" type="button" onclick="addRow()" name="add"  id="add_'+i+'" value="+"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    for(j=1;j<i;j++){
        $('#codbarras_'+i).select2({
            placeholder: 'Código de barras',
            ajax: ajax,
        });
        $('#proveedor_'+i).select2({
            placeholder: 'Proveedores',
            ajax: ajaxProveedor,
        });
    }
    
    $('[data-ex="added"]').on("select2:select",function(e){
        $.getJSON('/ajax/productos',    {
            mod: e.params.data.text
        },function(data){
            $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).select2({
                placeholder: 'Modelo',
                data: data
            });
        });
    });
}

$('[data-ex="asd"]').on("select2:select",function(e){
    console.log('work')
    $.getJSON('/ajax/productos',    {
            mod: e.params.data.text
        },function(data){
            $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).select2({
                placeholder: 'Modelo',
                data: data
            });
        });
});

$(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id).remove();
}); 


</script>

@endsection