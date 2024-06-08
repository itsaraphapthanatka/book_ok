<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<!--begin::Content wrapper-->
	<div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar py-4 py-lg-8">
			<!--begin::Toolbar container-->
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
				<!--begin::Toolbar wrapper-->
				<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
					<!--begin::Page title-->
					<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
						<!--begin::Title-->
						<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"></h1>
						<!--end::Title-->
					</div>
					<!--end::Page title-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Toolbar container-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-fluid">
				<!--begin::Basic info-->
				<div class="card mb-5 mb-xl-10">
					<!--begin::Card header-->
					<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
						<!--begin::Card title-->
						<div class="card-title m-0">
							<h3 class="fw-bold m-0">ข้อมูลผลิตภัณฑ์</h3>
						</div>
						<!--end::Card title-->
					</div>
					<!--begin::Card header-->
					<!--begin::Content-->
					<div id="kt_account_settings_profile_details" class="collapse show">
						<!--begin::Form-->
						<form id="kt_account_profile_details_form" method="post" action="/updatePackage" enctype="multipart/form-data" class="form">
							<!--begin::Card body-->
							<div class="card-body border-top p-9">
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label fw-semibold fs-6">รูปผลิตภัณฑ์</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Image input-->
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
											<!--begin::Preview existing avatar-->
											<div class="image-input-wrapper w-125px h-125px" style="background-image: url(/profile/<?= $res['image'];?>)"></div>
											<!--end::Preview existing avatar-->
											<!--begin::Label-->
											<label class="btn btn-icon btn-circle btn-active-color-info w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7"></i>
												<!--begin::Inputs-->
												<input type="file" name="userfile" accept=".png, .jpg, .jpeg" />
												<input type="hidden" name="avatar_remove" />
												<!--end::Inputs-->
											</label>
											<!--end::Label-->
											<!--begin::Cancel-->
											<span class="btn btn-icon btn-circle btn-active-color-info w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Cancel-->
											<!--begin::Remove-->
											<span class="btn btn-icon btn-circle btn-active-color-info w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Remove-->
										</div>
										<!--end::Image input-->
										<!--begin::Hint-->
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
										<!--end::Hint-->
									</div>
									<!--end::Col-->
								</div>
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label required fw-semibold fs-6">รหัสผลิตภัณฑ์</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Row-->
										<div class="row">
											<!--begin::Col-->
											<div class="col-lg-12 fv-row">
												<input type="text" name="pcode" id="pcode" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="<?=$res['pcode'];?>" />
												<input type="hidden" name="pid" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="<?=$res['id'];?>" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label required fw-semibold fs-6">ขื่อผลิตภัณฑ์</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Row-->
										<div class="row">
											<!--begin::Col-->
											<div class="col-lg-12 fv-row">
												<input type="text" name="pname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="<?=$res['pname'];?>" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label fw-semibold fs-6">
										<span class="required">สถานะ</span>
										<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
									</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8 fv-row">
										<select class="form-select form-select-lg form-select-solid" name="pstatus" data-control="select2" data-placeholder="Select an option">
											<?php if($res['pstatus'] == 'active'){ ?><option value="active" selected>ใช้งาน</option><?php } else { ?><option value="active">ใช้งาน</option><?php }?>
											<?php if($res['pstatus'] == 'inactive'){ ?><option value="inactive" selected>ไม่ใช้งาน</option><?php } else { ?><option value="inactive">ไม่ใช้งาน</option><?php }?>
										</select>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group--><!--begin::Col-->
								<div class="row mb-6">
									<label class="col-lg-4 col-form-label fw-semibold fs-6">
										<span class="required">Upload Files:</span>
										<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
									</label>
									<!--begin::Dropzone-->
									<div class="col-lg-8 fv-row">
										<!--begin::Input group-->
										<div class="fv-row">
											<!--begin::Dropzone-->
											<div class="dropzone" id="kt_dropzonejs_example_1">
												<!--begin::Message-->
												<div class="dz-message needsclick">
													<i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>
									
													<!--begin::Info-->
													<div class="ms-4">
														<h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
														<span class="fs-7 fw-semibold text-gray-500">Upload up to 1 files</span>
													</div>
													<!--end::Info-->
												</div>
											</div>
											<!--end::Dropzone-->
											<input type="hidden" id="fakename" name="fakename">
											<div id="imgload">
											</div>
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Dropzone-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Card body-->
							<!--begin::Actions-->
							<div class="card-footer d-flex justify-content-end py-6 px-9">
								<a href="/package" class="btn btn-light btn-active-light-info me-2">ยกเลิก</a>
								<button type="submit" class="btn btn-info" id="kt_account_profile_details_submit">บันทึก</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Basic info-->
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Content wrapper-->
</div>

<script>
	$("#tab_book").addClass('active');
	$("#kt_app_sidebar_secondary_customer").addClass('show active');
	$("#imgload").load("<?php echo base_url(); ?>loadFilePackage/"+$("#pcode").val());
	var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
		url: "<?php echo base_url();?>uploadFilePackage", // Set the url for your upload script location
		paramName: "file", // The name that will be used to transfer the file
		acceptedFiles: "image/*",
		init: function() {
			this.on("sending", function(file, xhr, formData){
					formData.append("data", $("#fakename").val());
					formData.append("pcode", $("#pcode").val());
					// console.log(formData)
			});
		},
		maxFiles: 1,
		maxFilesize: 10, // MB
		addRemoveLinks: true,
		accept: function(file, done) {
			if (file.name == "wow.jpg") {
				done("Naha, you don't.");
			} else {
				done();
				$("#fakename").val(Math.random().toString(36).slice(2, 7));
				console.log(file);
				// $("#imgload").load("<?php echo base_url(); ?>loadFilePackage/"+$("#pcode").val());
			}
		}
	});
</script>