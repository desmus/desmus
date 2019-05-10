@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_college_t_s_note_create').on('submit', function() {
      
      var user_college_t_s_note_description = document.getElementById("description").value;
      var user_college_t_s_note_user_id = document.getElementById("user_id").value;
      
      if(user_college_t_s_note_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_college_t_s_note_description == '' || user_college_t_s_note_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_college_t_s_note_description != '' || user_college_t_s_note_user_id == '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Add User </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCollegeTSNotes.store', 'id' => 'user_college_t_s_note_create']) !!}

            @include('user_college_t_s_notes.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class = "active">
        
        <a href="#user_college_notes" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#note_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#note_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_college_notes">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Note Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTSNotesList as $userCollegeTSNoteList)
            
              <li>
                
                <a href="{!! route('userCollegeTSNotes.edit', [$userCollegeTSNoteList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTSNoteList -> name !!} </h4>
                    <p> {!! $userCollegeTSNoteList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Note Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSNoteViewsList as $collegeTSNoteViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSNoteViewList -> name !!} </h4>
                    <p> {!! $collegeTSNoteViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Note Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSNoteUpdatesList as $collegeTSNoteUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSNoteUpdateList -> name !!} </h4>
                    <p> {!! $collegeTSNoteUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
  
@endsection