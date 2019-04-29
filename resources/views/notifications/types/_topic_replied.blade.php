<li class="media @if ( ! $loop->last) border-bottom @endif">
    <div class="well">
       <strong>{{ $notification->data['from'] }}<strong> 私信了你
               <p>{{ $notification->data['message'] }}</p>
        <i class="far fa-clock"></i>
        {{ $notification->created_at->diffForHumans() }}


    </div>
</li>