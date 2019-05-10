@extends('layouts.app')

@section('content')

  <section class="content-header">
        
    <h1 class="pull-left"> Search Results </h1>
    
  </section>
    
  <div class="content" style = "margin-top: 20px">
    
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    
    <div class="box box-primary">
            
      <div class="box-body">

        <div class="row">
 
          <div class="col-md-12">

            <div class="table-responsive">

              <table id="example1" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  
                <thead>
                                
                  <tr>
                                   
                    <th>Name</th>
                                
                  </tr>
                            
                </thead>
                            
                <tbody id = "t_topic_search">
                      
                  {!! $output !!}
                      
                </tbody>
          
              </table>
            
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection