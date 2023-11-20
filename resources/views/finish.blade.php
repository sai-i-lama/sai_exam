@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
  <script>
        function checkout() {
          CinetPay.setConfig({
                apikey: '5337111116358eef42b6448.37599996',//   YOUR APIKEY
                site_id: '301005',//YOUR_SITE_ID
                notify_url: 'http://mondomaine.com/notify/',
                mode: 'PRODUCTION'
            });
            CinetPay.getCheckout({
                transaction_id: Math.floor(Math.random() * 100000000).toString(),
                amount: 100,
                currency: 'XOF',
                channels: 'ALL',
                description: 'Test de paiement',   
                 //Fournir ces variables pour le paiements par carte bancaire
                customer_name:"Joe",//Le nom du client
                customer_surname:"Down",//Le prenom du client
                customer_email: "down@test.com",//l'email du client
                customer_phone_number: "088767611",//l'email du client
                customer_address : "BP 0024",//addresse du client
                customer_city: "Antananarivo",// La ville du client
                customer_country : "CM",// le code ISO du pays
                customer_state : "CM",// le code ISO l'état
                customer_zip_code : "06510", // code postal

            });
            CinetPay.waitResponse(function(data) {
                if (data.status == "REFUSED") {
                    if (alert("Votre paiement a échoué")) {
                        window.location.reload();
                    }
                } else if (data.status == "ACCEPTED") {
                    if (alert("Votre paiement a été effectué avec succès")) {
                        window.location.reload();
                    }
                }
            });
            CinetPay.onError(function(data) {
                console.log(data);
            });
        }
    </script>
@endsection

@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <!--<div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div>-->
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
              <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
                <img src="{{asset('/images/logo/background.png')}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
              </a> 
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">             
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}" title="Login">Login</a></li>
                  <li><a href="{{ route('register') }}" title="Register">Registre</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">{{__('message.Dashboard')}}</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">{{__('message.Dashboard')}}</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                 </li>
                @endguest
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
<div class="container">
  @if ($auth)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="home-main-block">

               

        @if($topic->show_ans==1)
        
         <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} {{__('message.ANSWER REPORT')}}</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Question</th>                  
                  
                  <th style="color: green;">{{__('message.Correct Answer')}}</th>
                  <th style="color: red;">{{__('message.Your Answer')}}</th>
                  <th>{{__('message.Answer Explanation')}}</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();
                @endphp             
               
                @php
                $x = $count_questions;               
                $y = 1;
                @endphp
                @foreach($answers as $key=> $a)
                
                  @if($a->user_answer != "0" && $topic->id == $a->topic_id)
                    <tr>
                      <td>{{ $a->question->question }}</td>
                      <td>{{ $a->answer }}</td>
                      <td>{{ $a->user_answer }}</td>
                      <td>{{ $a->question->answer_exp }}</td>
                    </tr>
                    @php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    @endphp
                  @endif
                @endforeach              
               
              </tbody>
            </table>
            
          </div>

          @endif
      

      
          <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} Résultats</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Questions Total</th>
                  <th>{{__('message.My Marks')}}</th>
                 <!-- <th>Point par question</th>-->
                  <th>Sur </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$count_questions}}</td>
                  <td>
                    @php
                      $mark = 0;
                      $correct = collect();
                    @endphp
                    @foreach ($answers as $answer)
                      @if ($answer->answer == $answer->user_answer)
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
                  <!--<td>{{$topic->per_q_mark}}</td>-->
                  <td>{{$topic->per_q_mark*$count_questions}}</td>
                </tr>
              </tbody>
            </table>
            @if($correct < ($topic->per_q_mark*$count_questions)/2)
            <p>Malheureusement vous n'avez pas reussi le test, mais vous avez la possibilité de repasser le test en passant par un paiement.</p>
            <div class="col-md-6">
              <button onclick="checkout()" class="btn btn-block" title="Start Quiz" style="font-size:20px;color: #FFF;">Paiement </button>
            </div>
            <img src="https://docs.cinetpay.com/images/latest_cm1.png" alt="Logo CinetPay" style="margin-bottom:0; width: 50%; height: 10%">
            @else
            <p style="font-size:20px;">Félicitation vous avez réussi le test, avec une note de <strong>{{$correct}}</strong> sur <strong>{{$topic->per_q_mark*$count_questions}}</strong><p>
            @endif
            
          </div>
        </div>
      </div>
    </div>
    
  @endif
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
      });
    });
  </script>
@endsection
