<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true"
						 data-slide-speed="200" style="padding-top: 10px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							<li class="sidebar-user-panel">
								<div class="user-panel">
									
									<div class="pull-left info">
										<p> <?php echo $_SESSION['MI_username'];?> </p>
										<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> +91-<?php echo $reseller['mobile'];?></span></a>
									</div>
								</div>
							</li>
							<li class="nav-item start <?php echo ($page=='Home')?'active':'';?>">
								<a href="<?php echo BASE_PATH;?>Home/" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
									<span class="title">Dashboard</span>
								</a>
							</li>
						
							<li class="nav-item <?php echo ($page=='company' or $page=='acompany' or $page=='authority' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
									<span class="title">Manage Company </span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='company')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Company/" class="nav-link "> <span class="title"> Add New</span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='acompany')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Company/" class="nav-link "> <span class="title"> View All</span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='authority')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Authority/" class="nav-link "> <span class="title"> Module Authority</span>
										</a>
									</li>
								</ul>
							</li>
							<!---<li class="nav-item <?php echo ($page=='sms' or $page=='email' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">send</i>
									<span class="title">Manage SMS </span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='sms')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_SMS/" class="nav-link "> <span class="title"> Shoot SMS</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item <?php echo ($page=='slider' or $page=='latest' or $page=='popular' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">list</i>
									<span class="title">Other</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='slider')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Slider/" class="nav-link "> 
										<span class="title"> Slider</span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='popular')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Popular/" class="nav-link "> 
										<span class="title"> Popular News</span>
										</a>
									</li>
									<li class="nav-item <?php echo ($page=='latest')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Latest/" class="nav-link "> 
										<span class="title"> Latest News</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item <?php echo ($page=='gallery' )?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">image</i>
									<span class="title">Gallery </span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='gallery')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_gallery/" class="nav-link "> <span class="title"> Add/View Gallery</span>
										</a>
									</li>
									
								</ul>
							</li>-->
							
							
							
							<!--<li class="nav-item <?php echo ($page=='poh1' or $page=='poh2' or $page=='poh3')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">list</i>
									<span class="title">POH Scheduling</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='poh1')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_POH/" class="nav-link "> <span class="title">Set Continuous Process</span>
										</a>
									</li>

								</ul>
							</li>
							<li class="nav-item <?php echo ($page=='ti' or $page=='ia1' or $page=='ia2' or $page=='ia3' or $page=='ic1' or $page=='ic1ia1' or $page=='ic1ia2' or $page=='ic1ia3' or $page=='ic2' or $page=='ic2ia1' or $page=='ic2ia2' or $page=='ic2ia3')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">list</i>
									<span class="title">Scheduled Work</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?php echo ($page=='ti')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_TI/" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
											<span class="title">TI</span>
										</a>
									</li>
									
								</ul>
							</li>--->
							
							
							
							
							
							
							
							
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>