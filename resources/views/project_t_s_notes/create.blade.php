@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_note_create').on('submit', function() {
      
      var project_t_s_note_name = document.getElementById("name").value;
      var project_t_s_note_description = document.getElementById("description").value;
      
      if(project_t_s_note_name.length >= 100)
      {
        alert("Invalid character number for the note name.");
        return false;
      }
      
      if(project_t_s_note_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(project_t_s_note_name == '' || project_t_s_note_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_note_name != '' && project_t_s_note_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Section Note </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTSNotes.store', 'id' => 'project_t_s_note_create']) !!}

            @include('project_t_s_notes.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#notes" data-toggle="tab">
        
          <i class="fa fa-sticky-note"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="notes">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Notes </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSNotesList as $projectTSNoteList)
            
              <li>
                
                <a href="{!! route('projectTSNotes.show', [$projectTSNoteList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSNoteList -> name !!} </h4>
                    <p> {!! $projectTSNoteList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection