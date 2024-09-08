 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')
    <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Notifications</h1>
        <div class="savebtntop"><a class=" btn-flat" href="{{ url('/patient') }}/notification">Save</a></div>
    </div>
    <div class="container posrel has-header padtp minhtnor">


        <ul class="collection nobrder brdrtopsd">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">Email &amp; Notification</span>

                </div>
                <div class="right">

                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Consultations</span>

                </div>
                <div class="right">
                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
        </ul>
        <div class="divider"></div>
        <ul class="collection nobrder brdrtopsd">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">Text Messages (SMS) Notification</span>

                </div>
                <div class="right">

                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Consultations</span>

                </div>
                <div class="right">
                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
        </ul>
        <div class="divider"></div>
        <div class=" phoneCredit">
            <h5 class="digihis bluedoc-text">Phone Number &amp; Credit</h5>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar">

                    <input type="text" id="reason" class="validate ">
                    <label for="reason" class="grey-text truncate">Mobile Number</label>
                </div>
                <div class=" col s6 m6 l6">
                    <div class="valign-wrapper">
                        <div class="creditleft circle bluedoc-bg white-text center-align">5</div>
                        <span class="bluedoc-text">Credits Left</span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6 selct">
                    <select>
                        <option value="" disabled selected>Please Select Amount</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div>
                <div class=" col s6 m6 l6 selct">
                    <a class="waves-effect waves-light border-btn  center-align round-corner truncate notp" href="#"> Buy Credit </a>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <ul class="collection nobrder brdrtopsd">
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title green-text">App(Mobile Push) Notification</span>

                </div>
                <div class="right">

                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>
                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Consultations</span>

                </div>
                <div class="right">
                    <div class="switch">
                        <label>

                            <input type="checkbox" checked>
                            <span class="lever greenbg"></span>
                        </label>
                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Orders</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
            <li class="collection-item norl valign-wrapper">
                <div class="left wid90 truncate"><span class="title ">Newsletters</span>

                </div>
                <div class="right">
                    <div class="right">
                        <div class="switch">
                            <label>

                                <input type="checkbox" checked>
                                <span class="lever greenbg"></span>
                            </label>
                        </div>

                    </div>

                </div>

            </li>
        </ul>
        <div class="divider"></div>
        <div class="notificationSection ">
            <h5 class="digihis green-text">Timezone</h5>
            <div class="row">
                <div class="col s6 l6 m6">
                    <div class="input-field nomar">
                        <select>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="actnbtn"> <span class="right qusame rescahnge"><a href="{{ url('/patient') }}/notification" class="btn cart bluedoc-bg lnht round-corner">SAVE</a></span>

            <span class="left qusame rescahnge"><a class="border-btn round-corner center-align" href="#">CANCEL</a></span></div>
        <div class="clr"></div>
    </div>

    @endsection