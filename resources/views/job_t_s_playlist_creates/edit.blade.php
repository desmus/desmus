@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Playlist Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSPlaylistCreate, ['route' => ['jobTSPlaylistCreates.update', $jobTSPlaylistCreate->id], 'method' => 'patch']) !!}

            @include('job_t_s_playlist_creates.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsections