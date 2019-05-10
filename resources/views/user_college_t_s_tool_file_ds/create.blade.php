@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College T S Tool File D </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCollegeTSToolFileDs.store']) !!}

            @include('user_college_t_s_tool_file_ds.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection