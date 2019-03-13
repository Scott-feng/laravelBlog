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

                <br>
                <br>
                <div class="text-center">文章标签</div>
                <hr>
                @foreach (\App\Models\Tag::all() as $tag)
                    <a class="media" href="{{ route('tags.show',[$tag]) }}">
                        <div class="media-body">
                            <span class="label label-primary"> {{ $tag->title }} </span>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    @endif