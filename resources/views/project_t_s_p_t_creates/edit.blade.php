@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S P T Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSPTCreate, ['route' => ['projectTSPTCreates.update', $projectTSPTCreate->id], 'method' => 'patch']) !!}

            @include('project_t_s_p_t_creates.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection