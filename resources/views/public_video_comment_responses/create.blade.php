@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Video Comment Response </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'publicVideoCommentResponses.store']) !!}

            @include('public_video_comment_responses.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection