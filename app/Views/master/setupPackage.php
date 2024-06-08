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
				<div class="card">
					<!--begin::Card header-->
					<div class="card-header border-0 pt-6">
						<!--begin::Card title-->
						<div class="card-title">
							<div class="d-flex align-items-center position-relative my-1">
								<i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
								<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="ค้นหาผลิดภัณฑ์"/>
							</div>
						</div>
						<!--begin::Card title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
								<!--begin::Add user-->
								<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
										<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->เพิ่มผลิดภัณฑ์</button>
								<!--end::Add user-->
							</div>
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<div class="card-body py-4">
						<!--begin::Datatable-->
						<table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5">
							<thead>
							<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
								<th>ลำดับ</th>
								<th class="min-w-125px">รหัสผลิดภัณฑ์</th>
								<th class="min-w-125px">ชื่อผลิดภัณฑ์</th>
								<th>สถานะ</th>
								<th>RecordID</th>
								<!-- <th>กำหนดวันทำการ</th> -->
								<th class="text-end min-w-100px">ตัวเลือก</th>
							</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
							</tbody>
						</table>
						<!--end::Datatable-->
					</div>
				</div>
				
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Content wrapper-->
</div>
	<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header" id="kt_modal_add_user_header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">เพิ่มผลิดภัณฑ์</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-info" data-kt-users-modal-action="close">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
					<span class="svg-icon svg-icon-1">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				<!--begin::Form-->
				<form id="kt_modal_add_user_form" method="post" class="form" action="/savePackage" enctype="multipart/form-data">
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
						<!--begin::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="d-block fw-semibold fs-6 mb-5">รูปผลิดภัณฑ์</label>
							<!--end::Label-->
							<!--begin::Image placeholder-->
							<style>.image-input-placeholder { background-image: url('<?php echo base_url();?>theme/dist/assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('<?php echo base_url();?>theme/dist/assets/media/svg/files/blank-image-dark.svg'); }</style>
							<!--end::Image placeholder-->
							<!--begin::Image input-->
							<div class="image-input image-input-outline image-input-placeholder ps-10" data-kt-image-input="true">
								<!--begin::Preview existing avatar-->
								<div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo base_url();?>theme/dist/assets/media/svg/files/blank-image.svg);"></div>
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
						<!--end::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">รหัสผลิดภัณฑ์</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" name="packagecode" id="pcode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="รหัสผลิดภัณฑ์" value="" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">ชื่อผลิดภัณฑ์</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" name="packagename" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ชื่อผลิดภัณฑ์" value="" />
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<label class="col-lg-12 col-form-label fw-semibold fs-6">
								<span class="required">Upload Files:</span>
								<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Attachment"></i>
							</label>
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
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">สถานะ</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select class="form-select min-w-100px" name="packagestatus" data-control="select2" data-hide-search="true" data-placeholder="สถานะ">
								<option value="active" selected>ใช้งาน</option>
								<option value="inactive">ไม่ใช่งาน</option>
							</select>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Scroll-->
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">ยกเลิก</button>
						<button type="submit" class="btn btn-info" data-kt-users-modal-action="submit">
							<span class="indicator-label">บันทึก</span>
							<span class="indicator-progress">กรุณารอ...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->

<!--begin::Modal-->
<div id="kt_datatable_modal" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<div class="modal-content" style="min-height: 590px;">
			<div class="modal-header py-5">
				<h5 class="modal-title">กำหนดวันทำการ
				 <span class="d-block text-muted font-size-sm" id="subproject"></span></h5>
				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
					<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
				</div>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<!--begin::Datatable-->
					<div id="load_subproject"></div>
					<!--end::Datatable-->
				</div>
			</div>
			<div class="modal-footer">
				<button hidden type="button" class="btn btn-light-primary font-weight-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
					<i class="ki-duotone ki-plus"></i>
					Add Sub Project
				</button>
				<button type="button" class="btn btn-light font-weight-bold" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->

<script src="<?php echo base_url();?>theme/src/js/custom/apps/user-management/users/list/add.js"></script>
<script>var HOST_URL = "<?php echo base_url();?>";</script>

<script>
	"use strict";

	// Class definition
	var KTDatatablesServerSide = function () {
		// Shared variables
		var table;
		var dt;
		var filterPayment;

		// Private functions
		var initDatatable = function () {
			dt = $("#kt_datatable_example_1").DataTable({
				searchDelay: 500,
				processing: true,
				serverSide: false,
				order: [[0, 'asc']],
				stateSave: true,  
				ajax: {
					url: HOST_URL + "jsondata/getAllPackage",
					type: 'POST',
					// url: "https://preview.keenthemes.com/api/datatables.php",
				},
				columns: [
					{ data: null },
					{ data: 'pcode'},
					{ data: 'pname'},
					{ data: 'pstatus'},
					{ data: 'RecordID'},
					// { data: null },
					// { data: 'create_date' },
					{ data: null },
				],
				columnDefs: [
					{
						targets: 0,
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						}
					},
					{
						targets: 2,
						className: 'd-flex align-items-center',
						render: function (data, type, row) {
							return `
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="#">
										<div class="symbol-label">
											<img src="${HOST_URL}profile/${row.image}" alt="${row.image}" class="w-100" />
										</div>
									</a>
								</div>
								<div class="d-flex flex-column">
									<a href="#" class="text-gray-800 text-hover-info mb-1">${row.pname}</a>
								</div>`;
						}
					},
					{
						targets: 3,
						render: function (data, type, row) {
							// console.log(data.charAt(0).toUpperCase()+data.slice(1));
							// console.log(row.customer_tag);
							if (row.pstatus == "active") {
								// return `<span class="badge badge-success badge-lg">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
								return `<span class="badge badge-success badge-lg">ใช้งาน</span>`;
							} else {
								// return `<span class="badge badge-danger badge-lg">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
								return `<span class="badge badge-danger badge-lg">ไม่ใ้งาน</span>`;
							}
						}
					},
					{
						targets: 4,
						visible: false,
						searchable: true
					},
					// {
					// 	targets: 5,
					// 	data: null,
					// 	orderable: false,
					// 	className: 'text-center',
					// 	render: function (data, type, row) {
					// 		return `
					// 			<a href="#" data-package-id="${row.RecordID}" data-package-code="${row.pcode}" data-package-name="${row.pname}" class="btn btn-link btn-color-info btn-active-color-primary me-5 mb-2">กำหนด</a>
					// 		`
					// 	}
					// },
					{
						targets: -1,
						data: null,
						orderable: false,
						className: 'text-end',
						render: function (data, type, row) {
							// console.log(data);
							return `
								<a href="#" class="btn btn-light btn-active-light-info btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
									ตัวเลือก
									<span class="svg-icon fs-5 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24"></polygon>
												<path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
											</g>
										</svg>
									</span>
								</a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-info fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="/editPackage/${row.RecordID}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
											แก้ไข
										</a>
									</div>
									<!--end::Menu item-->

									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="/delPackage/${row.RecordID}" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
											ลบ
										</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							`;
						},
					},
				],
				// Add data-filter attribute
				createdRow: function (row, data, dataIndex) {
					$(row).find('td:eq(4)').attr('data-filter', data.customer_tag);
				}
			});

			table = dt.$;

			// Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
			dt.on('draw', function () {
				handleDeleteRows();
				KTMenu.createInstances();
			});
			
			dt.on('click', '[data-package-id]', function() {
				$("#subproject").html($(this).data('package-name'));
				handlePackageLoad($(this).data('package-code'));
				$('#kt_datatable_modal').modal('show');
			});
		}

		// Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
		var handleSearchDatatable = function () {
			
			const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
			filterSearch.addEventListener('keyup', function (e) {
				dt.search(e.target.value,true).draw();
			});
		}

		// Delete customer
		var handleDeleteRows = () => {
			// Select all delete buttons
			const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');

			deleteButtons.forEach(d => {
				// Delete button on click
				d.addEventListener('click', function (e) {
					e.preventDefault();

					// Select parent row
					const parent = e.target.closest('tr');

					// Get customer name
					const pname = parent.querySelectorAll('td')[2].innerText;
					const code = parent.querySelectorAll('td')[1].innerText;
					console.log(parent.querySelectorAll('td')[1].innerText);

					// SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
					Swal.fire({
						text: "Are you sure you want to delete " + pname + "?",
						icon: "warning",
						showCancelButton: true,
						buttonsStyling: false,
						confirmButtonText: "Yes, delete!",
						cancelButtonText: "No, cancel",
						customClass: {
							confirmButton: "btn fw-bold btn-danger",
							cancelButton: "btn fw-bold btn-active-light-info"
						}
					}).then(function (result) {
						if (result.value) {
							$.ajax({
								url: '<?php echo base_url(); ?>delPackage',
								type: 'POST',
								data: {
									'id': code,
								},
								success: function(result) {
									var json = result;
									console.log(json);
									// toastr.success(json.message);
								}
							});
							// Simulate delete request -- for demo purpose only
							Swal.fire({
								text: "Deleting " + pname,
								icon: "info",
								buttonsStyling: false,
								showConfirmButton: false,
								timer: 2000
							}).then(function () {
								Swal.fire({
									text: "You have deleted " + pname + "!.",
									icon: "success",
									buttonsStyling: false,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn fw-bold btn-info",
									}
								}).then(function () {
									dt.draw();
									window.location="/package";
								});
							});
						} else if (result.dismiss === 'cancel') {
							Swal.fire({
								text: customerName + " was not deleted.",
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn fw-bold btn-info",
								}
							});
						}
					});
				})
			});
		}
		
		var handlePackageLoad = (packagecode) => {
			$('#load_subproject').load('/loadPackageSetTime/'+packagecode);
		}

		// Public methods
		return {
			init: function () {
				initDatatable();
				handleSearchDatatable();
				handleDeleteRows();
			}
		}
	}();

	// On document ready
	KTUtil.onDOMContentLoaded(function () {
		KTDatatablesServerSide.init();
	});
</script>
<script>
	$("#tab_business").addClass('active');
	$("#kt_app_sidebar_secondary_environment").addClass('show active');
	
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