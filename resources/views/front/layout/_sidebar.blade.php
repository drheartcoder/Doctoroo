
<?php
        $admin_path     = config('app.project.admin_panel_slug');
?>

<div id="sidebar" class="navbar-collapse collapse">
                <!-- BEGIN Navlist -->
                <ul class="nav nav-list">
                    
                    
                    <li class="<?php  if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/dashboard'}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'account_settings'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa fa-wrench"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="submenu">
                            <li style="display: block;"><a href="{{ url($admin_path.'/account_settings')}}">Profile</a></li>
                            <li style="display: block;"><a href="{{ url($admin_path.'/socialsettings')}}">Social Settings</a></li>
                        </ul>
                    </li>

                    
                   <!--  <li class="<?php  if(Request::segment(2) == 'admin_users'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/admin_users' }}" >
                            <i class="fa fa-server"></i>


                            <span>Account Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                    </li> -->

                    <li class="<?php  if(Request::segment(2) == 'static_pages'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa  fa-sitemap"></i>
                            <span>Front Pages</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                         <ul class="submenu">
                            <li style="display: block;"><a href="{{ url($admin_panel_slug.'/static_pages')}}">Manage </a></li>                            
                        </ul>
                   </li>

                   <!--  <li class="<?php  if(Request::segment(2) == 'email_template'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa fa-envelope"></i>
                            <span>Email Template</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                         <ul class="submenu">
                            <li style="display: block;"><a href="{{ url($admin_panel_slug.'/email_template')}}">Manage</a> </li>
                        </ul>
                    </li> -->

                    <li class="<?php  if(Request::segment(2) == 'site_settings'){ echo 'active'; } ?>">
                        <a href="{{ url($admin_panel_slug.'/site_settings') }}" >
                            <i class="fa  fa-wrench"></i>
                            <span>Site Settings</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                            <ul class="submenu">
                            <li style="display: block;"><a href="{{ url($admin_panel_slug.'/users')}}">Manage </a></li>
                        </ul>
                    </li>


                     <!--  <li class="<?php  if(Request::segment(2) == 'language'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa fa-puzzle-piece"></i>
                            <span>Language</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                         <ul class="submenu">
                            <li style="display: block;"><a href="{{ url('/admin/language')}}">Manage </a></li> 
                        </ul>
                    </li> -->

                
                  <!--  <li class="<?php  if(Request::segment(2) == 'categories'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa  fa-sitemap"></i>
                            <span>Categories</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                         <ul class="submenu">
                            <li style="display: block;"><a href="{{ url('/').'/'.$admin_path.'/categories'}}">Manage </a></li>                            
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'countries' || Request::segment(2) == 'states' || Request::segment(2) == 'cities' || Request::segment(2) == 'countries' ){ echo 'active'; } ?>"> 
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="fa fa-globe"></i>
                            <span>Locations</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                         <ul class="submenu">

                            
                            <li class="<?php  if(Request::segment(2) == 'states'){ echo 'active'; } ?>"><a href="{{ url('/').'/'.$admin_path.'/states'}}">Manage State/Regions</a></li>

                            <li class="<?php  if(Request::segment(2) == 'cities'){ echo 'active'; } ?>"><a href="{{ url('/').'/'.$admin_path.'/cities'}}">Manage Cities</a></li> 
                            <li class="<?php  if(Request::segment(2) == 'countries'){ echo 'active'; } ?>"><a href="{{ url('/').'/'.$admin_path.'/countries'}}">Manage Country</a></li> 
                        </ul>
                    </li>
                     -->
               
                <!-- END Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-lg">
                    <i class="fa fa-angle-double-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>

   