<div class="message-wrapper" id="admin">
  <ul class="messages" >
      @foreach($messages as $message)
          <li class="message clearfix">
              {{--if message from id is equal to auth id then it is sent by logged in user --}}
              <div class="{{ ($message->send == Auth::id()) ? 'sent' : 'received' }}">
                  <p>{{ $message->message }}</p>
                  <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
              </div>
          </li>
   <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">       
  <input type="hidden" name="item_id" value="{{$message->item_id}}">
  <input type="hidden" name="receive" value="{{$message->receive}}">
      @endforeach
  </ul>
</div>

<div class="input-text mb-3">
  <input type="text" name="message" class="submit">
</div>