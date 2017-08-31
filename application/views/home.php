<!DOCTYPE html>
<html>
<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
    } else {
        redirect('index.php/user_authentication', 'refresh');
    }
?>
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>SEKPRI PDAM</title>
    <script type="text/javascript"> 
            var base_url = "<?php echo base_url(); ?>";  
        </script>
    <link rel="shortcut icon" href="<?php echo base_url("image/favicon.ico"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/themes/metro-blue/easyui.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/themes/icon.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/themes/color.css"); ?>">
    <script type="text/javascript" src="<?php echo base_url("assets/jeasyui/jquery.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/jeasyui/jquery.easyui.min.js"); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/fonts/stylesheet.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/fonts/font-awesome/css/font-awesome.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/jeasyui/custom.css"); ?>">   
</head>

<body class="easyui-layout" style="overflow-y: hidden;" scroll="no">
     <div data-options="region:'north',border:false" style="height:50px;background:#a1caf4;padding:10px; background-image:url(<?php echo base_url('image/banner.png');?>); background-repeat:no-repeat; background-position:center left;">
         <a href="user_authentication/logout" class="btn btn-info" role="button" style="float: right;">Logout</a>

     </div>
    <div data-options="region:'center'" id="center-content" style="background:#eee; overflow: hidden;">
        <div id='content_tab' class="easyui-tabs isinya" border='false' fit="true" cache='false'>
            <div id='isi_content' title="Dashboard" style='overflow:hidden'>
            <?php include('dashboard.php') ?>
            </div>
        </div>
    </div>
    <div data-options="region:'west',title:'Menu',collapsible:true" style="width:200px;">
        <?php include('common/sidebar_menu.php') ?>
    </div>
    <div data-options="region:'south',border:false" style="background:#2980b9; color:#ecf0f1; padding:10px; text-align:center; overflow: hidden;">SIM PDAM Kota Malang</div>

   
</body>
<script type="text/javascript">

</script> 
</html>