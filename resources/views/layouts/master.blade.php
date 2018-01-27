<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Styles -->
  <script src='https://cdn.polyfill.io/v2/polyfill.min.js'></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="/css/bootstrap-datepicker3.standalone.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


</head>
<body>

  @yield('header')
  @yield('content')

  <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" ref="form" v-on:submit="loginCheck" method="POST" action="{{ route('login') }}">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Inloggen</h4>
          </div>
          <div class="modal-body">

            {{ csrf_field() }}

            <div class="col-md-6 col-md-offset-3">
              <br>
              <a href="{{ url('/auth/facebook') }}"> <img src="{{url('/images','facebook_login.png')}}" alt=""> </a>
            </div>

            <div class="col-md-12">
              <hr>
            </div>




            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-mail adres</label>

              <div class="col-md-6">
                <input id="email" v-model="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                <span class="help-block">
                  <strong v-html="notverified" class="text-danger"></strong>
                </span>
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Wachtwoord</label>

              <div class="col-md-6">
                <input id="password" v-model="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mij onthouden
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">

            <a class="btn btn-link" href="{{ route('password.request') }}">
              Wachtwoord vergeten
            </a> |
            <a class="btn btn-link" href="{{ route('register') }}">
              Inschrijven
            </a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
            <button type="submit" :class="['btn btn-primary',{disabled:this.loginDisabled}]">Inloggen</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer id="myFooter">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <h5>Van start</h5>
          <ul>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('register')}}">Inschrijven</a></li>
            <li><a href="{{route('login')}}">Inloggen</a></li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h5>Over ons</h5>
          <ul>
            <li><a href="{{route('about')}}">Het initiatief</a></li>
            <li><a href="{{route('contact')}}">Neem contact op</a></li>
            <li><a href="{{route('creator')}}">Wie is de maker</a></li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h5>Ondersteuning</h5>
          <ul>
            <li><a href="{{route('faq')}}">Veelgestelde vragen</a></li>
            <li><a href="{{route('contact')}}">Probleem melden</a></li>
            <li><a href="{{route('suggestions')}}">Uw suggestie indienen</a></li>
          </ul>
        </div>
        <div class="col-sm-3 info">
          <h5>Informatie</h5>
          <p> Deze website is een gratis initiatief en brengt scheepseigenaren, bemanning, horeca personeel, klussers en andere enthousiaste mensen met elkaar in contact. </p>
        </div>
      </div>
    </div>
    <div class="second-bar">
      <div class="container">
        <h2 class="logo-footer"><a href="#"> <strong>Bruine</strong>Vloot<small> bemanning</small><small>.nl</small></a></h2>
        <div class="social-icons">
          <a href="https://twitter.com/Bruine_Vloot" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
          <a href="https://www.facebook.com/bruine.vlootbemanning.5" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bootstrap-confirmation.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.nl.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="{{ asset('js/places.js') }}" charset="utf-8"></script>
  <script type="text/javascript" src="{{ asset('js/custom.js') }}" charset="utf-8"></script>

  <!-- <script>
  window.fbAsyncInit = function() {
  FB.init({
  appId      : '{your-app-id}',
  cookie     : true,
  xfbml      : true,
  version    : '{latest-api-version}'
});

FB.AppEvents.logPageView();

};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script> -->

@yield('scripts')

<script type="text/javascript">

new Vue({
  el: '#login_modal',
  data:{
    email:'',
    password:'',
    loginDisabled:false,
    notverified:''
  },
  methods:{
    loginCheck(event){
      event.preventDefault();
      _this = this;
      var _this = this;
      axios.post('{{route("logincheck")}}',{
        email: this.email,
        password: this.password
      }).then(response => {
        if(response.data == false){
          _this.notverified = 'Uw account is niet geactiveerd. <a href="{{route("verifysend")}}">Klik hier om uw activatie e-mail nogmaals te versturen.</a>';
        }else{
          _this.$refs.form.submit()
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  }

})

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112379687-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-112379687-1');
</script>
</body>
</html>
