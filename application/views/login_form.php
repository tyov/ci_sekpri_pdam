<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/login/style.css"); ?>">  

</head>

<body class="easyui-layout" style="overflow-y: hidden;" scroll="no">
<div class="login-box">
			<div class="logo">
				<img src="<?php echo base_url('assets/login/logo_pdam2.png'); ?>" class="pdam">
			</div>
			<div class="box">
				<form>
					<div class="inputArea">
						<input type="text" class="inputText" id="nip" name="nip" placeholder="nip"/>
						<input type="password" class="inputText" id="passwd" name="passwd" placeholder="passwd"/>
					</div>
					<div class="buttonArea">
						<input id="btnLogin" type="button" value="LOGIN" class="inputButton"/>
					</div>
				</form>
			</div>
			<div class="footer">&copy; SIM PDAM Kota Malang</div>
			
		</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
	$('#nip').keydown(function (e){
		if(e.keyCode == 13){
			$('#passwd').focus();
		}
	});
	$('#passwd').keydown(function (e){
		if(e.keyCode == 13){
			$('#btnLogin').focus();
		}
	});
	$('#btnLogin').click(function(){
		// console.log('asdasd');
		var param ={action:'login',username:$('#nip').val(),password:$('#passwd').val()};
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/user_authentication/user_login_process",
			type: "POST",
			data: param,
			dataType: "json",
			beforeSend: function(){
				$.messager.progress({
					title:'Harap tunggu'
				});
			},
			success: function(response){ 
				console.log(response);
				
				if(response.error == "false")
				{
					$.messager.progress('close');
					window.location.href = "<?php echo base_url(); ?>index.php/index";
				}else if(response.error == "true"){
					$.messager.progress('close');
					$.messager.alert('',response.message,'info');
				}
				
			},
			error: function(){
				$.messager.progress('close');
				$.messager.alert('Telah terjadi error','Silakan hubungi admin','info');
			},
		});
	});
});
</script>
</html>