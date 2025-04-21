@extends('theme.body')

@section('company', 'Alianza Electrica')

@section('content')

    <div class="main-wrapper">
      
      @include('theme.topheader')

      <div class="an-page-content">
        <div class="an-sidebar-nav js-sidebar-toggle-with-click">

          @include('theme.widgets.sidebar-widget')

          @include('theme.menu')
          
        </div>

        <div class="an-content-body home-body-content">
          <div class="an-breadcrumb wow fadeInUp">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="#">Admin Panel</a></li>
              <li><a href="#">Dashboard</a></li>
              <li class="active">Usuarios</li>
            </ol>
          </div> <!-- end AN-BREADCRUMB -->
          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>Administración de empleados</h2>
            </div>
          </div> <!-- end AN-BODY-TOPBAR -->
          @include('theme.widgets.usuarios')

        </div>
      </div>

      @include('theme.widgets.footer')
      
    </div> 

@endsection