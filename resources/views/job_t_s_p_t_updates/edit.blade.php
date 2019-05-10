@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S P T Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSPTUpdate, ['route' => ['jobTSPTUpdates.update', $jobTSPTUpdate->id], 'method' => 'patch']) !!}

            @include('job_t_s_p_t_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection