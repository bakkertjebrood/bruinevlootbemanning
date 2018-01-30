
<div class="modal fade" id="ad_respond{{$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="" action="{{route('respondfront')}}" method="post">
        {{csrf_field()}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">@lang('labels.respondto') {{$ad->name}}</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="body">@lang('labels.yourmessage')</label>
          <textarea rows="7" class="form-control" name="body" placeholder="@lang('labels.writeyourmessage')" required="required"></textarea>
          <input type="hidden" name="ad_id" value="{{$ad->id}}">
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
