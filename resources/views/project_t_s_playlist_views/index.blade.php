@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">Project T S Playlist Views</h1>

  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('project_t_s_playlist_views.table')
            
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>
  
@endsection