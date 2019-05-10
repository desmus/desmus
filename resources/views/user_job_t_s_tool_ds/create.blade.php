@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job T S Tool D </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userJobTSToolDs.store']) !!}

            @include('user_job_t_s_tool_ds.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection