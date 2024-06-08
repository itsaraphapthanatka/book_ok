<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Line Alert</title>
    <link href="<?php echo base_url();?>theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    
    <link href="<?php echo base_url();?>theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>theme/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <!--end::Layout Themes-->
</head>
<body>

<script src="<?php echo base_url();?>theme/dist/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo base_url();?>theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?php echo base_url();?>theme/dist/assets/js/scripts.bundle.js"></script>
<script>

Swal.fire({
    position: "center",
    icon: "success",
    title: "<?php echo $customername;?>",
    text: "Your work has been Send",
    showConfirmButton: false,
    // timer: 3000
});
// console.log(liff.isInClient());
liff.closeWindow();

</script>
</body>
</html>
