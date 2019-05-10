@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public File Comment Response </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('public_file_comment_responses.show_fields')
          <a href="{!! route('publicFileCommentResponses.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection