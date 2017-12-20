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
        <h4>Bericht</h4>
        <hr>
        <div class="panel-body">
          <ul class="chat">
            <li v-for="response in responses" class="clearfix left"><span class="chat-img pull-left">
              <img :src="'{{url("uploads/photo")}}/'+response.photo" alt="User Avatar" class="img-circle img-md" />
            </span>
            <div class="chat-body clearfix">
              <div class="header">
                <strong class="primary-font">@{{response.firstname}}</strong> <small class="pull-right text-muted">
                  <span class="glyphicon glyphicon-time"></span>@{{response.created_at}}</small>
                </div>
                <p>
                  @{{response.body}}
                </p>
              </div>
            </li>

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
    user_id: '',
    conversation_id: '',
    conversations: [],
    isActive: false
  },
  mounted(){
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
          conversation_id: this.conversation_id
        }
      }).then(response => {
        this.getResponses(this.ad_id,this.user_id,this.conversation_id);
        this.getConversations();
      });
    },
  }

});
</script>
@stop
