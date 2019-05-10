@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project View </h1>
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectView, ['route' => ['projectViews.update', $projectView->id], 'method' => 'patch']) !!}

            @include('project_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection