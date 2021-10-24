@extends('layouts.header')
@section('title', 'マイページ')

@section('content')
        <div class="w-75 mx-auto mt-3">
            <span class="h3">{{ Auth::user()->name }}　のマイページ</span>
        </div>
        <div class="l-main__container pt-50" style="padding-top: 80px;">
            <div class="container">   
                <div class="row">

                    <div class="col-sm-3 mb-4" style="height: 190px;">
                        <a href="" data-toggle="modal" data-target="#store" data-backdrop="true">
                            <div class="card bg-light h-100">
                                <div class="card-body u-card_center">
                                    <h3 class="card-title py-4 h3 text-dark">新しい授業を作成</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    @foreach($lessons as $lesson)

                    <div class="col-sm-3 mb-4">
                        <a href="{{ route('lessons.index', $lesson->id) }}">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <p class="card-text h4">{{ date('Y/m/d', strtotime($lesson->date)) }}　{{ $lesson->period }}限</p>
                                    <h3 class="card-title py-4 text-center" style="font-size: 25px">{{ $lesson->title }}</h3>
                                    <form method="POST" action="{{ route('lessons.destroy',$lesson->id ) }}" class="d-inline float-right">
                                        @method('DELETE')
                                        @csrf
                                        <button class="u-delete-btn" onclick='return confirm("削除しますか？");'>
                                            <i class="fas fa-trash-alt fav text-danger"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('lessons.edit',$lesson->id) }}" class="fas fa-edit fav"></a>
                                    <!-- <button class="u-delete-btn float-right">
                                        <i class="fas fa-edit fav text-white"></i>
                                    </button> -->
                                </div>
                            </div>
                        </a>
                    </div>

                    @endforeach
                    
                </div>
            </div>
        </div>

        <!-- 新規作成モーダルフォーフォーム -->
        <div id="store" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('lessons.store') }}" id="lessonNew" class="p-form modal-content">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="p-form__label">単元名</label>
                        <input type="text" class="form-control mb-1 @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date" class="p-form__label">日付</label>
                        <input type="date" class="form-control mb-1 @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" autocomplete="date" autofocus>

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="period" class="p-form__label">時限</label>
                        <select class="form-control mb-1 @error('period') is-invalid @enderror" id="period" name="period" value="{{ old('period') }}" autocomplete="period" autofocus>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                        </select>

                        @error('period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="goal" class="p-form__label">本時の目標</label>
                        <input type="text" class="form-control mb-1 @error('goal') is-invalid @enderror" id="goal" name="goal" value="{{ old('goal') }}" autocomplete="goal" autofocus>

                        @error('goal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button id="button" class="c-btn p-form__btn">作成</button>
                </form>
            </div>
        </div>
@endsection
