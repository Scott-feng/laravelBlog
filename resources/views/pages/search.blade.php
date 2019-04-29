@extends('layouts.app')

@section('title','搜索页')

@section('css')

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <style>
        .search .title em{
            color: #ff2222;
        }

        .search .content em {
            color: #FF1717;
            font-size: 16px;
        }
    </style>

@endsection

@section('content')


        <div class="container col-lg-8 col-lg-offset-2">
            <h2>搜索结果：共 {{ $topics->count() }} 条</h2>

        @foreach($topics as $topic)
        <div class="panel panel-info search">
            <div class="title">
                @if(isset($topic->highlights['title']))
                    <h3>{!! $topic->highlights['title'][0] !!}</h3>
                @else
                    <h3>{{ $topic->title }}</h3>
                @endif
            </div>


            <div class="content">

                @if(isset($topic->highlights['body']))
                    <p>{!! Markdown::driver('github')->html($topic->highlights['body'][0]) !!}</p>
                @else
                    <p>{{ substr( Markdown::driver('github')->html($topic->body),0,150) }} ......</p>
                @endif
            </div>


             <p>
                 <a class="btn btn-default" href="{{ route('topics.show',[$topic]) }}" role="button">View details »</a>
             </p>

        </div>


        @endforeach

        {{ $topics->appends(Request::except('page'))->links() }}
        </div>


@endsection


