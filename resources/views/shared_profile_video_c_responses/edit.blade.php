@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Video Comment Response </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileVideoCommentResponse, ['route' => ['sharedProfileVideoCommentResponses.update', $sharedProfileVideoCommentResponse->id], 'method' => 'patch']) !!}

            @include('shared_profile_video_comment_responses.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection