<!DOCTYPE HTML>
<html lang="eng">

	<?php $this->load->view('head'); ?>

	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
	
	<?php $this->load->view('header');	?>
		
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-size: 100% 100%; background-image: url(<?=base_url();?>dist/images/home/back1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/home/back2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(<?=base_url();?>dist/images/home/back3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-8 col-sm-12 col-md-offset-0 slider-text">
				   			</div>
				   		</div>
			   		</div>
			   	</li>	
			  	</ul>
		  	</div>
		</aside>
		
		<div id="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-md-4 intro-wrap">
						<div class="intro-flex">
							<div class="one-third color-1 animate-box">
								<span class="icon"><i class="fa fa-file-alt"></i></span>
								<div class="desc">
									<h3>Our Projects</h3>
									<p><a href="<?=base_url();?>index.php/Ctrl_projects" class="view-more">View More</a></p>
								</div>
							</div>
							<div class="one-third color-2 animate-box">
								<span class="icon"><i class="fa fa-calendar-check"></i></span>
								<div class="desc">
									<h3>Our Events</h3>
									<p><a href="<?=base_url();?>index.php/Ctrl_events" class="view-more">View More</a></p>
								</div>
							</div>
							<div class="one-third color-3 animate-box">
								<span class="icon"><i class="fa fa-handshake"></i></span>
								<div class="desc">
									<h3>Our MoUs</h3>
									<p><a href="<?=base_url();?>index.php/Ctrl_mous" class="view-more">View More</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="about-desc animate-box">
							<h2>Welcome to Research Cell</h2>
							<p style="text-align:justify">SAKEC Research Cell strives towards the Vision and Mission of our institute.
							We at SAKEC have been undertaking consistent efforts to align our R&D activities to achieve technological competence and professional standards.
							The faculty and students undertake research projects in thriving areas of science, engineering, management and technology. Many of our projects offer opportunities in fundamental research that are focused to tackle live problems. The projects under the banner of SAKEC Research Cell work for the benefit of industry and society.
							We have established partnerships & are looking forward towards more such collaborations with some NGOs, Universities and Industries.</p>
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>Role & Responsibilities of the Research Cell:</strong></a></h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-6">
														<ul>
															<li style="text-align:justify;">To encourage multi-disciplinary research, internally within the institute and externally, with other organizations.</li>
															<li style="text-align:justify;">To encourage interaction with industry and NGO’s working for societal benefits.</li>
														</ul>
													</div>
													<div class="col-md-6">
														<ul>
															<li style="text-align:justify;">Review and recommend the project proposals and assist them to agencies for financial support.</li>
															<li style="text-align:justify;">To encourage students and faculties to form research/innovation councils that will work under guidance of technical professionals and financial experts for delivery of a product.</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<div id="colorlib-intro">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="background-color: black; height:1px;">
			</div>
		</div>
	</div>
</div>

<div id="colorlib-counter" class="colorlib-counters" style="background-image: url(<?=base_url();?>dist/images/home/back1.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-handshake"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$mous_count;?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">MoUs</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-file-alt"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$projects_count;?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Projects</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-calendar-check"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$events_count;?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Events</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 animate-box">
								<div class="counter-entry">
									<span class="icon"><i class="fa fa-users"></i></span>
									<div class="desc">
										<span class="colorlib-counter js-counter" data-from="0" data-to="<?=$intern_count;?>" data-speed="2500" data-refresh-interval="50"></span>
										<span class="colorlib-counter-label">Total Interns</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		<div class="colorlib-classes colorlib-light-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Our Latest Projects</h2>
						<p>List of different projects that were successfully conducted under our banner.</p>
					</div>
				</div>
				<div class="row">
				<?php foreach($projects as $id => $data){ ?>
					<div class="col-md-4 animate-box">
						<article class="article-entry" style="border: 1px solid black;border-radius: 15px;">
							<a class="blog-img" style="border-bottom: 1px solid black;background-image: url(<?=base_url();?>illustrations/projects/<?=$data->image;?>);background-size: contain;" href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>">
							</a>
							<div class="desc">
								<h2><a href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>"><?=substr($data->title, 0, 27);?><?php if(strlen($data->title) >= 27){ echo '...'; }?></a></h2>
								<p><?=substr(strip_tags(html_entity_decode($data->overview)), 0, 100);?>...</p>
								<p><a href="<?=base_url();?>index.php/Ctrl_projects/project/<?=$data->id;?>" class="btn-learn">Learn More <i class="icon-arrow-right3"></i></a></p>
							</div>
						</article>
					</div>
				<?php } ?>
				</div>
			</div>	
		</div>

		<div id="colorlib-testimony" class="testimony-img" style="background-image: url(<?=base_url();?>dist/images/home/classes-7.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>What Do The Students Say</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="row animate-box">
							<div class="owl-carousel1">
								<div class="item">
									<div class="testimony-slide">
										<div class="testimony-wrap">
											<blockquote>
												<span>Viraj Modi</span>
												<p>Under the guidance of Research Cell, I got an opportunity to climb the social ladder and work for IDF. This was the first time when I was working for a live project and also doing it for a social cause. The journey was indeed tough but yet it is a memorable experience.</p>
											</blockquote>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide">
										<div class="testimony-wrap">
											<blockquote>
												<span>Nikhil Shetty</span>
												<p>Under the guidance of Research Cell, I got an opportunity to work on a live project and put my knowledge for the social cause. I thank the Research Cell for providing this opportunity to work with Indian Development Foundation (IDF) and guiding us to achieve success.</p>
											</blockquote>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide">
										<div class="testimony-wrap">
											<blockquote>
												<span>Ansh Ved</span>
												<p>Research Cell gave me the opportunity to develop the Speed Ambulance App for IDF. This project taught me the challenges faced for a social cause and also a real time project.</p>
											</blockquote>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-trainers">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Research Cell Members</h2>
						<p>Our powerful and extremely experienced team of professors, comes together to make the Research Cell more successful and reach greater heights</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/31.jpg"></img>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/32.jpg"></img>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/33.jpg"></img>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
				<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/34.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/35.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/36.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/37.jpg"></img>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
				<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/38.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/39.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/40.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/41.jpg"></img>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
				<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/42.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/43.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/44.jpg"></img>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" style="width: 80%;height: 50%"
                                 src="<?= base_url(); ?>dist/images/members/45.jpg"></img>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--Council members-->
<div class="colorlib-trainers">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Council Members</h2>
						<p>Our council students who come together to put their efforts in making the cell successful.Here are our Council Members</p>
					</div>
				</div>
				<div class="row">
				<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img" 
                                 src="<?= base_url(); ?>dist/images/c_members/1.jpg"></img>
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
					<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/2.jpg"></img>
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/3.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/4.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/5.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/6.jpg"></img>
						
						</div>
					</div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/7.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/8.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/9.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/10.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/11.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/12.jpg"></img>
						
						</div>
					</div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/13.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/14.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/15.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/16.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/17.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/18.jpg"></img>
						
						</div>
					</div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/19.jpg"></img>
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/20.jpg"></img>
					
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/21.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/22.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/23.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/24.jpg"></img>
							
						</div>
					</div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/25.jpg"></img>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-2 animate-box">
						<div class="trainers-entry">
                            <img class="trainer-img"
                                 src="<?= base_url(); ?>dist/images/c_members/26.jpg"></img>
						
						</div>
					</div>
				
					</div>


	</div>
</div>
<!--end of council members-->
<div class="colorlib-trainers">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Web Masters</h2>
						<p>The designers and developers of this website.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <div class="trainer-img"
                                 style="background-image: url(<?= base_url(); ?>dist/images/web_masters/1.jpg)"></div>
							<div class="desc" style="text-align:left;">
								<h3>Mr.Sneh Jain</h3>
								<p style="color:white;">sneh.jain@sakec.ac.in</p>
								
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <div class="trainer-img"
                                 style="background-image: url(<?= base_url(); ?>dist/images/web_masters/2.jpg)"></div>
							<div class="desc" style="text-align:left;">
								<h3>Ms.Disha Dahake</h3>
								<p style="color:white;">disha.dahake@sakec.ac.in</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="trainers-entry">
                            <div class="trainer-img"
                                 style="background-image: url(<?= base_url(); ?>dist/images/web_masters/3.jpg)"></div>
							<div class="desc" style="text-align:left;">
								<h3>Mr.Pundrik Mishra</h3>
								<p style="color:white;">pundrik.mishra@sakec.ac.in</p>
							</div>
						</div>
					</div>
</div>
</div>



	<!--webmaster end-->
		<div id="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="background-color: black; height:1px;">
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-event">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Our Events</h2>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name</p>
					</div>
				</div>
				<div class="event-flex row-pb-sm">
                    <div class="half event-img animate-box"
                         style="  border:5px solid black; background-image: url(<?= base_url(); ?>dist/images/home/done.jpg);">
					</div>
					<div class="half">
						<div class="row">
							<?php foreach($latevents as $id => $data){ ?>
								<div class="col-md-12 animate-box">
									<div class="event-entry">
										<div class="desc">
											<p class="meta"><span class="day"><?=date("d", strtotime($data->date));?></span><span class="month"><?=date("M", strtotime($data->date));?></span></p>
											<h2><a href="<?=base_url();?>index.php/Ctrl_events/event/<?=$data->id;?>"><?=$data->name;?></a></h2>
										</div>
										<div class="location">
											<span class="icon"><i class="icon-map"></i></span>
											<p><?=substr(strip_tags(html_entity_decode($data->details)), 0, 100);?>...</p>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('footer');?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	<?php $this->load->view('scripts');?>
	<script>
	$("#pagetitle").html("Research Cell | Home");
	$(".treeview").removeClass('active');
    $(".treeview").eq(0).addClass('active');
	</script>
	</body>
</html>

