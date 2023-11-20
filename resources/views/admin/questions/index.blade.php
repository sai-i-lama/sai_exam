@extends('layouts.admin', [
  'page_header' => 'Questions par sujet',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => 'active',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="row">
    @if ($topics)
      @foreach ($topics as $key => $topic)
        <div class="col-md-4">
          <div class="quiz-card">
            <h3 class="quiz-name">{{$topic->title}}</h3>
            <p title="{{$topic->description}}">
              {{str_limit($topic->description, 120)}}
            </p>
            <div class="row">
              <div class="col-xs-6 pad-0">
                <ul class="topic-detail">
                  <li>{{__('message.Per Question Mark')}} <i class="fa fa-long-arrow-right"></i></li>
                  <!--<li>{{__('message.Total Marks')}} <i class="fa fa-long-arrow-right"></i></li>-->
                  <li>{{__('message.Total Questions')}} <i class="fa fa-long-arrow-right"></i></li>
                  <li>{{__('message.Total Time')}} <i class="fa fa-long-arrow-right"></i></li>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul class="topic-detail right">
                  <li>{{$topic->per_q_mark}}</li>
                  <li>---</li>
                  <!--<li>
                    @php
                        $qu_count = 0;
                    @endphp
                    @foreach($questions as $question)
                      @if($question->topic_id == $topic->id)
                        @php 
                          $qu_count++;
                        @endphp
                      @endif
                    @endforeach
                    {{$topic->per_q_mark*$qu_count}}
                  </li>-->
                  
                  <li>
                    {{$qu_count}}
                  </li>
                  <li>---</li>
                  <li>
                    {{$topic->timer}} minutes
                  </li>
                </ul>
              </div>
            </div>
            <a href="{{route('questions.show', $topic->id)}}" class="btn btn-wave">Ajouter des Questions</a>
            <a data-target="#deleteans{{ $topic->id }}" data-toggle="modal" class="btn btn-danger">Supprimer</a>
          </div>

          <div id="deleteans{{ $topic->id }}" class="delete-modal modal fade" role="dialog">
                    <!-- Delete Modal -->
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Etes-vous sûr?</h4>
                          <p>Voulez-vous vraiment supprimer ces enregistrements ? Ce processus ne peut pas être annulé.</p>
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method' => 'DELETE', 'action' => ['TopicController@deleteperquizsheet', $topic->id]]) !!}
                            {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                            {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection
