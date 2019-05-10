<li class="{{ Request::is('') ? 'active' : '' }}">
  <a href="{!! route('homes.index') !!}"><i class="glyphicon glyphicon-option-vertical"></i><span>Profile</span></a>
</li>

<li class="{{ Request::is('') ? 'active' : '' }}">
  <a href="{!! route('publicProfile.index') !!}"><i class="glyphicon glyphicon-globe"></i><span>Public Profile</span></a>
</li>

<li class="{{ Request::is('') ? 'active' : '' }}">
  <a href="{!! route('sharedProfile.index')!!}"><i class="glyphicon glyphicon-share-alt"></i><span>Shared Profile</span></a>
</li>

<li class="{{ Request::is('') ? 'active' : '' }}">
  <a href="{!! route('sharedFiles.index') !!}"><i class="glyphicon glyphicon-share"></i><span>Shared Files</span></a>
</li>

<li class="{{ Request::is('colleges*') ? 'active' : '' }}">
  <a href="{!! route('colleges.index') !!}"><i class="glyphicon glyphicon-education"></i><span>Colleges</span></a>
</li>

<li class="{{ Request::is('jobs*') ? 'active' : '' }}">
  <a href="{!! route('jobs.index') !!}"><i class="glyphicon glyphicon-briefcase"></i><span>Jobs</span></a>
</li>

<li class="{{ Request::is('projects*') ? 'active' : '' }}">
  <a href="{!! route('projects.index') !!}"><i class="glyphicon glyphicon-folder-open"></i><span>Projects</span></a>
</li>

<li class="{{ Request::is('personalDatas*') ? 'active' : '' }}">
  <a href="{!! route('personalDatas.index') !!}"><i class="glyphicon glyphicon-user"></i><span>Personal Datas</span></a>
</li>