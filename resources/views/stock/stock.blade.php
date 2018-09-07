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

                <form method="POST" action="/admin/stock/nuevo/post" accept-charset="UTF-8" class="form-horizontal" id="app">
                    @verbatim
                    <!--<template id="app">-->
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
                            <tr v-bind:id="'row_' + n.id" v-for="n in rows">
                                
                                <td style="width:18%">
                                    <v-select :options="options" v-model="n.codbarras" placeholder="Código de barras"></v-select>
                                    <template v-if="n.codbarras != null">
                                        <input type="hidden" name="codbarras[]" v-model="n.codbarras.value">
                                    </template></td>
                                <td style="width:15%">
                                    <template v-if="n.codbarras != null">
                                        <label class="form-control">{{n.codbarras.modelo}}</label>
                                    </template>
                                </td>
                                <td style="width:20%">
                                    <v-select v-model="n.seriales" :options="seriales" multiple="true" taggable="true" placeholder="Seriales"></v-select>
                                    <template v-if="n.seriales != null"><input type="hidden" name="seriales[]" v-model="n.seriales">
                                    </template>
                                <td style="width:10%">

                                    <v-select :options="proveedores" v-model="n.proveedor" placeholder="Proveedor"></v-select>
                                    <template v-if="n.proveedor != null">
                                        <input type="hidden" name="proveedor[]" v-model="n.proveedor.value">
                                    </template>
                                </td>
                                <td style="width:12%">
                                    <input type="number" class="form-control" name="precioEntrada[]" id="precioEntrada_1">
                                </td>
                                <td style="width:15%">
                                    <vuejs-datepicker input-class="form-control" :value="state.date" format="yyyy-MM-dd" name="fecha[]" placeholder="Fecha" :language="es" full-month-name></vuejs-datepicker>
                                </td>
                                <td style="width:10%">
                                    <input data-bot="add" class="btn btn-success" v-on:click="aument()" tabindex="1" type="button" name="add"  id="add_1" value="+">
                                    <button  type="button" name="remove" v-on:click="decrease($event)" v-bind:id="n.id" v-show="n.id > 1" class="btn btn-danger">X</button>
                                </td>
                            </tr>
                        </table>
                        @endverbatim
                        <input class="btn btn btn-success" tabindex="1" type="submit" value="Cargar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--</template>-->
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
                                <!--<input placeholder="Fecha:" value="<?php echo \Carbon\Carbon::now()->format('Y-m-d');?>" type="text" class="form-control" id="fecha_out" name="fecha_out"readonly="true">-->
                                <vuejs-datepicker input-class="form-control" :value="state.date" format="yyyy-MM-dd" name="fecha_out" placeholder="Fecha" :language="es" full-month-name></vuejs-datepicker>
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
@stop
@section('js')
@push('scripts')
<script>
    var state = {
        date: new Date()
    }
    Vue.component('v-select', VueSelect.VueSelect);
    var vm = new Vue({
        el: "#app",
        data: {
            selected: null,
            tag: null,
            selected2: null,
            options: [],
            proveedores: [],
            seriales: [],
            rows: [
                {
                    id: 1,
                    codbarras: null,
                    proveedor: null,
                    seriales: null
                }
            ],
            es: {Language: 'Spanish',
                   months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                   monthsAbbr: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                   days: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab'],
                   rtl: false,
                   ymd: false,
                   yearSuffix: ''
            },
            url: '/ajax/productos',
            url2: '/ajax/codbarras',
            url3: '/ajax/proveedores',
            url4: '/ajax/seriales'
        },
        components: {
            vuejsDatepicker,
            Vuetable
        },
        methods: {
            cargarSelects()
            {
                this.codbarras();
                this.provees();
                this.serials();
            },
            codbarras()
            {
                axios.get(this.url2)
                    .then(response => {
                        this.options = response.data;
                });
            },
            serials()
            {
                axios.get(this.url4)
                    .then(response => {
                        //this.seriales = response.data;
                        var a = [];
                        response.data.forEach(function(item){
                            a.push(item.label);
                        });   
                        //console.log(a);
                        this.seriales = a;
                })
            },
            provees()
            {
                axios.get(this.url3)
                    .then(response => {
                        
                        this.proveedores = response.data;

                });
            },
            aument() 
            {
                return this.rows.push({id: this.rows[this.rows.length - 1].id + 1, codbarras: null, proveedor: null, seriales: null});
            },
            decrease(event) 
            {
                index = this.rows.findIndex(x => x.id==event.currentTarget.id);
                return Vue.delete(this.rows, index);
            }
        },
        beforeMount()
        {
            this.cargarSelects();
        }
    });
$(document).ready(function(){
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
})

$('#table').on('draw.dt', function () {
    $(".delete").click(function(){
        $('#delete').modal();
        var id = $(this).data('id');
        $("#titulo").html(" Eliminar del stock "+$(this).closest("tr").children("td").eq(0).html());
        $(".id").val(id);
    });
});

$('#table').on('draw.dt', function(){
    $(".out").click(function(){
        $('#out').modal();
        var id = $(this).data('id');
        $("#titulout").html("Salida de: "+$(this).closest("tr").children("td").eq(2).html()+" ("+$(this).closest("tr").children("td").eq(3).html()+")");
        $(".id").val(id);
    });

});
$("#ocultar").fadeTo(8000, 500).slideUp(500, function(){
    $("ocultar").alert('close');
});
</script>

@endsection