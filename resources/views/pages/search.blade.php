@extends('layouts.app')

@section('title','搜索页')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection

@section('content')
        <div class="container">

        <div class="container">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>


        <hr>
        <div>


        @foreach($topics as $topic)

            <h3>{{ substr($topic->title,0,8) }}</h3>

            <p>{{ substr($topic->body,0,30) }}...</p>

             <p>
                 <a class="btn btn-default" href="{{ route('topics.show',[$topic]) }}" role="button">View details »</a>
             </p>


        @endforeach

        {!! $topics->links() !!}
        </div>
        </div>

@endsection


