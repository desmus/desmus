@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S Tool View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSToolView, ['route' => ['projectTSToolViews.update', $projectTSToolView->id], 'method' => 'patch']) !!}

            @include('project_t_s_tool_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>
  
@endsection