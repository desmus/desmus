@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S Note U </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userProjectTSNoteUs.store']) !!}

            @include('user_project_t_s_note_us.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection