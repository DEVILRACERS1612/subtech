<?php 
	$msql=$db->exeQuery("select * from mi_module_assign where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
	$mrow=$msql->fetch_assoc();
	$assign_module=$mrow['module_id'];
	$assign_feature=$mrow['feature_id'];
	$module=explode(",",$assign_module);
	$feature=explode(",",$assign_feature);
	
	//print_r($feature);
?>
<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 2px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							
							
							<li class="sidebar-user-panel">
								<div class="user-panel">
									<div class="pull-left ">
										<a href="#"><b><?php echo $_SESSION[SITE_NAME]['MICMP_name'];echo '</b><br><i class="fa fa-circle user-online"></i><span class="txtOnline"> Active</span></a>';?>  
										
									</div>
								</div>
							</li>
							<li class="nav-item start <?php echo ($page=='Home')?'active':'';?>">
								<a href="<?php echo BASE_PATH;?>Home/" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
									<span class="title">Dashboard</span>
								</a>
							</li>
				<?php if(check_module("setting",$module)){ ?>			
							<li class="nav-item start <?php echo ($page=='setting')?'active':'';?>">
								<a href="<?php echo BASE_PATH;?>Setting/" class="nav-link nav-toggle"> <i class="fa fa-cog"></i>
									<span class="title">Setting</span>
								</a>
							</li>
				<?php } if(check_module("website",$module)){ ?>
							<li class="nav-item <?php echo ($page=='blog' or $page=='slider' or $page=='pcat' or $page=='product' or $page=='solution' or $page=='news' or $page=='jobs' or $page=='career' or $page=='contact' or $page=='enquiry' or $page=='dealer'  or $page=='resources' or $page=='dealership' or $page=='faq' or $page=='order' or $page=='service-request' or $page=='subscribe' or $page=='visitor')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-globe" style="font-size:14px;"></i>
									<span class="title">Website</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("slider",$feature) and check_page_permission('slider'))
									{
										?>
									<li class="nav-item <?php echo ($page=='slider')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Slider/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Slider</span>
										</a>
									</li>
									<?php 
									}if(check_feature("pcat",$feature) and check_page_permission('pcat'))
									{
										?>
									<li class="nav-item <?php echo ($page=='pcat')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Pcat/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Product Category</span>
										</a>
									</li>
									<?php 
									}if(check_feature("product",$feature) and check_page_permission('product'))
									{
										?>
									<li class="nav-item <?php echo ($page=='product')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Wproduct/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Product</span>
										</a>
									</li>
									<?php 
									}if(check_feature("solution",$feature) and check_page_permission('solution'))
									{
										?>
									<li class="nav-item <?php echo ($page=='solution')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Solution/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Solutions</span>
										</a>
									</li>
									<?php 
									}if(check_feature("blog",$feature) and check_page_permission('blog'))
									{
										?>
									<li class="nav-item <?php echo ($page=='blog')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Blog/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Blog</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("comment",$feature) and check_page_permission('blog'))
									{
										?>
									<li class="nav-item <?php echo ($page=='comment')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Comment/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Comment</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("news",$feature) and check_page_permission('news'))
									{
										?>
									<li class="nav-item <?php echo ($page=='news')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_News/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">News & Media</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("jobs",$feature) and check_page_permission('jobs'))
									{
										?>
									<li class="nav-item <?php echo ($page=='jobs')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Jobs/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Jobs</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("faq",$feature) and check_page_permission('faq'))
									{
										?>
									<li class="nav-item <?php echo ($page=='faq')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_FAQ/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">FAQ</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("resources",$feature) and check_page_permission('resources'))
									{
									?>
									<li class="nav-item <?php echo ($page=='resources')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add-Resources/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Resources</span>
										</a>
									</li>
									<?php 
									}if(check_feature("dealership",$feature) and check_page_permission('dealership'))
									{
									?>
									<li class="nav-item <?php echo ($page=='dealership')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All-Dealership/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Dealership</span>
										</a>
									</li>
									<?php 
									}if(check_feature("dealer",$feature) and check_page_permission('dealer'))
									{
									?>
									<li class="nav-item <?php echo ($page=='dealer')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Dealer/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Dealer</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("career",$feature) and check_page_permission('career'))
									{
									?>
									<li class="nav-item <?php echo ($page=='career')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Career/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Career</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("enquiry",$feature) and check_page_permission('enquiry'))
									{
									?>
									<li class="nav-item <?php echo ($page=='enquiry')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Enquiry/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Enquiry</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("service-request",$feature) and check_page_permission('service-request'))
									{
									?>
									<li class="nav-item <?php echo ($page=='service-request')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Service-request/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Service Request</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("order",$feature) and check_page_permission('order'))
									{
									?>
									<li class="nav-item <?php echo ($page=='order')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Order/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Product Order</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("contact",$feature) and check_page_permission('contact'))
									{
									?>
									<li class="nav-item <?php echo ($page=='contact')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Contact/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Contact</span>
										</a>
									</li>
									<?php 
									}if(check_feature("subscribe",$feature) and check_page_permission('subscribe'))
									{
									?>
									<li class="nav-item <?php echo ($page=='subscribe')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Subscribe/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Subscribe</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("visitor",$feature) and check_page_permission('visitor'))
									{
									?>
									<li class="nav-item <?php echo ($page=='visitor')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Visitor/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Visitors</span>
										</a>
									</li>
									<?php 
									}
									?>
									
								</ul>
							</li>
				<?php } if(check_module("complaint",$module)){ ?>
							<li class="nav-item <?php echo ($page=='newcmpl' or $page=='allcmpl')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-fire-extinguisher" style="font-size:14px;"></i>
									<span class="title">Complaint</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("newcmpl",$feature) and check_page_permission('newcmpl'))
									{
										?>
									<li class="nav-item <?php echo ($page=='newcmpl')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Complaint/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">New Complaints</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("allcmpl",$feature) and check_page_permission('allcmpl'))
									{
										?>
									<li class="nav-item <?php echo ($page=='allcmpl')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Complaint/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">All Complaints</span>
										</a>
									</li>
									<?php 
									}
									?>
									
								</ul>
							</li>
				<?php } if(check_module("warranty",$module)){ ?>
							<li class="nav-item <?php echo ($page=='allwarranty')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-calendar" style="font-size:14px;"></i>
									<span class="title">Warranty</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("allwarranty",$feature) and check_page_permission('allwarranty'))
									{
										?>
									<li class="nav-item <?php echo ($page=='allwarranty')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Warranty/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title"> Warranty</span>
										</a>
									</li>
									<?php 
									}
									
									
									?>
									
								</ul>
							</li>
				<?php } if(check_module("sales",$module)){ ?>
							<li class="nav-item <?php echo ($page=='newlead' or $page=='lead' or $page=='pending_lead')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-plus" style="font-size:14px;"></i>
									<span class="title">Sales</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("lead",$feature) and check_page_permission('lead'))
									{
										?>
										<li class="nav-item <?php echo ($page=='newlead')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Lead/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Add New Lead</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("lead",$feature) and check_page_permission('lead'))
									{
										?>
										<li class="nav-item <?php echo ($page=='lead')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Lead/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">All Lead List</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("lead",$feature) and check_page_permission('lead'))
									{
										?>
										<li class="nav-item <?php echo ($page=='pending_lead')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Pending_Lead/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">All Pending Lead </span>
										</a>
									</li>
									<?php 
									}
									?>
									
								</ul>
							</li>
				<?php } if(check_module("report",$module)){ ?>
							<li class="nav-item start ">
								<a href="<?php echo BASE_PATH;?>Report/" class="nav-link nav-toggle"> <i class="fa fa-file"></i>
									<span class="title">Report</span>
								</a>
							</li>							
				<?php } if(check_module("inventory",$module)){ ?>			
							<li class="nav-item <?php echo ($page=='category' or $page=='stkitem' or $page=='purchase' or $page=='party' or $page=='generate_serial' or $page=='unit' or $page=='billing')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-database" style="font-size:14px;"></i>
									<span class="title">Inventory </span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("billing",$feature) and check_page_permission('billing'))
									{
										?>
										<li class="nav-item <?php echo ($page=='billing')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Billing/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Item Billing</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("purchase",$feature) and check_page_permission('purchase'))
									{
										?>
										<li class="nav-item <?php echo ($page=='purchase')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Purchase/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Purchase Item</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("stkitem",$feature) and check_page_permission('stkitem'))
									{
										?>
										<li class="nav-item  <?php echo ($page=='stkitem')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Item/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Products </span>
									</a>
									</li>
									<?php 
									}
									
									if(check_feature("generate_serial",$feature) and check_page_permission('generate_serial'))
									{
										?>
										<li class="nav-item  <?php echo ($page=='generate_serial')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Serial/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Product Serial </span>
									</a>
									</li>
									<?php 
									}
									
									if(check_feature("party",$feature) and check_page_permission('party'))
									{
										?>
										<li class="nav-item  <?php echo ($page=='party')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Party/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Supplier Detail</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("category",$feature) and check_page_permission('category'))
									{
										?>
										<li class="nav-item <?php echo ($page=='category')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Category/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Category</span>
										</a>
									</li>
									<?php 
									}
									
									if(check_feature("unit",$feature) and check_page_permission('unit'))
									{
										?>
										<li class="nav-item  <?php echo ($page=='unit')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>Add_Unit/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Unit</span>
										</a>
									</li>
									<?php 
									}
									
									
									
									
									?>
									
								</ul>
							</li>
			<?php } if(check_module("work",$module)){ ?>				
							<li class="nav-item  <?php echo ($page=='job' or $page=='po')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="fa fa-plus" style="font-size:14px;"></i>
									<span class="title">Work</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 
									if(check_feature("job",$feature) and check_page_permission('job'))
									{
										?>
										<li class="nav-item <?php echo ($page=='job')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Job/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">All Job</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("po",$feature) and check_page_permission('po'))
									{
										?>
										<li class="nav-item <?php echo ($page=='po')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_PurchaseOrder/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Purchase Order</span>
										</a>
									</li>
									<?php 
									}
									?>
									
								</ul>
							</li>
			<?php } ?>			
							
							<!--<li class="nav-item <?php echo (check_module("hr_payroll",$module))?'':'hidden';?> <?php echo ($page=='staff' or $page=='department' or $page=='expenses' or $page=='designation')?'active':'';?>">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons f-left">account_circle</i>
									<span class="title">HR & Payroll</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<?php 								
									if(check_feature("department",$feature) and check_page_permission('department'))
									{
									?>
										<li class="nav-item <?php echo ($page=='department')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Department/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Department</span>
										</a>
									</li>
									
									<?php 
									}
									if(check_feature("designation",$feature) and check_page_permission('designation'))
									{
									?>
										<li class="nav-item <?php echo ($page=='designation')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Designation/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Designation</span>
										</a>
									</li>
									<?php 
									}
									if(check_feature("staff",$feature) and check_page_permission('staff'))
									{
									?>
										<li class="nav-item <?php echo ($page=='staff')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Staff/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Staff</span>
										</a>
									</li>
									<?php 
									}
											
									if(check_feature("expenses",$feature) and check_page_permission('expenses'))
									{
									?>
										<li class="nav-item <?php echo ($page=='expenses')?'active':'';?>">
										<a href="<?php echo BASE_PATH;?>All_Expenses/" class="nav-link "><i class="material-icons">keyboard_arrow_right</i> <span class="title">Expenses</span>
										</a>
									</li>
									
									<?php 
									}
									
									?>
									
								
									
								</ul>
							</li>-->
							<li class="nav-item start ">
								<a href="<?php echo BASE_PATH;?>Logout/" class="nav-link nav-toggle"> <i class="material-icons">exit_to_app</i>
									<span class="title">Logout</span>
								</a>
							</li>
							
							
					

					
							
					
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>