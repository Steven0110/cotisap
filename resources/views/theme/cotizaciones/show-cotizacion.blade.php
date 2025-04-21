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
              <li><a href="#">{{ 'Inicio' }}</a></li>
              <li><a href="#">{{ 'Cotizaciones' }}</a></li>
              <li class="active">{{ 'Cotizaci&oacute;n' }} # {{ $id }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Cotizaci&oacute;n' }} # {{ $id }}</h2>
            </div>
          </div>

         @include('theme.widgets.show-cotizacion-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection


