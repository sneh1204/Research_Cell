<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?=base_url();?>index.php/Ctrl_dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Menu</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Projects</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-plus"></i><a href="<?=base_url();?>index.php/Ctrl_add/project">Add</a></li>                          
                            <li><i class="fa fa-list-ul"></i><a href="<?=base_url();?>index.php/Ctrl_list/project">List</a></li>                   
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar-o"></i>Events</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="<?=base_url();?>index.php/Ctrl_add/event">Add</a></li>
                             <li><i class="fa fa-list-ul"></i><a href="<?=base_url();?>index.php/Ctrl_list/event">List</a></li>                       
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-group (alias)"></i>MoUs</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="<?=base_url();?>index.php/Ctrl_add/mous">Add</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="<?=base_url();?>index.php/Ctrl_list/mous">List</a></li>                              
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-newspaper-o"></i>Publications</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list-ul"></i><a href="<?=base_url();?>index.php/Ctrl_list/student">Student</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="<?=base_url();?>index.php/Ctrl_list/faculty">Faculty</a></li>                              
                        </ul>
                    </li>

                    <li class="menu-title">Internships</li><!-- /. Internships section -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Inhouse</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="<?=base_url();?>index.php/Ctrl_add/inhouse">Add</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="ui-tabs.html">List</a></li>     
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building-o"></i>Company</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="<?=base_url();?>index.php/Ctrl_add/company">Add</a></li>                       
                            <li><i class="fa fa-list-ul"></i><a href="ui-tabs.html">List</a></li>     
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->