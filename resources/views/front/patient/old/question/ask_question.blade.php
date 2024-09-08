  <style>
   a:hover {
    cursor:pointer;
   }
  </style>

  <div class="middle-section">
         <div class="container">
           @include('front.layout._operation_status')
           <div class="das-middle-content">
                <div class="row">
                   <div class="col-sm-12 col-md-12 col-lg-12">

                   <form action="{{ $module_url_path }}/store" method="post" name="frm_ask_question" id="frm_ask_question">
                      {{ csrf_field() }}
                   <div class="tab-section">
                      <div class="doc-dash-right-bx" style="margin:0;">

                            <div class="white-bxx">
                               <div class="uer-bxx">
                                  <div class="gree-txt"></div>
                                  <br/>

                                  <h5>Enter Your Question here?</h5>
                                  <textarea class="frm-in q-txta" cols="" rows="" data-rule-required="true" id="question" name="question"></textarea>
                                  <div class="last-row">
                                  <input type="submit" class="preview-link sum-btn" value="Submit Question" name="btn_submit">
                                  </div>
                               </div>
                            </div><!--white-bxx-->
                          
      <script>
          
          $(document).ready(function(){


              $('#frm_ask_question').validate({
                  errorElement:'span',

                     messages: {
                            question:
                            {
                                required:"Pleae enter a question.",
                            },   
                                  
                           
                        }
              });  

           });


      </script>
