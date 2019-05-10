@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Image Comment </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileImageComments.store']) !!}

            @include('shared_profile_image_comments.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection