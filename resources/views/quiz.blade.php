@extends('layouts.app')

@section('content')

<quiz-component :times="{{ $time }}" :quizid="{{ $quiz->id }}" :quiz-questions="{{ $quizQuestions }}"
    :has-played-quiz="{{ $authUserhasPlayedQuiz }}">

</quiz-component>

<script type="text/javascript">
window.oncontextmenu = function() {
    alert('Right Click Disabled');
    return false;
}
</script>

@endsection