@extends('front.doctor.layout.master')                
@section('main_content')

   <link href='{{url('/')}}/public/css/fullcalendar.min.css' rel='stylesheet' />

    <div class="banner-home inner-page-box">
        <div class="bg-shaad doc-bg-head">
        </div>
    </div>
    <!--calender section start-->
    <div class="container-fluid fix-left-bar">
        <div class="row">
           @include('front.doctor.layout._sidebar')
            <div class="col-sm-12 col-md-9 col-lg-10">
                <div class="das-middle-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="inner-head">Calendar &amp; Appointment</div>
                            <div class="head-bor">
                             
                            </div>

                            @include('front.layout._operation_status')
                            <div id="avail_msg"></div>


                        </div>
                    </div>
                    <div class="doc-dash-right-bx">
                        <div class="clearfix"></div>
                        <div class="calender-section">


                          {{--  <form  action="" method="post" id="frm_appoinment_availability" name="frm_appoinment_availability">
                            {{ csrf_field() }}

                             <input type="hidden" name="start_time" id="start_time">
                             <input type="hidden" name="end_time" id="end_time">

                            </form> --}}
                          {{--   <button class="cal-print"><i class="fa fa-print"></i></button>
                            <div class="search-cal">
                                <input type="text" class="calender-search" placeholder="Search Patients..." />
                                <span><button><img src="{{ url('/') }}/public/images/cal-search-icn.png" alt="icon"/></button></span> </div> --}}
                            <div id='calendar'></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="arr_appoinment" value="{{ (isset($arr_appoinment))? json_encode($arr_appoinment): json_encode(array()) }}">

    <script src='{{ url('/') }}/public/js/fullcalendar.min.js'></script>


    <script>
        $(document).ready(function()
         {
                var content  = '';
                var arr_appoinment        = arr_appoinment_dates = [];  
                var events                = []; 


                  arr_appoinment         = $("#arr_appoinment").val();
                  arr_appoinment_dates   = JSON.parse(arr_appoinment);

                 
                
                  for(var i =0; i < arr_appoinment_dates.length; i++) 
                  {
                    events.push( {title: arr_appoinment_dates[i].title , start: arr_appoinment_dates[i].start,end: arr_appoinment_dates[i].end,id:arr_appoinment_dates[i].id})
                  }



                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth()+1;
                    var y = date.getFullYear();


                  var calendar = $('#calendar').fullCalendar({

                   editable: true,
                   header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                   },

                    customButtons: {
                    myCustomButton: {
                        text: 'Add Availability',
                        click: function() {
                           $('#calendar').fullCalendar('changeView', 'agendaDay');
                        }
                    }
                },

                    defaultView: 'agendaWeek',
                    allDaySlot: false,
                    minTime: '00:00:00',
                    maxTime: '24:00:00',
                    defaultDate: '{{ $current_date or '' }}',
                    slotDuration: '00:10:00',
                 
                   events:  events,
                 

                    selectable: true,
                    selectHelper: true,

                    editable: true,
                     
                     /*when event drag then update existing event details*/
                     eventResize: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view)
                     {

                      var event_start_time = moment(event.start).format('YYYY-MM-DD HH:mm:ss');  
                      var event_end_time   = moment(event.end).format('YYYY-MM-DD HH:mm:ss'); 
                      var event_id         = event.id;

                      editAvailability(event_start_time,event_end_time,event_id);            
 
                    },

                     /*when event drop then update existing event details*/
                     eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view)
                     {

                      var event_start_time = moment(event.start).format('YYYY-MM-DD HH:mm:ss');  
                      var event_end_time   = moment(event.end).format('YYYY-MM-DD HH:mm:ss'); 
                      var event_id         = event.id;

                      editAvailability(event_start_time,event_end_time,event_id);            
 
                    },



                      select: function(start, end, allDay) {

                         var day   = moment(start).format('D');
                         var month = moment(start).format('M');
                         var view = $('#calendar').fullCalendar('getView');

                   
                         if(month<m)
                         {
                               alert('Sorry,cannot add appoinment for date in past.');
                                return false;
                         }
                         else
                         {    

                              if(month==m)
                              {
                                  if(day<d)
                                  {
                                      alert('Sorry,cannot add appoinment for date in past.');
                                      return false;
                                  }
                              }
                            
                               if(view.name=='month')
                               {
                                    $('#calendar').fullCalendar('changeView', 'agendaDay');
                                    $('#calendar').fullCalendar('gotoDate', start);
                               }
                                
                                if(end.hasTime())
                                {  
                                    var st = moment(start).format('YYYY-MM-DD HH:mm:ss');
                                    var en = moment(end).format('YYYY-MM-DD HH:mm:ss');
                                    showAlert(st,en);
                                 
                                  
                                }
                           

                         }
                        
                          

                      },                                 
                      

               });     
        });
        function showAlert(start_time,end_time)
        {
            var date  = moment(start_time).format('YYYY-MM-DD');
            var time  = moment(start_time).format('HH:mm:ss');
            swal({
                

                  title: "Are you really available for this date"+" "+ date +'and time '+" "+time+'?',
                  type: 'success',
                  showCancelButton: true,
                  allowOutsideClick: true,
                  html: true
                        
             },
              function(isConfirm)
              {
                   if(isConfirm)
                   {
                      $('#start_time').val(start_time);
                      $('#end_time').val(end_time);
                      //$("#appoinment-create-modal").modal('show');  
                      // $('#frm_appoinment_availability').submit();
                      createAvailability(start_time,end_time);
                   }  
              });

        }
        function createAvailability(start_time,end_time)
        {

             var url = "{{ url('/') }}/doctor/appointment/create";

             var token = $("input[name='_token']").val();    
          
              var data = new FormData();
              data.append('start_time',start_time); 
              data.append('end_time',end_time);  
              data.append('_token', token);
              $.ajax({
                   url : url,
                   type:'POST',        
                   data:data, 
                   contentType: false,     
                   cache: false,          
                   processData:false,
                     beforeSend: function() 
                    {
                      showProcessingOverlay();
                    },
                    success: function(res)   
                    { 
                        location.reload();
                        hideProcessingOverlay();
                 
                    } 
              });   
        }
        function editAvailability(start_time,end_time,id)
        {
              var date  = moment(start_time).format('YYYY-MM-DD');
              var time  = moment(start_time).format('HH:mm:ss');
              swal({
                  

                    title: "Are you want to update availability for this date"+" "+ date +' and time '+" "+time+'?',
                    type: 'success',
                    showCancelButton: true,
                    allowOutsideClick: true,
                    html: true
                          
               },
              function(isConfirm)
              {
                     if(isConfirm)
                     {
                        
                        updateAvailability(start_time,end_time,id);
                     }  
                     else
                     {
                        location.reload();
                     }
              });
        }
        function updateAvailability(start_time,end_time,id)
        {
              
             var url = "{{ url('/') }}/doctor/appointment/update";

             var token = $("input[name='_token']").val();    
          
              var data = new FormData();
              data.append('start_time',start_time); 
              data.append('end_time',end_time); 
              data.append('id',id); 
              data.append('_token',token);

              $.ajax({
                   url : url,
                   type:'POST',        
                   data:data, 
                   contentType: false,     
                   cache: false,          
                   processData:false,
                    beforeSend: function() 
                    {
                      showProcessingOverlay();
                    },
                    success: function(res)   
                    { 
                        //console.log(res);
                        //location.reload();
                        hideProcessingOverlay();
                        if(res.status=="success")
                        {
                             var msg = showStatusMessageHtml('success',res.msg);
                             $("#avail_msg").html(msg);

                        }
                        else if(res.status=="error")
                        {
                             var msg = showStatusMessageHtml('danger',res.msg);
                             $("#avail_msg").html(msg);
                        }
                        
                 
                    } 
              }); 
        }
       
        function showStatusMessageHtml(status, message)
        {
             str = '<div class="alert alert-'+status+'">'+
            '<a aria-label="close" data-dismiss="alert" class="close" href="#">'+'×</a>'+message+
            '</div>';
            return str;
        }
    </script>

@endsection        