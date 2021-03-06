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
            <h4 class="modal-title" id="">@lang('labels.login')</h4>
          </div>
          <div class="modal-body">

            {{ csrf_field() }}
<div class="social-wrap">
@include('inc.social')
</div>





            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">@lang('labels.email')</label>

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
              <label for="password" class="col-md-4 control-label">@lang('labels.password')</label>

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
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('labels.rememberme')
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">

            <a class="btn btn-link" href="{{ route('password.request') }}">
              @lang('labels.forgotpassword')
            </a> |
            <a class="btn btn-link" href="{{ route('register') }}">
              @lang('labels.register')
            </a>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('labels.close')</button>
            <button type="submit" :class="['btn btn-primary',{disabled:this.loginDisabled}]">@lang('labels.login')</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer id="myFooter">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <h5>@lang('labels.tobeginwith')</h5>
          <ul>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('register')}}">@lang('labels.register')</a></li>
            <li><a href="{{route('login')}}">@lang('labels.login')</a></li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h5>Over ons</h5>
          <ul>
            <li><a href="{{route('about')}}">@lang('labels.theinitiative')</a></li>
            <li><a href="{{route('contact')}}">@lang('labels.contactme')</a></li>
            <li><a href="{{route('creator')}}">@lang('labels.creator')</a></li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h5>Ondersteuning</h5>
          <ul>
            <li><a href="{{route('faq')}}">@lang('labels.faq')</a></li>
            <li><a href="{{route('contact')}}">@lang('labels.reportaproblem')</a></li>
            <li><a href="{{route('suggestions')}}">@lang('labels.dosuggestion')</a></li>
          </ul>
        </div>
        <div class="col-sm-3 info">
          <h5>@lang('labels.information')</h5>
          <p>@lang('labels.informationtext')</p>
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
  <script src="https://use.fontawesome.com/87b5bc91b1.js"></script>
  <script src="{{ asset('js/bootstrap-confirmation.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.nl.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="{{ asset('js/places.js') }}" charset="utf-8"></script>
  <script type="text/javascript" src="{{ asset('js/custom.js') }}" charset="utf-8"></script>

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
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112379687-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-112379687-1');
</script> -->
</body>
</html>
