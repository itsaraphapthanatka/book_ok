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
                            <h3 class="fw-bold m-0">ข้อมูลธุรกิจ</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">ประเภทธุรกิจ:</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="companytype" class="companytype form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ประเภทธุรกิจ" value="<?=$company['compant_type'];?>" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">จดภาษีมูลค่าเพิ่ม:</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="จดภาษีมูลค่าเพิ่ม"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="taxid" class="taxid form-control form-control-lg form-control-solid" placeholder="จดภาษีมูลค่าเพิ่ม" value="<?=$company['taxid'];?>" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="separator separator-dashed my-6"></div>
                                <div class="fs-3 fw-bold text-dark">รายละเอียดธุรกิจ</div>
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">ข้อมูลใช้สำหรับการออกเอกสาร </p>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">ชื่อธุรกิจ:</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="ชื่อธุรกิจ"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="companyname" class="companyname form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="ประเภทธุรกิจ" value="<?=$company['company_name'];?>" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">ที่อยู่:</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="ที่อยู่"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="addr" class="addr form-control form-control-lg form-control-solid" placeholder="ที่อยู่" value="<?=$company['addr'];?>" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">เลขประจำตัวผู้เสียภาษี:</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="เลขประจำตัวผู้เสียภาษี:"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="tel" name="CompanyTaxId" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" class="CompanyTaxId form-control form-control-lg form-control-solid" placeholder="เลขประจำตัวผู้เสียภาษี" value="<?=$company['CompanyTaxId'];?>" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-info me-2">ยกเลิก</button>
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
    $("#tab_business").addClass('active');
    $("#kt_app_sidebar_secondary_environment").addClass('show active');
    "use strict";
    
    // Class definition
    var KTAccountSettingsProfileDetails = function () {
        // Private variables
        var form;
        var submitButton;
        var validation;
    
        // Private functions
        var initValidation = function () {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validation = FormValidation.formValidation(
                form,
                {
                    fields: {
                        companytype: {
                            validators: {
                                notEmpty: {
                                    message: 'Company Type is required'
                                }
                            }
                        },
                        taxid: {
                            validators: {
                                notEmpty: {
                                    message: 'TAX ID is required'
                                }
                            }
                        },
                        companyname: {
                            validators: {
                                notEmpty: {
                                    message: 'Company name is required'
                                }
                            }
                        },
                        addr: {
                            validators: {
                                notEmpty: {
                                    message: 'Company Address is required'
                                }
                            }
                        },
                        CompanyTaxId: {
                            validators: {
                                notEmpty: {
                                    message: 'Company Tax ID is required'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );
    
            // Select2 validation integration
            $(form.querySelector('[name="country"]')).on('change', function() {
                // Revalidate the color field when an option is chosen
                validation.revalidateField('country');
            });
    
            $(form.querySelector('[name="language"]')).on('change', function() {
                // Revalidate the color field when an option is chosen
                validation.revalidateField('language');
            });
    
            $(form.querySelector('[name="timezone"]')).on('change', function() {
                // Revalidate the color field when an option is chosen
                validation.revalidateField('timezone');
            });
        }
    
        var handleForm = function () {
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();
    
                validation.validate().then(function (status) {
                    if (status == 'Valid') {
                        const companytype = $(".companytype").val();
                        const taxid = $(".taxid").val();
                        const companyname = $(".companyname").val();
                        const addr = $(".addr").val();
                        const CompanyTaxId = $(".CompanyTaxId").val();
                        $.ajax({
                            url: '<?php echo base_url(); ?>saveCompany',
                            type: 'POST',
                            data: {'companytype': companytype , 'taxid': taxid,'companyname': companyname, 'addr': addr, 'CompanyTaxId': CompanyTaxId },
                            success: function(data) {
                                var json = data;
                                console.log(json);
                                toastr.success(data.message);
                                swal.fire({
                                    text: "Thank you! You've updated your basic info",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-light-primary"
                                    }
                                });
                            }
                        });
                       
                    } else {
                        swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-light-primary"
                            }
                        });
                    }
                });
            });
        }
    
        // Public methods
        return {
            init: function () {
                form = document.getElementById('kt_account_profile_details_form');
                
                if (!form) {
                    return;
                }
    
                submitButton = form.querySelector('#kt_account_profile_details_submit');
    
                initValidation();
                handleForm();
            }
        }
    }();
    
    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTAccountSettingsProfileDetails.init();
    });

</script>
