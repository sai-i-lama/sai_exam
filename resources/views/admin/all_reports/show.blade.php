@extends('layouts.admin', [
  'page_header' => "Top Utilisateurs / {$topic->title}",
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => 'active',
  'sett' => ''
])

@section('content')
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="topTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('message.Student Name')}}</th>
            <th>{{__('message.Mobile No.')}}</th>            
            <th>{{__('message.Topic')}}</th>
            <th>{{__('message.Marks Got')}}</th>
            <th>{{__('message.Total Marks')}}</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($answers)
            @foreach ($filtStudents as $key => $student)
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>{{$student->name}}</td>
                <td>{{$student->mobile}}</td>               
                <td>{{$topic->title}}</td>
                <td>
                  @php
                    $mark = 0;
                    $correct = collect();
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->user_id == $student->id && $answer->answer == $answer->user_answer)
                      @php
                       $mark++;
                      @endphp
                    @endif
                  @endforeach
                  @php
                    $correct = $mark*$topic->per_q_mark;
                  @endphp
                  {{$correct}}
                </td>
                <td>
                  {{$c_que*$topic->per_q_mark}}
                </td>
                <td>
                  <a data-toggle="modal" data-target="#delete{{ $topic->id }}" title="Cela supprimera la feuille de réponses de cet utilisateur" href="#" class="btn btn-sm btn-warning">
                    réinitialiser la réponse
                  </a>

                  <div id="delete{{ $topic->id }}" class="delete-modal modal fade" role="dialog">
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
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AllReportController@delete', 'topicid' => $topic->id, 'userid' => $student->id] ]) !!}
                                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
