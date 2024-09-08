<div id="footer-full">
    <div class="bag-footer full hide-on-med-and-down">
        <div>
            <div class="emailerBlock">
                <div class="container">
                    <div class="footer-section">
                        <label class="subs">Subscribe Newsletter</label>
                        <div class="emailer-info">
                            <input type="text" class="emiler-footer" placeholder="Email" /><span><button type="button" class="news-letter"><i class="fa fa-arrow-circle-o-right"></i></button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="">
                <div class="footer-block row">
                    <div class="col s12 m5 l6">

                        <div class="footer-section">
                            <div class="ftr-col">
                                <div class="footer-heading">
                                    Learn More
                                </div>
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="javascript:void(0);"> About Us</a></li>
                                        <li><a href="javascript:void(0);"> Team </a></li>
                                        <li><a href="javascript:void(0);"> Pricing </a></li>
                                        <li><a href="javascript:void(0);"> Careers </a></li>
                                        <li><a href="javascript:void(0);"> FAQ's </a></li>
                                        <li><a href="javascript:void(0);"> Press </a></li>
                                        <li><a href="javascript:void(0);"> Privacy Policy </a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="ftr-col-snd">
                                <div class="footer-heading">
                                    Partners
                                </div>
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="javascript:void(0);">Companies &amp; Organisations</a></li>
                                        <li><a href="javascript:void(0);"> Private Health Funds </a></li>
                                    </ul>
                                </div>
                                <p></p>
                                <div class="footer-heading">
                                    Join our Platform
                                </div>
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="javascript:void(0);">Doctors</a></li>
                                        <li><a href="javascript:void(0);"> Pharmacies</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col s12 m4 l4">
                        <div class="footer-section">
                            <div class="footer-heading">
                                Get in Touch
                            </div>
                            <div class="footer-links">
                                <div class="get-touch-bx">
                                    <div class="genral-heading">General Enquiries </div>
                                    <p> 1300 352 184</p>
                                    <p> customercare@doctoroo.com.au</p>
                                </div>
                                <div class="get-touch-bx">
                                    <div class="genral-heading">Investors </div>
                                    <p> investor@doctoroo.com.au</p>
                                </div>
                                <div class="get-touch-bx">
                                    <div class="genral-heading">Media &amp; Press </div>
                                    <p> media@doctoroo.com.au</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m3 l2">
                        <div class="footer-section">
                            <div class="footer-heading">
                                Get Started
                            </div>
                            <div class="footer-links">
                                <div class="footer-app-imgs">
                                    <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/appstor.png" alt="img" class="responsive-img" /></a>
                                    <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/google-play.png" alt="img" class="responsive-img" /></a>
                                    <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/andr-app.png" alt="img" class="responsive-img" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col s12 m8 l8">
                        <div class="stament-copyright">&copy; 2017 Doctoroo Australia PTY. LTD. | ACN 616 602 629 | All Rights Reserved. <a href="javascript:void(0);" class="terms-ftr-link"> Terms &amp; Conditions</a>
                        </div>
                    </div>
                    <div class="col s12 m4 l3 right">
                        <div class="social-link">
                            <ul>
                                <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <div id="logout" class="modal requestbooking">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <p>Are you sure you want to Logout?</p>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="{{ url('/') }}/logout" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>

    <a class="open_popup" href="#show_flash_msg" style="display: none;"></a>
    <div id="show_flash_msg" class="modal requestbooking" style="display: none;">
        <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
            <div class="row">
                <div class="col s12 l12">
                    <div class="flash_msg_text"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align ">
            <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">OK</a>
        </div>
    </div>
    <script>
      $('#show_flash_msg .modal-close').click(function() {
        location.reload();
      });
    </script>

    <script src="{{ url('/') }}/public/new/js/picker.js"></script>
    <script src="{{ url('/') }}/public/new/js/picker.date.js"></script>
    <!-- <script src="{{ url('/') }}/public/new/js/custom_datepicker.js"></script> -->
    
        <script>
        $( '.datepicker' ).pickadate({
          format: 'dd/mm/yyyy',
          formatSubmit: 'yyyy-mm-dd',
          defaultValue: false,
          disable:[{from: [0,0,0], to: true }],
          selectMonths: true,
          selectYears: true,
          onOpen: function() {
              console.log( 'Opened')
          },
          onClose: function() {
              console.log( 'Closed ' + this.$node.val() )
              
              selected_date = this.$node.val();
              var token = $('input[name="_token"]').val();
              $.ajax({
                   url   : "{{ url('/') }}/patient/booking/get_doctor_available_time",
                   type  : "POST",
                   //dataType:'json',
                   data: {_token:token,selected_date:selected_date},
                   success : function(res){
                      
                        if($.trim(res)=='error')
                        {
                           $('.choosetime').empty(); 
                        }
                        else
                        {
                            $('#getting_time').empty();
                            $('#getting_time').append(res);
                        }
                    }
              });
          },
          onSelect: function() {
              console.log( 'Selected: ' + this.$node.val() )
          },
          onStart: function() {
              console.log( 'Hello there :)' )
          }
        })

        $( '.dob_datepicker' ).pickadate({
          format: 'dd/mm/yyyy',
          formatSubmit: 'yyyy-mm-dd',
          defaultValue: false,
          selectMonths: true,
          selectYears: true,
          max:new Date(),
          onOpen: function() {
              console.log( 'Opened')
          },
          onClose: function() {
              console.log( 'Closed ' + this.$node.val() )
              
              selected_date = this.$node.val();
              var token = $('input[name="_token"]').val();
          },
          onSelect: function() {
              console.log( 'Selected: ' + this.$node.val() )
          },
          onStart: function() {
              console.log( 'Hello there :)' )
          }
        })
    </script>
    <script src="{{ url('/') }}/public/new/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/public/new/js/jquery-clockpicker.min.js"></script>
    <script>
        $('.clockpicker').clockpicker({
            placement: 'bottom'
            , align: 'left'
            , autoclose: true
            , 'default': 'now'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done'
        , }).find('input').change(function () {
            console.log(this.value);
        });
        $('#check-minutes').click(function (e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        if (/mobile/i.test(navigator.userAgent)) {
            $('input').prop('readOnly', true);
        }
    </script>

    <script src="{{ url('/') }}/public/new/js/materialize.js"></script>
    <script src="{{ url('/') }}/public/new/js/init.js"></script>

    
    <!-- For logout after tab and browser close -->
    <script  src="{{ url('/') }}/public/js/logout.js"></script>

</body>

</html>