@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<div  id="app" class="container">
  <div class="col-lg-3">
    <div class="search">

      @include('inc.newads')

      <div class="list-group profile-menu">
        <label for="search">@lang('labels.showallads')</label>
        @if($ad_type == 1)
        <a href="{{route('jobrequests')}}" class="list-group-item ">
          <span class="glyphicon glyphicon-bullhorn"></span>
          @lang('labels.requestsc')</a>
          <a href="{{route('jobopenings')}}" class="list-group-item active">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @lang('labels.openingsc')</a>
            @elseif($ad_type == 2)
            <a href="{{route('jobrequests')}}" class="list-group-item active">
              <span class="glyphicon glyphicon-bullhorn"></span>
              @lang('labels.requestsc')</a>
              <a href="{{route('jobopenings')}}" class="list-group-item ">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @lang('labels.openingsc')</a>
                @endif
              </div>

              <!-- Start / end -->
              <div class="daterange">
                @if($ad_type == 1)
                <label for="daterange">@lang('labels.period')</a></label>
                @elseif($ad_type == 2)
                <label for="daterange">@lang('labels.availablebetween')</a></label>
                @endif

                <div class="input-group input-daterange clearfix" id="daterange">
                  <datepicker bootstrap-styling readonly="" placeholder="01 jan 2018" language="nl" data-date-format='dd-mm-yyyy' v-model="startdate"></datepicker>
                  <!-- <input type="text" data-date-format='dd-mm-yyyy' class="form-control " id="startdate" v-model="startdate" value="" placeholder="20-5-2018"> -->
                  <div class="input-group-addon">@lang('labels.until')</div>
                  <datepicker bootstrap-styling placeholder="01 jan 2019" language="nl" data-date-format='dd-mm-yyyy' v-model="enddate"></datepicker>
                  <!-- <input type="text" data-date-format='dd-mm-yyyy' class="form-control" id="enddate" v-model="enddate" value="" placeholder="20-5-2019"> -->
                  <span class="input-group-btn">
                    <button class="btn btn-primary" @click="addDates()" type="button"><span class="glyphicon glyphicon-search"></span></button>
                  </span>
                </div><br>
              </div>

              <!-- Search categories -->
              <div class="categories">
                <label for="categories">@lang('labels.searchcategory')</label>
                <div class="list-group checked-list-box" id="categories">
                  <a v-for="category in categories" @click="addCategory(categories,category)" :class="['list-group-item',{active:category.isActive}]">
                    @{{category.name}}
                    <!-- <span class="badge">1</span> -->
                  </a>
                </div>
              </div>

              <!-- Search skills -->
              <div class="">
                <label for="categories">@lang('labels.searchskills')</label>
                <div class="list-group checked-list-box">
                  <a v-for="skill in skills" @click="addSkill(skills,skill)" :class="['list-group-item',{active:skill.isActive}]" >@{{skill.name}}</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Main ads grid -->
          <div class="col-lg-9">


            <div class="">
              <h2>
                @if($ad_type == 1)
                @lang('labels.openingsc')
                @else
                @lang('labels.requestsc')
                @endif
                <small> @lang('labels.fulllist')</small></h2><hr>
              </div>
              @include('flash::message')

              <div v-if="jobs.length == 0" class="well">
                <i class="">@lang('labels.nodata')</i>
              </div>
              <div>
                <transition-group name="list" tag="p">
                  <div :key="job.id" v-for="job in jobs" class="panel panel-default list-item">
                    <div class="panel-heading">
                      <h3 class="panel-title">@{{job.name}}</h3>
                    </div>
                    <div class="panel-body">
                      <div class="media">
                        <div class="media-left">
                          <a :href="'/job/'+job.id">
                            <img class="media-object ads-image-m" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
                          </a>
                        </div>
                        <div class="media-body">
                          <div class="col-sm-6 col-md-4 col-lg-12 hidden-xs">
                            <p>@{{job.description | truncate(300) }}</p>
                          </div>

                          <div class="col-sm-3 col-md-6 col-lg-12 hidden-xs">
                            <strong>@lang('labels.period'): </strong><span>@{{job.startdate | moment("D-M-Y")}} tot @{{job.enddate | moment("D-M-Y")}} </span><br>
                            <strong>@lang('labels.placedon'): </strong><span>@{{job.created_at | moment("D-M-Y")}} </span><br>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer clearfix">
                      <span class="pull-right ">
                        <a type="button" class="btn btn-m btn-default" :href="'/job/'+job.id" name="button">@lang('labels.show')</a>
                        @if(Auth::user())
                        <a type="button" class="btn btn-m btn-primary" data-toggle="modal" :data-target="'#ad_respond'+job.id" name="respond">@lang('labels.respond')</a>
                        @else
                        <a type="button" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#login_modal" class="">@lang('labels.respond')</a>
                        @endif
                      </span>
                    </div>
                    @if(Auth::user())
                    <div class="modal fade" :id="'ad_respond'+job.id" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form class="" action="{{route('respond')}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="">@lang('labels.respondto') @{{job.name}}</h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group">
                                <label for="body">@lang('labels.yourmessage')</label>
                                <textarea rows="7" class="form-control" id="body" name="body" placeholder="Schrijf hier uw bericht" required="required"></textarea>
                                <input type="hidden" name="ad_id" :value="job.id">
                                <input type="hidden" name="user_id" value="{{isset(Auth::user()->id)}}">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('labels.close')</button>
                              <button type="submit" class="btn btn-primary">@lang('labels.send')</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                </transition-group>
              </div>

              <div class="pagination">

              </div>
            </div>
          </div>
          @stop

          @section('scripts')
          <script type="text/javascript">

          </script>
          @stop
