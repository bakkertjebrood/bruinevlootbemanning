@if(Auth::user())
<div class="modal fade" id="ad_respond" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="" action="{{route('respond')}}" method="post">
        {{csrf_field()}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Reageer op {{$ad->name}}</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="body">Uw bericht</label>
          <textarea rows="7" class="form-control" id="body" name="body" placeholder="Schrijf hier uw bericht" required="required"></textarea>
          <input type="hidden" name="ad_id" value="{{$ad->id}}">
          <input type="hidden" name="user_id" value="{{isset(Auth::user()->id)}}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
        <button type="submit" class="btn btn-primary">Versturen</button>
      </div>
    </form>
    </div>
  </div>
</div>
@else
<div class="modal fade" id="ad_respond" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">U dient in te loggen om te kunnen reageren</h4>
      </div>
      <div class="modal-body">

        @include('inc.login')

      </div>

    </div>
  </div>
</div>
@endif
