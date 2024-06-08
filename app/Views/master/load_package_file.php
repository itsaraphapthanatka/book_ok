
<div class="row">
	<?php foreach($getFile as $value){ ?>
	 	<?php if(preg_match("/\.(gif|png|jpg|jpeg)$/", $value['package_img'])) { ?>
			<!-- <div class='symbol symbol-150 mr-6'><img alt='Pic' src='<?php echo base_url();?>uploads/<?=$value['package_img'];?>'></div> -->
		<!--begin::Row-->
			<!--begin::Col-->
			<div class="col-md-3">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body d-flex justify-content-center text-center flex-column p-8">
						<!--begin::Name-->
						<a href="<?php echo base_url();?>uploads/<?=$value['package_img'];?>" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
							<!--begin::Image-->
							<div class="symbol symbol-150px mb-5">
								<img src="<?php echo base_url();?>uploads/<?=$value['package_img'];?>" class="theme-light-show" alt="" />
								<img src="<?php echo base_url();?>uploads/<?=$value['package_img'];?>" class="theme-dark-show" alt="" />
							</div>
							<!--end::Image-->
							<!--begin::Title-->
							<div class="fs-5 fw-bold mb-2"><?= pathinfo($value['original_name'], PATHINFO_FILENAME);?></div>
							<!--end::Title-->
						</a>
						<!--end::Name-->
						<a href="<?php echo base_url();?>deleteFile/<?=$value['id'];?>/<?=$pid['id'];?>" class="btn btn-danger btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"><i class="lar la-trash-alt fs-2 me-2"></i> Delete</a>
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Col-->
		<!--end:Row-->
		<?php } else{ ?>
			<!-- <div class='symbol symbol-150 mr-6'><a href='<?php echo base_url();?>upload/<?=$value['package_img'];?>'><i class='la la-file-pdf icon-6x'></i></a></div> -->
		<div class="col-md-3">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body d-flex justify-content-center text-center flex-column p-8">
					<!--begin::Name-->
					<a href="<?php echo base_url();?>uploads/<?=$value['package_img'];?>" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
						<!--begin::Image-->
						<div class="symbol symbol-150px mb-5">
							<img src="<?php echo base_url();?>theme/dist/assets/media/svg/files/pdf.svg" class="theme-light-show" alt="" />
							<img src="<?php echo base_url();?>theme/dist/assets/media/svg/files/pdf-dark.svg" class="theme-dark-show" alt="" />
						</div>
						<!--end::Image-->
						<!--begin::Title-->
						<div class="fs-5 fw-bold mb-2"><?= pathinfo($value['original_name'], PATHINFO_FILENAME);?></div>
						<!--end::Title-->
					</a>
					<!--end::Name-->
					<a href="<?php echo base_url();?>deleteFile/<?=$value['id'];?>/<?=$pid['id'];?>" class="btn btn-danger btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"><i class="lar la-trash-alt fs-2 me-2"></i> Delete</a>
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<?php } ?>
	<?php } ?>
</div>