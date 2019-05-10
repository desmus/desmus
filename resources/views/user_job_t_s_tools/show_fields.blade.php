<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#share_list" data-toggle="tab"> Actual Shares </a></li>
          <li><a href="{!! route('userJobTSTools.create', [$id]) !!}"> Add User </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "share_list">

            @include('user_job_t_s_tools.filtered_table')

          </div>

        </div>

      </div>
              
    </div>
            
  </div>

</section>