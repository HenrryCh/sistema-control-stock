
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\DashboardControlador@dashboard')}}" class="nav-link">
        <i class="nav-icon fa fa-home"></i>
        <p>
          Inicio
          <i class=""></i>
        </p>
    </a>
    {{-- Desplejar 
    <ul class="nav nav-treeview">
        <li class="nav-item d-none d-lg-block" style="margin-left: 2rem;"> <a class="nav-link" href="{{URL::action('App\Http\Controllers\DashboardControlador@dashboard')}}"></i>Inicio</a></li>
    </ul>
    --}}
</li>

@role('Gerente')
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-users"></i>
        <p>
          Usuarios
          <i class="right fas fa-angle-right"></i> 
        </p>
    </a>
    <ul class="nav nav-treeview">
        @can('list roles')
        <li class="nav-item"> <a href="{{URL::action('App\Http\Controllers\RolesControlador@index')}}" class="nav-link" style="margin-left: 2rem;">
            Roles</a></li>
        @endcan
        @can('list users')
        <li class="nav-item"> <a href="{{URL::action('App\Http\Controllers\UsersControlador@index')}}" class="nav-link" style="margin-left: 2rem;"><i class=""></i>
            Usuarios</a></li>
        @endcan        
    </ul>
</li>
@endrole
@can('list proveedores')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@index')}}" class="nav-link">
        <i class="nav-icon fas fa-truck"></i>
        <p>
          Proveedores
          {{--  
          <i class="right fas fa-angle-right"></i>
          --}}
        </p>
    </a>

    {{--  Deslegar proveedores
    <ul class="nav nav-treeview">
        
        @can('list proveedores')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@index')}}" class="nav-link"  style="margin-left: 2rem;">
                <i class=""></i>
                <p>Proveedores</p>
            </a>
        </li>
        @endcan
    </ul> 
    --}}
</li>
@endcan
@can('list categorias')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@index')}}" class="nav-link">
        <i class="nav-icon fas fa-th-list"></i>
        <p>
          Categorías
          {{--  
          <i class="right fas fa-angle-right"></i>
          --}}
        </p>
    </a>
    {{--  
    <ul class="nav nav-treeview">
        @can('list categorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@index')}}" class="nav-link"  style="margin-left: 2rem;">
                <i class=""></i>
                <p>Categorias</p>
            </a>
        </li>
        @endcan
    </ul>
    --}}
</li>
@endcan
@can('list productos')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\ProductosControlador@index')}}" class="nav-link">
        <i class="nav-icon fas fa-box-open"></i>
        <p>
          Productos
          {{--  
          <i class="right fas fa-angle-right"></i>
          --}}
        </p>
    </a>
    {{--  
    <ul class="nav nav-treeview">
        @can('list productos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProductosControlador@index')}}" class="nav-link"  style="margin-left: 2rem;">
                <i class=""></i>
                <p>Productos</p>
            </a>
        </li>
        @endcan
        
    </ul>
    --}}
</li>
@endcan
@can('list ingresos')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="nav-link">
        <i class="fas fa-sign-in-alt"></i>
        <p>
          Ingresos
          {{--  
          <i class="right fas fa-angle-right"></i>
          --}}
        </p>
    </a>
    {{--  
    <ul class="nav nav-treeview">
        
        @can('list ingresos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Ingresos</p>
            </a>
        </li>
        @endcan
    </ul>
    --}}
</li>
@endcan
@can('list salidas')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="nav-link">
        <i class="fas fa-sign-out-alt"></i>
        <p>
          Salidas
          {{--  
          <i class="right fas fa-angle-right"></i>
          --}}
        </p>
    </a>
    {{--  
    <ul class="nav nav-treeview">
        
        @can('list salidas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Salidas</p>
            </a>
        </li>
        @endcan
    </ul>
    --}}
</li>
@endcan

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-undo-alt"></i>
        <p>
          Devoluciones
          <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @can('list motivo_devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\Motivo_devolucionesControlador@index')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Motivo de Devoluciones</p>
            </a>
        </li>
        @endcan
        @can('list devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@index')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Devoluciones</p>
            </a>
        </li>
        @endcan
    </ul>
</li>
{{--  
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>
          Otros
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- @can('list categorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorias</p>
            </a>
        </li>
        @endcan
        @can('list motivo_devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\Motivo_devolucionesControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Motivo Devoluciones</p>
            </a>
        </li>
        @endcan -->
        @can('list negocio')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\NegocioControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Negocio</p>
            </a>
        </li>
        @endcan
        <!-- @can('list proveedores')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedores</p>
            </a>
        </li>
        @endcan
        @can('list salidas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Salidas</p>
            </a>
        </li>
        @endcan
        @can('list ingresos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ingresos</p>
            </a>
        </li>
        @endcan
        @can('list devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Devoluciones</p>
            </a>
        </li>
        @endcan
        @can('list productos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProductosControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos</p>
            </a>
        </li>
        @endcan -->
        
    </ul>
</li>
--}}
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fas fa-file-alt"></i>
        <p>
          Reportes
          <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @can('report productos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProductosControlador@report')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Productos</p>
            </a>
        </li>
        @endcan
        @can('report ingresos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\IngresosControlador@report')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Ingresos</p>
            </a>
        </li>
        @endcan
        @can('report salidas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\SalidasControlador@report')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Salidas</p>
            </a>
        </li>
        @endcan
        @can('report devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@report')}}" class="nav-link" style="margin-left: 2rem;">
                <i class=""></i>
                <p>Devoluciones</p>
            </a>
        </li>
        @endcan
        {{--  
        @can('report categorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@report')}}" class="nav-link">
                <i class="nav-icon far fa-address-book"></i>
                <p>Categorias</p>
            </a>
        </li>
        @endcan
        
        @can('report motivo_devoluciones')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\Motivo_devolucionesControlador@report')}}" class="nav-link">
                <i class="nav-icon far fa-address-book"></i>
                <p>Motivo Devoluciones</p>
            </a>
        </li>
        @endcan
        @can('report negocio')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\NegocioControlador@report')}}" class="nav-link">
                <i class="nav-icon far fa-address-book"></i>
                <p>Negocio</p>
            </a>
        </li>
        @endcan
        @can('report proveedores')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@report')}}" class="nav-link">
                <i class="nav-icon far fa-address-book"></i>
                <p>Proveedores</p>
            </a>
        </li>
        @endcan
        --}}       
    </ul>
</li>


<!-- <li>
  <a href="#">
    <i class="fa fa-plus-square"></i> <span>Ayuda</span>
    <small class="label pull-right bg-red">PDF</small>
  </a>
</li>
<li>
  <a href="#">
    <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
    <small class="label pull-right bg-yellow">IT</small>
  </a>
</li> -->