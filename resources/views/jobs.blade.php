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
  <div class="col-lg-3 col-md-3">

    @include('inc.newads')
    <div class="panel panel-default visible-xs visible-sm">

      <a class="accordion-toggle clean" data-toggle="collapse" data-parent="#accordion" href="#search">
        <div class="panel-heading">
          <div class="searchtitle">
            <span class="fa fa-search"> </span> <strong class="h4">Zoeken</strong>
            <span class="fa fa-angle-down"></span>
          </div>

        </div>
      </a>



      <div id="search" class="panel-collapse collapse">

        <div class="searchfooter visible-xs visible-sm">
          <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#search"><strong class="h4" >Zoeken</strong> <span class="fa fa-arrow-right"></span></a>
        </div>

        <div class="panel-body">
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
                      <datepicker bootstrap-styling readonly="" input-styling="fullwidth" placeholder="01 jan 2018" language="nl" data-date-format='dd-mm-yyyy' v-model="startdate"></datepicker>
                      <div class="input-group-addon">@lang('labels.until')</div>
                      <datepicker bootstrap-styling placeholder="01 jan 2019" language="nl" data-date-format='dd-mm-yyyy' v-model="enddate"></datepicker>
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
            </div>

<!-- Non mobile -->
<div class="hidden-xs hidden-sm">
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
                <div class="input-group-addon">@lang('labels.until')</div>
                <datepicker bootstrap-styling placeholder="01 jan 2019" language="nl" data-date-format='dd-mm-yyyy' v-model="enddate"></datepicker>
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
          <div class="col-lg-9 col-md-9">


            <div class="">
              <h2>
                @if($ad_type == 1)
                @lang('labels.openingsc')
                @else
                @lang('labels.requestsc')
                @endif
                <small class="hidden-xs"> @lang('labels.fulllist')</small></h2><hr>
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
                        <div class="media-left hidden-xs">
                          <a class="" :href="'/job/'+job.id">
                            <img class="media-object ads-image-m" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
                          </a>
                        </div>

                        <div class="media-body">
                          <div class="visible-xs">
                            <a class="" :href="'/job/'+job.id">
                              <img class="img img-responsive" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
                            </a>
                          </div>
                          <div class="col-sm-12 col-md-12 col-lg-12 hidden-xs">
                            <p>@{{job.description | truncate(300) }}</p>
                          </div>

                          <div class="col-md-6 col-lg-12 hidden-xs hidden-sm">
                            <strong>@lang('labels.period'): </strong><span>@{{job.startdate | moment("D-M-Y")}} tot @{{job.enddate | moment("D-M-Y")}} </span><br>
                            <strong>@lang('labels.placedon'): </strong><span>@{{job.created_at | moment("D-M-Y")}} </span><br>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer clearfix">
                      <span class="pull-right ">
                        <a type="button" class="btn btn-m btn-default" :href="'/job/'+job.id" name="button">@lang('labels.show')</a>
                      </span>
                    </div>
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
