@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Galery Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSGaleryDelete, ['route' => ['jobTSGaleryDeletes.update', $jobTSGaleryDelete->id], 'method' => 'patch']) !!}

            @include('job_t_s_galery_deletes.fields')

          {!! Form::close() !!}
        
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsections