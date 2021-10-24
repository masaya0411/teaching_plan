@extends('layouts.header')
@section('title', 'TOP')
@section('content')
    <div class="l-main__container p-top u-padding">
        <div class="p-top__wrap">
            <h2 class="p-top__title">Teaching</h2><br><h2 class="p-top__title">Plan</h2>
            <p class="p-top__parag">毎日忙しい先生のための<br>授業計画作成サービス</p>
            <button class="c-btn"><a href="{{ route('register') }}">無料で始める</a></button>
        </div>
        <div class="p-top__img-wrap">
            <img class="p-top__img" src="{{ asset('images/9435_color.png') }}" alt="メイン画像">
        </div>
        <button class="c-btn u-sp-btn"><a href="{{ route('register') }}">無料で始める</a></button>
    </div>
@endsection
