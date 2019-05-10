@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S Tool File U </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userProjectTSToolFileUs.store']) !!}

            @include('user_project_t_s_tool_file_us.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
    
    </div>
    
  </div>

@endsection