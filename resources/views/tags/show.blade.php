@extends('layouts.app')

@section('title','tags')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 topic-list">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active"><a href="#">{{ $tag->title }}</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    {{-- 话题列表 --}}
                    @include('topics._topic_list', ['topics' => $topics])
                    {{-- 分页 --}}
                    {!! $topics->links() !!}
                </div>
            </div>
        </div>


    </div>
@endsection