@extends('layouts.app')

@section('title', $topic->title)

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        作者：{{ $topic->user->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('users.show', $topic->user->id) }}">
                                <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                            </a>
                        </div>

                        {{--modal start--}}
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                发送私信
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">发送私信</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">信息:</label>
                                                    <textarea class="form-control" placeholder="请输入至少两个字符" id="message-text" ></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                            <button type="button" class="btn btn-primary" id="sendButton">发送</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--modal end--}}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $topic->title }}
                    </h1>

                    <div class="article-meta text-center">
                        @foreach($topic->tags as $tag)
                            <span class="label label-info text-center"><a href="{{ route('tags.show',[$tag->id]) }}">{{ $tag->title }}</a></span>
                        @endforeach
                    </div>

                    <div class="article-meta text-center">
                        {{ $topic->created_at->diffForHumans() }}
                        &nbsp;&nbsp;
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        {{ $topic->reply_count }}

                    </div>

                    <div class="topic-body" id="markdownbody">
                        {!! $topic->body !!}
                    </div>



                </div>

                @if(Auth::check())
                    <div class="panel-footer">
                        <Favorite :post={{ $topic->id }} :favorited={{ $topic->favorited() ? 'true' : 'false' }}
                        ></Favorite>
                        {{--<example></example>--}}

                    </div>

                @endif
            </div>

            {{-- 用户回复列表 --}}
            @if(count($topic->replies))
            <div class="panel panel-default topic-reply">

                <div class="panel-body">
                    @includeWhen(Auth::check(),'topics._reply_box', ['topic' => $topic])
                    @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->recent()->get()])
                </div>

            </div>
            @endif
        </div>


    </div>
@endsection

@section('script')
    <script>


        $('#sendButton').click(function () {
            var content=$("#message-text").val();
            console.log(content);
            console.log(JSON.stringify({{ $topic->user->id }}))
           axios.post('/messages',{
               message: content,
               toUser: {{ $topic->user->id }}
           }).then((response)=>console.log(response))
               .catch((error)=>console.log(error))
        });

    </script>
@endsection

