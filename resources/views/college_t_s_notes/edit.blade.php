@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_note_update').on('submit', function() {
      
      var college_t_s_note_name = document.getElementById("name").value;
      var college_t_s_note_description = document.getElementById("description").value;
      
      if(college_t_s_note_name.length >= 100)
      {
        alert("Invalid character number for the note name.");
        return false;
      }
      
      if(college_t_s_note_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_note_name == '' || college_t_s_note_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_note_name != '' && college_t_s_note_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSNote->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSNote, ['route' => ['collegeTSNotes.update', $collegeTSNote->id], 'method' => 'patch',  'id' => 'college_t_s_note_update']) !!}

            @include('college_t_s_notes.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
   
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#a_note_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
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
      
      <div class="tab-pane active" id="a_note_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Note Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSNoteTodolistsList as $collegeTSNoteTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTSNoteTodolists.show', [$collegeTSNoteTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSNoteTodolistList -> name !!} </h4>
                    <p> {!! $collegeTSNoteTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Note Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTSNoteTodolistsCompletedList as $collegeTSNoteTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTSNoteTodolists.show', [$collegeTSNoteTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTSNoteTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTSNoteTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_notes">
        
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