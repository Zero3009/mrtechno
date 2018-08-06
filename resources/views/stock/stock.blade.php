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
                    <table class="table table-striped table-bordered" name="tabla" id="tabla">
                        <tr>
                            <th style="width:10%">Codigo de barras</th>
                            <th>Tipo</th>
                            <th style="width:15%">Marca</th>
                            <th style="width:25%">Modelo</th>
                            <th>Accion</th>
                        </tr>
                        <tr>
                            <td><select name="codbarras" class="form-control" id="codbarras_1"></select></td>
                            <td><select name="tipo" class="form-control" id="tipo_1"></select></td>
                            <td><select name="marca" class="form-control" id="marca_1"></td>
                            <td><select name="modelo" class="form-control" id="modelo_1" disabled="false"></select></td>
                            <td><input class="btn btn-success" tabindex="1" type="button" name="add[]" onclick="addRow()" id="add_1" value="+"></td>
                        </tr>
                    </table>
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
var i = 1;
$('#modelo_1').select2();
/*$(document).ready(function () {
var tabla = $('#tabla').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": '/datatables/getstock',
    "columns":[
        {data: 'tipo', name:'tipo'},
        {data: 'marca', name:'marca'},
        {data: 'modelo', name:'modelo'},
        {data: 'codbarras', name:'codbarras'},
        {data: 'action', name: 'action', orderable: false}
    ],
    "language":{
                url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
    },
    "bFilter": true,
});*/
function addRow()
    {
        i++;
        $('#tabla').append('<tr id ="row'+i+'"><td><select name="codbarras" class="form-control" id="codbarras_1"></select></td><td><select name="tipo" class="form-control" id="tipo_1"></select></td><td><select name="marca" class="form-control" id="marca_'+i+'"></td><td><select name="modelo" class="form-control" id="modelo_'+i+'"></select></td><td><input type="button" class="btn btn-success" name="add[]" onclick="addRow()" value="+"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>');
        
        $('#marca_'+i).select2({
        language: "es",
        placeholder: "Seleccionar marca",
        ajax:{
            url:'/ajax/marcas',
            data: function(params){
                var query = {
                    search: params.term
                }
                return query;    
            },
            dataType: 'json',
            processResults: function(data)
            {
                var j = 0;
                data.forEach(function(obj) { 
                    
                    obj.id = j; 
                    j++;
                });
                console.log(data);
                return {
                    results: data
                }
            }
        },
        cache: true
        });

    }

$('#codbarras_1').on("select2:select", function (e) {
    $("#modelo_1").val(null).trigger("change");
    $("#modelo_1").select2("val", "");
    //$("#modelo_1").select2('data', null);
    $('#modelo_1').prop('disabled', false);
    $.getJSON('/ajax/productos',{
        mod: e.params.data.text
    }

        , function(data){
        $('#modelo_1').select2({
            data: data,
            language: "es",
            placeholder: "Seleccionar marca",
        /*ajax:{
        url:'/ajax/productos',
        data: function(params){
            var query = {
                search: params.term,
                mod: e.params.data.text

            }
            return query;    
        },
        dataType: 'json',
        processResults: function(data)
        {
            /*var j = 0;
            data.forEach(function(obj) { 
                
                obj.id = j; 
                j++;
            });
            console.log(data);
            return {
                results: data
            }
        }
        },
    });*/
        });
    });
    $('#modelo_1').val(1).trigger('change.select2');
});
$(document).on('click', '.btn_remove', function(){

    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
});
/*$('.js-data-example-ajax').select2({
  ajax: {
    url: '/ajax/productos',
    dataType: 'json',

    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});*/
/*$.getJSON("/ajax/productos",null,function(data){
    $("#modelo_1").select2({
        data: data,
        allowClear: true,
        language: "es",
        placeholder: "Seleccionar modelo"
    });
});*/

/*$("#marca_1").select2({
    
    language: "es",
    placeholder: "Seleccionar marca",
    ajax:{
        url:'/ajax/marcas',
        data: function(params){
            var query = {
                search: params.term
            }
            return query;    
        },
        dataType: 'json',
        processResults: function(data)
        {
            var j = 0;
            data.forEach(function(obj) { 
                
                obj.id = j; 
                j++;
            });
            console.log(data);
            return {
                results: data
            }
        }
    },
    cache: true
});*/
//});
$("#codbarras_1").select2({
    
    language: "es",
    placeholder: "Código de barras",
    ajax:{
        url:'/ajax/codbarras',
        data: function(params){
            var query = {
                search: params.term
            }
            return query;    
        },
        dataType: 'json',
        processResults: function(data)
        {
            return {
                results: data
            }
        }
    },
    //cache: true
});


/*    
    //$('button[id^="add_"]').click(function(){
    
    
    //})
    
});*/

    


</script>

@endsection