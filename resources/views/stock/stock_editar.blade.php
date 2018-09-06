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
	            <div class="panel-body" id="app">
                    <div class="form-group">

                        @verbatim
                        <label class="control-label col-sm-2">Código de barras:</label>
                        <div class="col-sm-4">
                            <v-select :options="codigos" v-model="selected" placeholder="Código de barras"></v-select>
                            <input type="hidden" name="codbarras" v-model="selected.value">
                        </div>
                        <label class="control-label col-sm-2">Modelo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" v-model="selected.modelo" disabled>
                        </div>
                        @endverbatim
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Serial:</label>
                    	<div class="col-sm-4">
                            <v-select :options="seriales" v-model="serial" placeholder="Serial" taggable></v-select>
                            <input type="hidden" name="serial" v-model="serial.label">
                    	</div>
                    	<label class="control-label col-sm-2">Proveedor:</label>
                    	<div class="col-sm-4">
                            <v-select :options="proveedores" v-model="proveedor" placeholder="Proveedor"></v-select>
                            <input type="hidden" name="proveedor" v-model="proveedor.value">
                    	</div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-sm-2">Fecha Entrada:</label>
                    	<div class="col-sm-4">
                            <vuejs-datepicker input-class="form-control" value="{{$stock->fechaEntrada}}" :language="es" format="yyyy-MM-dd" name="fecha"></vuejs-datepicker>
                    	</div>
                    	<label class="control-label col-sm-2">Precio Entrada:</label>
                        <div class="col-sm-4">
                    		<input type="number" value="{{$stock->precioEntrada}}" class="form-control" name="precioEntrada" id="precioEntrada">
                     	</div>
                    </div>

                    <template v-if="blade.fechaSalida">
                        <div class="form-group">
                        	<label class="control-label col-sm-2">Fecha:</label>
                        	<div class="col-sm-4">
                                <vuejs-datepicker input-class="form-control" value="{{$stock->fechaSalida}}" :language="es" format="yyyy-MM-dd" name="fechaSalida"></vuejs-datepicker>
                        	</div>
                        	<label class="control-label col-sm-2">Precio Salida:</label>
                            <div class="col-sm-4">
                        		<input type="number" value="{{$stock->precioSalida}}" class="form-control" name="precioSalida" id="precioSalida">
                         	</div>
                        </div>
                    </template>
                    
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
    Vue.component('v-select', VueSelect.VueSelect);
    var vm = new Vue({
        el: "#app",
        data: {
            codigos: [],
            seriales: [],
            proveedores: [],
            blade: null,
            selected: null,
            serial: null,
            proveedor: null,
            url: '/ajax/codbarras',
            url2: '/ajax/seriales',
            url3: '/ajax/proveedores',
            es: {Language: 'Spanish',
                   months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                   monthsAbbr: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                   days: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab'],
                   rtl: false,
                   ymd: false,
                   yearSuffix: ''
            }
        },
        components: {
            vuejsDatepicker,
        },
        methods:{
            codbarras()
            {
                axios.get(this.url)
                    .then(response => {
                        for(a = 0;a <response.data.length;a++)
                        {
                            if(this.blade.codbarras == response.data[a].label)
                            {
                                this.selected = response.data[a];
                            }
                        }
                        this.codigos = response.data;
                });
                axios.get(this.url2)
                    .then(response => {
                        for(a = 0;a <response.data.length;a++)
                        {
                            if(this.blade.serial == response.data[a].label)
                            {
                                this.serial = response.data[a];
                            }
                        }
                        this.seriales = response.data;
                });
                axios.get(this.url3)
                    .then(response => {
                        for(a = 0; a <response.data.length;a++)
                        {
                            if (this.blade.nombre == response.data[a].label) 
                            {
                                this.proveedor = response.data[a];
                            }
                            this.proveedores = response.data;
                        }
                });
            }

        },
        beforeMount()
        {
            this.blade = {!! json_encode($stock->toArray()) !!};
            this.codbarras();
        }
    });
	/*$(document).ready(function(){
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
			$("#fechaSalida").datepicker({
                    dateFormat: 'yy-mm-dd',
                    todayHighlight: true,
                    numberOfMonths: 1,   
                    showAnim: "slideDown",
                    onClose: function(selectedDate) {
                    },
                    onSelect: function(dateText, inst) {
                        $('#fechaSalida').attr('value',dateText);
                    }
                }).datepicker();
		$.getJSON('/ajax/seriales',null,function(data){
				var filteredSerial = data.filter(function(item){
					if(item.text == "{{$stock->serial}}") {
						$('#serial').append('<option value="'+item.text+'" selected>'+item.text+'</option>');
					}else{
						item.disabled = true;
						return item;
					}
				});
				console.log(filteredSerial);
				$('#serial').select2({
					tags: true,
					placeholder: 'Serial',
					data: filteredSerial
				});
		});

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
});*/

</script>
@endsection