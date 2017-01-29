@extends('layouts.app')

<!--{{ $page = 'help' }}-->

@section('content')
    <div class="container">
        <div class="content">
            <h1 class="display-4">Help</h1>
            <hr>

            <div id="faq" role="tablist" aria-multiselectable="true">

                {{-- Question 1 --}}
                <div class="card">
                    <div class="card-header" role="tab" id="question-1">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#faq" href="#answer-1" aria-expanded="true" aria-controls="answer-1">
                                How i can start using this service?
                            </a>
                        </h5>
                    </div>

                    <div id="answer-1" class="collapse" role="tabpanel" aria-labelledby="question-1">
                        <div class="card-block">
                            You can start use our service by <a href="{{ url('/register') }}">create your account</a> and create your first balance for track your money.
                        </div>
                    </div>
                </div>

                {{-- Question 2 --}}
                <div class="card">
                    <div class="card-header" role="tab" id="question-2">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#faq" href="#answer-2" aria-expanded="true" aria-controls="answer-2">
                                Can i share my balance to another people?
                            </a>
                        </h5>
                    </div>

                    <div id="answer-2" class="collapse" role="tabpanel" aria-labelledby="question-2">
                        <div class="card-block">
                            Yes, you can share any balance to any registered people by click on dropdown button in balance page and click to <mark>Invite</mark> button. Then you must find needle account by start typing his name or email.
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
