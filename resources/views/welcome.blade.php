<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
        <div class="container-fluid mx-3 my-3">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm my-3">
                        <div class="card-header">
                            Computer Science MCQs
                        </div>
                        <div class="card-body">
                            @foreach($questions as $question)
                            <h5 class="my-4">Q{{ $question['id'] }}. {{ $question['question'] }}</h5>
                            <!-- <h5 class="card-title">Q{{ $question['id'] }}. {{ $question['question'] }}</h5> -->

                            <!-- Dynamic Options -->
                            <form id="mcqForm_{{ $question['id'] }}">
                                @foreach($question['options'] as $opt)
                                <div class="form-check mb-2 mcq-option">
                                    <input class="form-check-input" type="radio" 
                                        name="answer_{{ $question['id'] }}" 
                                        value="{{ $opt['id'] }}" id="opt_{{ $question['id'] }}_{{ $opt['id'] }}">
                                    <label class="form-check-label" for="opt_{{ $question['id'] }}_{{ $opt['id'] }}">
                                        {{ $opt['option'] }}
                                    </label>
                                </div>
                                @endforeach
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

