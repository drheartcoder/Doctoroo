@extends('front.patient.layout._no_sidebar_master')
@section('main_content')


    <div class="header emergencyhead z-depth-2 ">

        <div class="backarrow"><a href="{{ URL::previous() }}" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title left-align bluedoc-text">Emergencies &amp; non-suitable conditions</h1>

    </div>
    
    <div class="container posrel has-header has-footer">
        <div class="emergencyscetion">
            <h3 class="ques">Please <strong> call 000 </strong> if you are experiencing any of the below symptoms, as an online doctor is not suitable in these situations.</h3>

            <ul class="pointsQues">
                <li>Chest pain or chest tightness</li>
                <li>Serious assault</li>
                <li>sudden onset of weakness, numbness or paralysis of the face, arm, or leg</li>
                <li>poisoning/overdose</li>
                <li>Severe burns</li>
                <li>unconsciousness or fitting</li>
                <li>suicidal or extreme psychological distress</li>
                <li>difficulty breathing or turning blue</li>
                <li>sudden collapse or blackout</li>
                <li>snake, funnel web or red back spider bite</li>
                <li>severe or distressing pain</li>
                <li>heart palpitations</li>
                <li>heavy or uncontrollable bleeding</li>
                <li>severe allergic reaction</li>
                <li>injury from a major accident</li>
            </ul>

           <div class="clr"></div>
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ URL::previous() }}">Back</a>
    </div>
    

    <!--Container End-->

@endsection