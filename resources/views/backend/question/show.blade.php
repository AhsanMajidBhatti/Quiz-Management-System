@extends('backend.layouts.master')

	@section('title','show question')

	@section('content')
				<div class="span9">
                    <div class="content">
                    	
                        <div class="module">
                            <div class="module-head">
                                
                            </div>

                            <div class="module-body">
                            	
                            <p><h3 class="heading">{{ $question->question }}</h3></p>

                                <div class="module-body table">
                                    <table class="table table-message">
                                        <tbody>
                                            
                                        @foreach($question->answers as $key => $answer)
                                            <tr class="read">
                                                
                                                <td class="cell-author hidden-phone hidden-tablet">
                                                    {{ $key+1 }}. {{ $answer->answer }}
                                                    @if($answer->is_correct)
                                                    <span class="badge badge-success pull-right">correct</b></span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="module-foot">
                                    <a href="{{ route('question.edit', [$question->id]) }}">
                                        <button class="btn btn-primary">EDIT</button>
                                    </a>

                                    <a href="#" onclick="if(confirm('Are You Sure?')){
                                        event.preventDefault();
                                        document.getElementById('delete_form{{ $question->id }}').submit();
                                    }
                                    else{
                                        event.preventDefault();
                                    }">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </a>
                                    <a href="{{ route('question.index') }}">
                                        <button class="btn btn-inverse pull-right">BACK</button>
                                    </a>

                                    <form id="delete_form{{ $question->id }}" action="{{ route('question.destroy', [$question->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                    </form>
                                </div>

                            </div>
                   		</div>
                		
                		</div>
           			 
           			</div>
        		</div> 

            </div> 
        </div> 
@endsection