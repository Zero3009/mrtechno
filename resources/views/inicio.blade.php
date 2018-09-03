@extends('layouts.admin')
@section('main-content')
<div class="row">
    <div class="col-md-12" >
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
            <div class="panel-body" style="background: #D7D7D7">
            @if (session('status'))
                <div class="alert alert-success" id="ocultar">
                    {{ session('status') }}
                </div>
            @endif
            <div class="chart-container" style="position: relative; height:60vh; width:80vw">
                <canvas id="myChart" width="80" height="30"></canvas>
            </div>
            </div>
            	<div class="panel-footer">
            </div>
        </div>
    </div>
</div>
<!--<div class="modal fade" id="delete" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>-->
@stop
@section('js')
@push('scripts')
<script>
	$(document).ready(function(){
		$.getJSON('/ajax/chart',null, function(e){
				$.getJSON('/ajax/linesalida',null,function(data){
					datasets =[];
					linea = {};
					linea2 = {};
					datasets.push(linea);
					datasets.push(linea2);
					datasets[0].label = "Entrada";
					datasets[0].data = e;
                    console.log(data);
                    if(data[0].t != null){
                        datasets[1].label = "Salida";
                        datasets[1].data = data;
                    }
                    //console.log(datasets);
					var ctx = document.getElementById("myChart").getContext('2d');
					var myChart = new Chart(ctx, {
					    type: 'line',
					    data: {
					        //labels: ["Red"],
					        datasets: datasets
					    },
					    options: {
                            responsive: true,
                            legend:{
                                display: true,
                                position: 'right',
                            },
                            /*title: {
                                    display: true,
                                    text: 'Intervenciones (Ultimos 7 días)',
                                    fontFamily: 'Arial'
                                },*/
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        zeroLineColor: '#000000'
                                    },   
                                    ticks: {
                                        beginAtZero:true,
                                        min: 0,
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        zeroLineColor: '#000000'
                                    },
                                    type: 'time',
                                    display: true,
                                    time: {
                                        unit:'day',
                                    },
                                    bounds: 'data'
                                }]
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false,
                            }
                        }
					});
				});
		});
	});
	

/*$(document).ready(function () {
var tabla = $('#tabla').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": '/datatables/getproveedores',
    "columns":[
        {data: 'nombre', name:'nombre'},
        {data: 'tel', name:'tel'},
        {data: 'action', name: 'action', orderable: false}
    ],
    "language":{
                url: "{!! asset('/plugins/datatables/lenguajes/spanish.json') !!}"
    },
    "bFilter": true,
});

});
$('#tabla').on('draw.dt', function () {
    $(".delete").click(function(){
        $('#delete').modal();
        var id = $(this).data('id');
        console.log(id);
        $("#titulo").html(" Eliminar proveedor "+$(this).closest("tr").children("td").eq(0).html());
        $(".id").val(id);
    });
});

$("#ocultar").fadeTo(8000, 500).slideUp(500, function(){
    $("ocultar").alert('close');
});
*/
</script>
@endsection