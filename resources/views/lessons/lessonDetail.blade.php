@extends('layouts.header')
@section('title', '詳細')

@section('content')
<div class="w-75 mx-auto my-2">
    <span class="h3">{{ date('Y年 m月 d日', strtotime($lesson->date)) }}　{{ $lesson->period }}限　　　　{{ $lesson->title }}</span>
</div>
<div class="p-target">
            <h2 class="p-target__title">{{ $lesson->goal }}</h2>
</div>
<div class="l-main__container pt-0">
    <div class="container">

        <lesson-board :initial-data="{{ $tasks }}"></lesson-board>

    </div>
</div>

@endsection
