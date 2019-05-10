@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Video Comment Response </h1>
    
  </section>
    
  <div class="content">
      
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('public_video_comment_responses.show_fields')
          <a href="{!! route('publicVideoCommentResponses.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection