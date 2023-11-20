@extends('layouts.admin', [
  'page_header' => 'Mes rapports par sujet',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
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
                  <li>{{__('message.Time')}} <i class="fa fa-long-arrow-right"></i></li>
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

            @if($topic->show_ans ==1)
            <a href="{{route('my_report_show', $topic->id)}}" class="btn btn-wave">Rapport d'émission</a>
            @endif
            
          </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection
