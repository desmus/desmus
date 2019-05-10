@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S P T Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSPTUpdate, ['route' => ['projectTSPTUpdates.update', $projectTSPTUpdate->id], 'method' => 'patch']) !!}

            @include('project_t_s_p_t_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection