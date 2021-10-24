@extends('layouts.header')
@section('title', '編集')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-dark">
                    <div class="card-header">{{ __('Drill Updater') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('lessons.update', $lesson->id) }}" class="px-5 py-2 overflow-hidden">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="p-form__label">単元名</label>

                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $lesson->title }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="date" class="p-form__label">日付</label>

                                    <input id="date" type="date" class="form-control @error('category_name') is-invalid @enderror" name="date" value="{{ $lesson->date }}" autocomplete="date" autofocus>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="period" class="p-form__label">時限</label>
                                <select class="form-control @error('period') is-invalid @enderror" id="period" name="period" autocomplete="period" autofocus>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option @if($lesson->period == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>

                                @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="goal" class="p-form__label">本時の目標</label>
                                <input type="text" class="form-control mb-1 @error('goal') is-invalid @enderror" id="goal" name="goal" value="{{ $lesson->goal }}" autocomplete="goal" autofocus>

                                @error('goal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                                    <button type="submit" class="c-btn p-form__btn float-right">
                                        更新
                                    </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
