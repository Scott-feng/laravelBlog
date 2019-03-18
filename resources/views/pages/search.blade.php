@extends('layouts.app')

@section('title','搜索页')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection

@section('content')


        <div class="container col-lg-8 col-lg-offset-2">


        @foreach($topics as $topic)
        <div class="panel panel-info">



            <h3>{{ substr($topic->title,0,8) }} ......</h3>

            <p>{{ substr($topic->body,0,30) }} ......</p>

             <p>
                 <a class="btn btn-default" href="{{ route('topics.show',[$topic]) }}" role="button">View details »</a>
             </p>

        </div>


        @endforeach

        {!! $topics->links() !!}
        </div>


@endsection


