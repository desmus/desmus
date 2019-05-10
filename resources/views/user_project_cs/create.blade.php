@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project C </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userProjectCs.store']) !!}

            @include('user_project_cs.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
@endsection