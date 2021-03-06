@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S File View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSFileView, ['route' => ['collegeTSFileViews.update', $collegeTSFileView->id], 'method' => 'patch']) !!}

            @include('college_t_s_file_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection