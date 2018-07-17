@extends('layouts.master')

@section('content')
   
    

<section class="content">

<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ $profileUser->avatar_path }}" alt="User profile picture">

        <h3 class="profile-username text-center">{{ $profileUser->name}}</h3>

        <!-- <p class="text-muted text-center">Software Engineer</p> -->

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
        <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
        <!-- <li><a href="#original" data-toggle="tab">Original</a></li> -->
        <li><a href="#about" data-toggle="tab">About</a></li>
      @can('update', $profileUser)
        <li><a href="#settings" data-toggle="tab">Settings</a></li>
      @endcan
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
          <!-- Post -->
        <ul class="timeline timeline-inverse">
        @forelse($activities as $date => $activity)
            <li class="time-label">
                <span class="bg-red">
                {{ $date }}
                </span>
            </li>
                @foreach($activity as $record)
                    @if(view()->exists("profiles.activities.{$record->type}"))
                        @include("profiles.activities.{$record->type}", ['activity' => $record]);
                    @endif
                @endforeach
            @empty
                <p>There is no activity for this user yet</p>  
        @endforelse
          <!-- /.post -->
        </ul>
        </div>


        <!-- original -->
        <div class="tab-pane" id="original">
        <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>
                @forelse($activities as $date => $activity)
                <h3 class="page-header">
                    {{ $date }}
                </h3>
                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record]);
                        @endif
                    @endforeach
                @empty
                    <p>There is no activity for this user yet</p>  
                @endforelse
              
            </div>
        </div>
        
    </div>
        </div>
        <!-- .original -->
      @can('update', $profileUser)
        <div class="tab-pane" id="settings">
            <div class="container">
                <avatar-form :user="{{ $profileUser }}"></avatar-form>
            </div>
        </div>
      @endcan
      <div class="tab-pane" id="about">
            <!-- About Me Box -->
            <about :user="{{ $profileUser }} " ></about>
    
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
      </div>

      
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>
@endsection
