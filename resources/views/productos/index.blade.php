@extends ('layouts.admin')
@section('title',"Productos - UVStock")
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Productos<a href="productos/create"></a></h4>
	</div>	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('productos.create')
		@include('productos.search')

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
		@endif
	</div>
	{{-- 
	@can('create productos')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<button type="button" class="btn btn-add" style="color=white; background-color=orange;" data-toggle="modal" data-target="#modal_Productos_Create">{{__('+ Nuevo')}}</button>
		</div>
	</div>
	@endcan
	--}}
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card"> 
			<div class="card-header">
                	@can('create productos')
					<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
						<div class="text-right">
							<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Productos_Create">
								<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}</button>
						</div>
					</div>
					@endcan
            </div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							
							<th class="text-center">Código</th>
							<th class="text-center">Nombre</th>
							{{--  
							<th class="text-center">Descripcion</th>
							--}}
							<th class="text-center">Marca</th>
							<th class="text-center">Categoría</th>
							<th class="text-center">Proveedor</th>
							<th class="text-center">Precio Compra</th>
							<th class="text-center">Precio Venta</th>
							<th class="text-center">Cantidad</th>
							{{--  
							<th class="text-center">Stock Minimo</th>
							--}}
							<th class="text-center">Estado</th>
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		                @foreach ($productos as $producto)
							<tr>
								
								<td class="text-center">{{$producto->codigo}}</td>
								<td class="text-center">{{$producto->nombre}}</td>
								{{--  
								<td class="text-center">{{$producto->descripcion}}</td>
								--}}
								<td class="text-center">{{$producto->marca}}</td>
								<td class="text-center">{{$producto->categoria->nombre}}</td>
								<td class="text-center">{{$producto->proveedore->nombre}}</td>
								<td class="text-center">{{$producto->precio_compra}}</td>
								<td class="text-center">{{$producto->precio_venta}}</td>
								<td class="text-center">{{$producto->cantidad}}</td>
								{{--  
								<td class="text-center">{{$producto->stock_minimo}}</td>
								--}}
								{{--  
								<td class="text-center"><button class="btn @if ($producto->estado==1 or $producto->estado== "active") btn-success @else btn-secondary @endif  btn-sm">
									@if ($producto->estado==1 or $producto->estado=="active") Activo @else Inactivo @endif</button></td>
								--}}
								<td class="text-center">
									<span class="badge @if ($producto->estado==1 or $producto->estado== "active") badge-success @else badge-secondary @endif btn-sm badge" style="font-size: 14px; padding: 5px 10px; border-radius: 5px; text-align: center; width: 65px; font-weight: normal;">
									@if ($producto->estado==1 or $producto->estado=="active")
										Activo
									@else
										Inactivo
									@endif
									</span>
								</td>
								<td class="d-flex justify-content-center">
									@can('show productos')
			                        <a href="" data-target="#modal-ver-{{$producto->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class='fa fa-eye'></i></button></a>
			                        @endcan
									@can('edit productos')
									<a href="" data-target="#modal-edit-{{$producto->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class='fa fa-edit'></i></button></a>
									@endcan
									{{--  
									@can('delete productos')
									<a href="" data-target="#modal-delete-{{$producto->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow"><i class='fa fa-trash'></i></button></a>
			                        @endcan
									--}}
			                        @can('edit productos')
			                        <form action="/productos/{{ $producto->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$producto->estado ? 'secondary' : 'success'}} btn-sm shadow" type="submit" style="width: 82px;">{{ $producto->estado ? 'Desactivar' : 'Activar' }}</button>
									</form>
									@endcan
								</td>
							</tr>
							@include('productos.modal')
							@include('productos.edit')
							@include('productos.show')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $productos->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>
@endsection