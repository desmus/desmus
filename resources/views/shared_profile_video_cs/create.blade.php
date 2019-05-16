@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1>Shared Profile Video Comment </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileVideoCs.store']) !!}

            @include('shared_profile_video_cs.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection