<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true"
						 data-slide-speed="200" style="padding-top: 20px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							<!--<li class="sidebar-user-panel">
								<div class="user-panel">
									<div class="pull-left image">
										<img src="<?php echo BASE_PATH;?>assets/img/dp.jpg" class="img-circle user-img-circle" alt="User Image" />
									</div>
									<div class="pull-left info">
										<p> Kiran Patel</p>
										<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
									</div>
								</div>
							</li>-->
							<li class="nav-item start <?php echo ($page=='Home')?'active':'';?>">
								<a href="<?php echo BASE_PATH;?>Home/" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
									<span class="title">Dashboard</span>
								</a>
							</li>
							<li class="nav-item <?php echo ($page=='module' or $page=='admform' or $page=='feature' or $page=='feeslip' or $page=='tc' or $page=='bona' or $page=='char' or $page=='admit' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle">
									<i class="material-icons">settings</i>
									<span class="title">Setting</span>
									<span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
									
									<li class="nav-item <?php echo ($page=='module')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Manage_Module/" class="nav-link ">
											<span class="title">Manage Module</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='feature')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Manage_Feature/" class="nav-link ">
											<span class="title"> Manage Feature</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='feeslip')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Feeslip/" class="nav-link ">
											<span class="title"> Manage Feeslip</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='admform')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Form/" class="nav-link ">
											<span class="title"> Manage Adm.Form</span>
											<span class="selected"></span>
										</a>
									</li>
									
									<li class="nav-item <?php echo ($page=='tc')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_TC/" class="nav-link ">
											<span class="title"> Manage TC</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='char')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_CHAR/" class="nav-link ">
											<span class="title"> Manage Character Certificate</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='bona')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_BONA/" class="nav-link ">
											<span class="title"> Manage Bonafide Certificate</span>
											<span class="selected"></span>
										</a>
									</li>
									
									<li class="nav-item <?php echo ($page=='admit')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Admitcard/" class="nav-link ">
											<span class="title"> Manage Admit Card</span>
											<span class="selected"></span>
										</a>
									</li>
									
								</ul>
							</li>
							<li class="nav-item <?php echo ($page=='reseller' or $page=='areseller' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle">
									<i class="material-icons">account_circle</i>
									<span class="title">Reseller</span>
									<span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='reseller')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Reseller/" class="nav-link ">
											<span class="title">Manage Reseller</span>
											<span class="selected"></span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='areseller')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Manage_Reseller/" class="nav-link ">
											<span class="title">All Reseller</span>
											<span class="selected"></span>
										</a>
									</li>
								</ul>
							</li>
							
							
							
						
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>