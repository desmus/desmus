@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Recent Activity View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($recentActivityView, ['route' => ['recentActivityViews.update', $recentActivityView->id], 'method' => 'patch']) !!}

            @include('recent_activity_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection