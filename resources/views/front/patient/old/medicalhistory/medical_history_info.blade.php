<!--login popup start here-->
<div id="medical-histroy-modal" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
    <div class="modal-dialog loign-insw">
        <!-- Modal content-->
        <div class="modal-content logincont">
            <div class="modal-header head-loibg">
                <button type="button" class="login_close close" data-dismiss="modal">
                    <img src="{{ url('/') }}/public/images/close-popup.png" alt="">
                </button>
            </div>
            <div class="modal-body bdy-pading">
                <div class="login_box">
                    <div class="title_login">Medical history</div>
                    <div class="medical-history-popup">
                        <p>
                            <span><i class="fa fa-circle-o"></i> </span> Your Medical History is an important summary of your health that will help your doctor understand your health. Just like normal doctor consultations, your doctor needs a summary of your health to be able to diagnose and treat you more effectively.
                        </p>
                        <ul class="medi-his-points">

                            Why should I complete this?
                            <li>
                                1) It takes about 2 minutes
                            </li>
                            <li>
                                2) You only need to do it once – we’ll save it for future use
                            </li>
                            <li>
                                3) By completing it now, you’ll save time during your consultations (as your doctor won’t need to ask you them) and therefore your consultation will cost less
                            </li>
                        </ul>
                        <p>
                            <span><i class="fa fa-circle-o"></i> </span> Is this private? Your privacy and the security of your information is very important to us. That’s why we make sure your data is encrypted and stored on some of the most secure Australian servers, which are protected by Australia Law, with very strong security measures in place. To read more about our [<a href="#">Privacy Policy</a> , Click Here].
                        </p>
                        <div class="login-bts">
                            <button class="btn btn-search-login" onclick="redirectToFirstStep()" value="" type="button">Begin Medical History</button>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirectToFirstStep() {
            window.location.href = "{{url('/')}}/patient/medicalhistory/step-1";
        }
    </script>