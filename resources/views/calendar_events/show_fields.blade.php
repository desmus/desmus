@section('scripts')

  <script>

    DecoupledEditor
            
      .create(document.querySelector('#editor'))
            
      .then( editor => {
                
        const toolbarContainer = document.querySelector('#toolbar-container');
        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            
      })
            
      .catch( error => {
                
        console.error(error);
        
      });

  </script>

  <script>

    var jq=jQuery.noConflict();
    
    jq(document).ready( function(){
      
      jq(document).keydown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
      
      jq(document).mousedown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
    
    });

  </script>

@endsection

{!! Form::model($calendarEvent, ['route' => ['calendarEvents.update', $calendarEvent->id], 'method' => 'patch', 'id' => 'calendar_update']) !!}

  {{ csrf_field() }}

    <div id="edit_event" class="modal fade" role="dialog">
      
      <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
          
          <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
              <span aria-hidden="true">×</span>
            
            </button>
            
            <h4 class="modal-title"> Edit Calendar Event</h4>
            
          </div>
          
          <div class="modal-body">
            
            <div class = "row">
              
              <div class="form-group col-sm-12">
                
                <label for="name"> Title </label>
                <input id = "name" class="form-control" type="text" name="name" value = "{!! $calendarEvent -> name !!}"/>
                
              </div>
              
              <div class="form-group col-sm-12">
                
                <label for="description"> Description </label>
                <textarea id = "description" class="form-control" name="description">{!! $calendarEvent -> description !!}</textarea>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="start_date"> Start Date </label>
                <input id = "start_date" class="form-control" type="text" name="start_date" value = "{!! $s_date !!}" readonly/>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="start_time"> Start Time </label>
                <input id = "start_time" class="form-control" type="time" name="start_time" value = "{!! $s_time !!}"/>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="finish_date"> End Date </label>
                <input id = "finish_date" class="form-control" type="date" name="finish_date" value = "{!! $e_date !!}" min=""/>
                
              </div>
              
              <div class="form-group col-sm-4">
                
                <label for="finish_time"> End Time </label>
                <input id = "finish_time" class="form-control" type="time" name="finish_time" value = "{!! $e_time !!}"/>
                
              </div>
              
              <div class="form-group col-sm-2">
                
                <label for="color"> Color </label>
                <input id = "color" class="form-control" type="color" name="color" value = "{!! $calendarEvent -> color !!}"/>
                
              </div>
              
              <input class="form-control" type="hidden" name="user_id" value="{{$user_id}}"/>
              
            </div>
            
          </div>
          
          <div class="modal-footer">
            
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
{!! Form::close() !!}

<section class="content" style="padding-bottom: 0; min-height: 30px;">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#calendar_event_info" data-toggle="tab"> Information </a></li>
          <li><a href="#calendar_event_statistics" data-toggle="tab"> Statistics </a></li>
          <li><a href="#calendar_event_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#calendar_event_updates_history" data-toggle="tab"> Updates History </a></li>
          <li><a href="" data-toggle="modal" data-target="#edit_event"> Edit Event </a></li>
          <li><a href="{!! route('userCalendarEvents.show', [$calendarEvent->id]) !!}"> Share Event </a></li>
          <li><a href="{!! route('calendarEvents.destroy', [$calendarEvent->id]) !!}" onclick = "return confirm('Are you sure?')"> Delete Event </a></li>
          
        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "calendar_event_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $calendarEvent->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $calendarEvent->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('start_date', 'Start Datetime:') !!}
                <p>{!! $calendarEvent->start_date !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('finish_date', 'Finish Datetime:') !!}
                <p>{!! $calendarEvent->finish_date !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <p>{!! $calendarEvent->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $calendarEvent->updated_at !!}</p>
            </div>
            
          </div>

          <div class = "tab-pane" id = "calendar_event_statistics">

            <div class="col-lg-6 col-xs-6">
          
              <div class="small-box bg-green" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $calendarEvent -> views_quantity !!}</sup></h3>

                  <p>Views Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#calendar_event_views_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

            <div class="col-lg-6 col-xs-6">
          
              <div class="small-box bg-red" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $calendarEvent -> updates_quantity !!}</sup></h3>

                  <p>Updates Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#calendar_event_updates_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

          </div>
          
          <div class = "tab-pane" id = "calendar_event_views_history">
            
            <div class="box box-primary" style="margin-bottom: 0;">
              
              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  
                  <div class="row">
                    
                    <div class="col-sm-12">
                      
                      <div class="table-responsive" style="margin-bottom: 0;">
                        
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                          
                          <thead>
                            
                            <tr role="row">
                              
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                            
                          </thead>
                          
                          <tbody>
                            
                            @foreach($calendarEventViews as $calendarEventView)
                            
                              <tr role="row" class="odd">
                                
                                <td class=""> {!! $calendarEventView->name !!} </td>
                                <td class=""> {!! $calendarEventView->email !!} </td>
                                <td class=""> {!! $calendarEventView->datetime !!} </td>
                                
                              </tr>
                              
                            @endforeach
                            
                          </tbody>
                          
                        </table>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                </div>
            
              </div>
              
            </div>
            
          </div>

          <div class = "tab-pane" id = "calendar_event_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive" style="margin-bottom: 0;">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
                          <thead>
                  
                            <tr role="row">
  
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Actual Name </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Past Name </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime Update </th>
  
                            </tr>
                  
                          </thead>
                  
                          <tbody>
                    
                            @foreach($calendarEventUpdates as $calendarEventUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $calendarEventUpdate->actual_name !!} </td>
                                <td class=""> {!! $calendarEventUpdate->past_name !!} </td>
                                <td class=""> {!! $calendarEventUpdate->name !!} </td>
                                <td class=""> {!! $calendarEventUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $calendarEventUpdate->datetime !!} </td>
                  
                              </tr>
      
                            @endforeach
  
                          </tbody>
                
                        </table>
                        
                      </div>

                    </div>

                  </div>

                </div>
            
              </div>

            </div>

          </div>

        </div>

      </div>
              
    </div>
            
  </div>

</section>