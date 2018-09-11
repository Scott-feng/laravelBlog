    @if (count($links))
        <div class="panel panel-default">
            <div class="panel-body active-users">

                <div class="text-center">友情链接</div>
                <hr>
                @foreach ($links as $link)
                    <a class="media" href="{{ $link->link }}">
                        <div class="media-body">
                            <span class="media-heading">{{ $link->title }}</span>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    @endif