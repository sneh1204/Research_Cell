<footer id="colorlib-footer">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-3 colorlib-widget">
						<h4>About Research Cell</h4>
						<p style="text-align:justify;">The projects under the banner of SAKEC Research Cell work for the benefit of industry and society.
                We have established partnerships & are looking forward towards more such collaborations with some NGOs, Universities and Industries.
            </p>
						
					</div>
					<div class="col-md-3 colorlib-widget">
						<h4>Quick Links</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="<?=base_url();?>"><i class="fa fa-check"></i> Home</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_projects"><i class="fa fa-check"></i> Projects / Internships</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_events"><i class="fa fa-check"></i> Events</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_mous"><i class="fa fa-check"></i> MoUs</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_pgrants"><i class="fa fa-check"></i> Grants</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_testimonials"><i class="fa fa-check"></i> Testimonials</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_twork"><i class="fa fa-check"></i> Publications</a></li>
								<li><a href="<?=base_url();?>index.php/Ctrl_contact"><i class="fa fa-check"></i> Contact</a></li>
								<li><a href="http://www.shahandanchor.com" target="__blank"><i class="fa fa-check"></i> SAKEC Home</a></li>
							</ul>
                    </p>
					</div>

					<div class="col-md-3 colorlib-widget">
						<h4>Latest Events:</h4>
						<?php foreach($latevents as $id => $data){ ?>
							<div class="f-blog" style="padding-left: 0px;">
								<div class="desc">
									<h2 style="text-align: left"><a href="<?=base_url();?>index.php/Ctrl_events/event/<?=$data->id;?>"><?=$data->name;?></a></h2>
									<p class="admin"><span><?=date("d M, Y", strtotime($data->date));?></span></p>
								</div>
							</div>
						<?php } ?>
						</div>
					<div class="col-md-3 colorlib-widget">
						<h4>Contact Info</h4>
						<ul class="colorlib-footer-links">
							<li>1. Dr. Nilakshi Jain </li>
							<li><i class="fa fa-phone-square "></i> 022-25580854 Ext. 406</a></li>
						</ul><br>
						<ul class="colorlib-footer-links">
							<li>2. Dr. Kranti Ghag </li>
							<li><i class="fa fa-phone-square "></i> 022-25580854 Ext. 501</a></li><br>
							<li><i class=" fa fa-link "></i> research@sakec.ac.in</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<small class="block">&copy;
                Copyright &copy; <span id='date'></span> All rights reserved | <a href="<?=base_url();?>"><strong>Research Cell SAKEC</strong></a>
                </small><br>
								<small>Developed by Sneh, Disha and Pundrik.</small>
              </p>
              <script>document.getElementById('date').innerHTML = new Date().getFullYear();</script>
						</div>
					</div>
				</div>
			</div>
</footer>