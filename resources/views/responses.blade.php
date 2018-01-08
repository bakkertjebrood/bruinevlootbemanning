@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<div id="responses" class="container">

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">Berichten</li>
  </ol>

  @include('flash::message')

  <!-- Main ads grid -->
  <div class="col-lg-3">
    <div class="list-group">
      <a v-for="conversation in conversations" @click="getResponses(conversation.ad_id,conversation.user_id,conversation.conversation_id),activeClass(conversations,conversation)" href="#" :class="['conversation-item list-group-item',{active:conversation.isActive}]">
        <h5 class="list-group-item-heading">@{{conversation.ad_name}}</h5>
        <small class="list-group-item-text">
          <strong>@{{conversation.firstname}}</strong>
        </small>
      </a>
    </div>
  </div>
  <div class="col-lg-6">
    <!-- Chat -->

    <div v-if="responses.length == 0" class="well">
      <i>Geen berichten</i>
    </div>

    <div v-if="responses.length > 0" class="panel panel-default">
      <div class="panel-heading">
        <a v-if="conversation_id" @click="deleteResponse()" class="pull-right btn" href="#"><span class="glyphicon glyphicon-trash"></span></a>
        <h4>Gesprek</h4>
        <div id="chatscroll" v-chat-scroll class="panel-body chatscroll">

          <ul class="chat">
            <transition-group name="fade">

              <li :key="response.id" v-for="response in responses">

                <div v-if="{{Auth::user()->id}} != response.user_id" class="chat-body clearfix left">
                  <div class="clearfix">
                    <small class="pull-right text-muted">
                      <span class="glyphicon glyphicon-time"></span>
                      @{{ response.created_at | moment("from", "now", true) }}
                    </small>
                    <strong class="primary-font pull-left">@{{response.firstname}}</strong>

                    <div class="well body">
                      <small>@{{response.body}}</small>
                    </div>
                  </div>
                </div>

                <div v-else class="chat-body clearfix right">
                  <div class="clearfix">
                    <small class="pull-left text-muted">
                      <span class="glyphicon glyphicon-time"></span>
                      @{{ response.created_at | moment("from", "now", true) }}
                    </small>
                    <strong class="primary-font pull-right">@{{response.firstname}}</strong>

                    <div class="well body">
                      <small>@{{response.body}}</small>
                    </div>
                  </div>
                </div>

              </li>

            </transition-group>
          </ul>

        </div>
        <div class="panel-footer clearfix">
          <div class="form-group">
            <textarea rows="7" id="btn-input" type="text"  v-model="body" class="form-control input-sm" placeholder="Schrijf uw bericht hier..." />
          </textarea>
        </div>
        <button  class="btn btn-primary btn-sm  pull-right" @click="addResponse()" id="btn-chat">Versturen</button>

      </div>
    </div>

  </div>
  <!-- End chat -->
</div>
<div class="col-lg-3">
  @include('inc.usermenu')
</div>

</div>


@stop

@section('scripts')
<script type="text/javascript">


var responses = new Vue({
  el: '#responses',
  data:{
    responses: [],
    body: '',
    ad_id: '',
    ad_name: '',
    user_id: '',
    conversation_id: '',
    conversations: [],
    isActive: false,
    current_user_id: '{{Auth::user()->id}}'
  },
  mounted(){
    this.$moment.locale('nl')
    // get initial responses
    axios.get('{{route("get_conversations")}}', {
    }).then(response => {
      this.conversations = response.data;
    });
  },
  methods:{
    getResponses(ad_id,user_id,conversation_id){
      axios.post('{{route("get_responses")}}', {
        conversation_id: conversation_id
      }).then(response => {
        this.responses = response.data;
        this.ad_name = response.ad_name;
      });
      this.ad_id = ad_id;
      this.user_id = user_id;
      this.conversation_id = conversation_id;
    },
    getConversations(){
      axios.get('{{route("get_conversations")}}', {
      }).then(response => {
        this.conversations = response.data;
      });
    },
    activeClass(conversations,conversation){
      conversations.forEach(function(c, index){
        c.isActive = false;
      });

      conversation.isActive = !conversation.isActive;
    },
    addResponse(){
      axios.post('{{route("store_response")}}', {
        ad_id:this.ad_id,
        user_id:{{Auth::user()->id}},
        body:this.body,
        conversation_id: this.conversation_id
      }).then(response => {
        this.getResponses(this.ad_id,this.user_id,this.conversation_id);
        this.body = '';
      });
    },
    deleteResponse(){
      axios.delete('{{route("delete_response")}}', {
        params:{
          conversation_id: this.conversation_id,
          user_id: this.user_id
        }
      }).then(response => {
        this.getResponses(this.ad_id,this.user_id,this.conversation_id);
        this.getConversations();
        this.getResponses();
      });
    },

    classSide(id){
      if(id == this.current_user_id){
        return 'pull-left';
      }else{
        return 'pull-right';
      }
    }

  }

});
</script>
@stop
