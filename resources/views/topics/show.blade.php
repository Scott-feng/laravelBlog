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


