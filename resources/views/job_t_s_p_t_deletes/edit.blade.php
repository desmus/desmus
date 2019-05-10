@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S P T Delete </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSPTDelete, ['route' => ['jobTSPTDeletes.update', $jobTSPTDelete->id], 'method' => 'patch']) !!}

            @include('job_t_s_p_t_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection