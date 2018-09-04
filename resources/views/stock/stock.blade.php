@extends('layouts.admin')
@section('main-content')
<div class="row">
    <div class="col-md-12" >
        <div class="panel panel-default">
            <div class="panel-heading" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
                <div class="row">
                    <div class="col-md-4" style="float: left;">
                        <h3 class="panel-title" style="margin-top: 10px;">Gestionar stock</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="background: #D7D7D7">
                <!-- Mensajes de exito-->
                @if (session('status'))
                    <div class="alert alert-success" id="ocultar">
                        {{ session('status') }}
                    </div>
                @endif
                @if(count($errors)>0)
                    <div class="alert alert-warning" role="alert" id="ocultar2">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    </div>
                @endif 
                <form method="POST" action="/admin/stock/nuevo/post" accept-charset="UTF-8" class="form-horizontal">
                    <table class="table table-striped table-bordered" name="tabla" id="tabla">
                        <tr>
                            <th scope="col" style="width:18%">Codigo de barras</th>
                            <th scope="col" style="width:15%">Modelo</th>
                            <th scope="col" style="width:20%">Serial</th>
                            <th scope="col" style="width:10%">Proveedor</th>
                            <th scope="col" style="width:12%">Precio Entrada</th>
                            <th scope="col" style="width:15%">Fecha Entrada</th>
                            <th scope="col" style="width:10%">Accion</th>
                        </tr>
                        <tr id="row1">
                            <td style="width:18%"><select data-ex="asd" data-row="1" class="form-control" name="codbarras[]" id="codbarras_1"></select></td>
                            <td style="width:15%"><select name="modelo[]" class="form-control" id="modelo_1"></select></td>
                            <td style="width:20%"><select  data-hid="hidorigin" name="serial[]" class="form-control" id="serial_1" multiple="multiple"></select><input type="hidden" name="cantidadseriales[]" value="0" id="cantidadseriales_1"></td>
                            <td style="width:10%"><select name="proveedor[]" class="form-control" id="proveedor_1"></select></td>
                            <td style="width:12%"><input type="number" class="form-control" name="precioEntrada[]" id="precioEntrada_1"></td>
                            <td style="width:15%"><input placeholder="Fecha:" value="<?php echo \Carbon\Carbon::now()->format('Y-m-d');?>" type="text" class="form-control" id="fecha_1" name="fecha[]"readonly="true"></td>
                            <td style="width:10%"><input data-bot="add" class="btn btn-success" onclick="addRow()" tabindex="1" type="button" name="add"  id="add_1" value="+"></td>
                        </tr>
                    </table>

                    <input class="btn btn btn-success" tabindex="1" type="submit" value="Cargar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                <table class="table table-striped table-bordered tabla-filtro" width="100%" id="table">
                    <thead>
                        <tr>
                            <th>Código de barras</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Fecha de entrada</th>
                            <th>Fecha de salida</th>
                            <th>Precio de entrada</th>
                            <th>Precio de salida</th>
                            <th>Proveedor</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <!--<tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>-->
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
            <form method="POST" action="/admin/stock/eliminar" accept-charset="UTF-8" class="form-horizontal">
                <div class="modal-header" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="titulo"> Deshabilitar area</h4>
                </div>
                <div class="modal-body">
                    <p class="help-block">¿Esta seguro que desea eliminar este registro de stock?</p>
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
<div class="modal fade" id="out" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="row">
            <div class="col-md-12">
                <div class="modal-content">
                    <form method="POST" action="/admin/stock/salida" accept-charset="UTF-8" class="form-horizontal">
                        <div class="modal-header" style="background: #222d32   ; color: #FFFFFF;  opacity: 0.9;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="titulout"> Baja Stock</h4>
                        </div>
                        <div class="modal-body">
                            <!--<p class="help-block">¿Esta seguro que desea eliminar este registro de stock?</p>-->
                            <div class="form-group">
                                <label class="form-label col-sm-8">Fecha de salida:</label>
                                <div class="col-sm-8">
                                <input placeholder="Fecha:" value="<?php echo \Carbon\Carbon::now()->format('Y-m-d');?>" type="text" class="form-control" id="fecha_out" name="fecha_out"readonly="true">
                                </div>
                                <label class="form-label col-sm-8">Precio de salida:</label>
                                <div class="col-sm-8">
                                <input type="number" class="form-control" name="precioSalida" id="precioSalida">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-success" value="Confirmar">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<style>
    #table { font-size: 0.8em; }
</style>-->
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
    /*$('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );*/
    var table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": '/datatables/getstock',
        "columns":[
            {data: 'codbarras', name:'prods.codbarras'},
            {data: 'marca', name:'prods.marca'},
            {data: 'modelo', name:'prods.modelo'},
            {data: 'serial', name:'serial'},
            {data: 'fechaEntrada', name:'fechaEntrada'},
            {data: 'fechaSalida', name:'fechaSalida'},
            {data: 'precioEntrada', name:'precioEntrada', render: $.fn.dataTable.render.number('.', ',', 2 ,"$")},
            {data: 'precioSalida', name:'precioSalida', render: $.fn.dataTable.render.number('.', ',', 2 ,"$")},
            {data: 'nombre', name:'provs.nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ],
        "language":{
                    url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
        },
        "bFilter": true,
    });
    /*table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/
    $("#fecha_1").datepicker({
                    dateFormat: 'yy-mm-dd',
                    todayHighlight: true,
                    numberOfMonths: 1,   
                    showAnim: "slideDown",
                    onClose: function(selectedDate) {
                    },
                    onSelect: function(dateText, inst) {
                        $('#fecha_1').attr('value',dateText);
                    }
                }).datepicker("setDate", "0");
    $("#fecha_out").datepicker({
                    dateFormat: 'yy-mm-dd',
                    todayHighlight: true,
                    numberOfMonths: 1,   
                    showAnim: "slideDown",
                    onClose: function(selectedDate) {
                    },
                    onSelect: function(dateText, inst) {
                        $('#fecha_1').attr('value',dateText);
                    }
                }).datepicker("setDate", "0");
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
    $('#modelo_1').select2();
    $('#serial_1').select2({

    });
})
var i = 1;
function addRow(){
    console.log('work');
    i++;
    for(j = 1;j<i;j++){
        $('#codbarras_'+i).select2("destroy");
        $('#proveedor_'+i).select2("destroy");
        $('#modelo_'+i).select2("destroy");
        $('#fecha_'+i).datepicker("destroy");
    }
    
    $('#tabla').append('<tr id="row'+i+'"><td style="width:18%"><select data-ex="added" data-row="'+i+'" class="form-control" name="codbarras[]" id="codbarras_'+i+'"></select></td><td style="width:15%"><select name="modelo[]" class="form-control" id="modelo_'+i+'"></select></td><td style="width:20%"><select  data-hid="hidadded" data-row="'+i+'" name="serial[]" class="form-control" id="serial_'+i+'" multiple="multiple"></select><input type="hidden" name="cantidadseriales[]" value="0" id="cantidadseriales_'+i+'"></td><td style="width:10%"><select name="proveedor[]" class="form-control" id="proveedor_'+i+'"></select></td><td style="width:12%"><input type="number" class="form-control" name="precioEntrada[]" id="precioEntrada_'+i+'"></td><td style="width:15%"><input placeholder="Fecha:" value="<?php echo \Carbon\Carbon::now()->format('Y-m-d');?>" name="fecha[]" type="text" class="form-control" id="fecha_'+i+'" readonly="true"></td><td style="width:10%"><input  data-bot="add" class="btn btn-success" tabindex="1" type="button" onclick="addRow()" name="add"  id="add_'+i+'" value="+"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    for(j=1;j<i;j++){
        $('#serial_'+i).select2();
        $('#modelo_'+i).select2();
        $('#codbarras_'+i).select2({
            placeholder: 'Código de barras',
            ajax: ajax,
        });
        $('#proveedor_'+i).select2({
            placeholder: 'Proveedores',
            ajax: ajaxProveedor,
        });
        $('#fecha_'+i).datepicker({
                    dateFormat: 'yy-mm-dd',
                    todayHighlight: true,
                    numberOfMonths: 1,   
                    showAnim: "slideDown",
                    onClose: function(selectedDate) {
                    },
                    onSelect: function(dateText, inst) {
                        $('#fecha_'+i).attr('value',dateText);
                    }
                }).datepicker("setDate", "0");
    }
    
    $('[data-ex="added"]').on("select2:select",function(e){
        $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).empty().trigger("change");
        $.getJSON('/ajax/productos',    {
            mod: e.params.data.text
        },function(data){
            $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).select2({
                placeholder: 'Modelo',
                data: data
            });
        });
        $('#serial_'+e.delegateTarget.attributes[1].nodeValue).select2({
        placeholder: 'Serial',
        tags: true,
        ajax:   {
                    url:'/ajax/seriales',
                    data: function (params) {
                        var query ={
                            search: params.term,
                            mod: e.params.data.text
                        }
                        return query;
                    },
                    dataType: 'json',
                    processResults: function(data){
                        data.forEach(function(e) {
                            e.disabled = true;
                        });
                        
                        return {
                            results: data
                        }
                    }

                }

        });
    });

    $('[data-hid="hidadded"]').on("select2:select", function(e){
        var test = $('#serial_'+e.delegateTarget.attributes[1].nodeValue).val() + '';
        var test2 = test.split(",");
        $('#cantidadseriales_'+e.delegateTarget.attributes[1].nodeValue).val(test2.length);
    });
    $('[data-hid="hidadded"]').on("select2:unselect",function(e){
        var test = $('#serial_'+e.delegateTarget.attributes[1].nodeValue).val() + '';
        if(test== ""){
            $('#cantidadseriales_'+e.delegateTarget.attributes[1].nodeValue).val(0);    
        }else{
            var test2 = test.split(",");
            $('#cantidadseriales_'+e.delegateTarget.attributes[1].nodeValue).val(test2.length);
        }
    });
}

$('[data-ex="asd"]').on("select2:select",function(e){
    $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).empty().trigger("change");
    $.getJSON('/ajax/productos',    {
            mod: e.params.data.text
        },function(data){
            $('#modelo_'+e.delegateTarget.attributes[1].nodeValue).select2({
                placeholder: 'Modelo',
                data: data
            });
        });
    $('#serial_'+e.delegateTarget.attributes[1].nodeValue).select2({
        placeholder: 'Serial',
        tags: true,
        ajax: {
            url:'/ajax/seriales',
            data: function (params) {
                var query ={
                    search: params.term,
                    mod: e.params.data.text
                }
                return query;
            },
            dataType: 'json',
            processResults: function(data){
                data.forEach(function(e) {
                     e.disabled = true;  

                });
                return {
                    results: data
                }
            }

            }

    });
});
$('[data-hid="hidorigin"]').on("select2:select", function(e){
    var test = $('#serial_1').val() + '';
    var test2 = test.split(",");
    $('#cantidadseriales_1').val(test2.length);
});
$('[data-hid="hidorigin"]').on("select2:unselect",function(e){
    var test = $('#serial_1').val() + '';
    if(test== ""){
        $('#cantidadseriales_1').val(0);    
    }else{
        var test2 = test.split(",");
        $('#cantidadseriales_1').val(test2.length);
    }
});

$(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id).remove();
}); 

$('#table').on('draw.dt', function () {
    $(".delete").click(function(){
        $('#delete').modal();
        var id = $(this).data('id');
        console.log(id);
        $("#titulo").html(" Eliminar del stock "+$(this).closest("tr").children("td").eq(0).html());
        $(".id").val(id);
    });
});

$('#table').on('draw.dt', function(){
    $(".out").click(function(){
        $('#out').modal();
        var id = $(this).data('id');
        console.log(id);
        $("#titulout").html("Salida de: "+$(this).closest("tr").children("td").eq(2).html()+" ("+$(this).closest("tr").children("td").eq(3).html()+")");
        $(".id").val(id);
    });

});

jQuery(function($) {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '&#x3c;Ant',
        nextText: 'Sig&#x3e;',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
        ],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
$("#ocultar").fadeTo(8000, 500).slideUp(500, function(){
    $("ocultar").alert('close');
});
</script>

@endsection