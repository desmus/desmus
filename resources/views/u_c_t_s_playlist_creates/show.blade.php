@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U C T S Playlist Create </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('u_c_t_s_playlist_creates.show_fields')
          <a href="{!! route('uCTSPlaylistCreates.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection