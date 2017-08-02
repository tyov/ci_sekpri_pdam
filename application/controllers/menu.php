<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo " ";
	}
	public function getData()
	{
		$menu ='[{
				    "id":1,
				    "text":"Master Data",
				    "iconCls":"icon-save",
				    "children":[{
				    	"id":"11",
				        "text":"Master Status",
				        "checked":true,
				        "attributes":{
				            "url":"mStatus",
				            "view":"mStatus"
				        	}
				        },{
				        "id":"12",
				        "text":"Master Ruang Rapat",
				        "checked":false,
				        "attributes":{
				            "url":"mRuangRapat",
				            "view":"mRuangRapat"
				        	}
				        },{
				        "id":"13",
				        "text":"Master Jenis Ekspedisi",
				        "checked":false,
				        "attributes":{
				            "url":"mJenisEkspedisi",
				            "view":"mJenisEkspedisi"
				        	}
				        },{
				        "id":"14",
				        "text":"Master Jenis Kegiatan",
				        "checked":false,
				        "attributes":{
				            "url":"mJenisKegiatan",
				            "view":"mJenisKegiatan"
				        	}
				        },{
				        "id":"15",
				        "text":"Master Asal Kegiatan",
				        "checked":false,
				        "attributes":{
				            "url":"mAsalKegiatan",
				            "view":"mAsalKegiatan"
				        	}
				        }]
				 },{
				    "id":2,
				    "text":"Agenda",
				    "iconCls":"icon-save",
				    "children":[{
				    	"id":"21",
				        "text":"Agenda",
				        "checked":false,
				        "attributes":{
				            "url":"Agenda",
				            "view":"Agenda"
				        	}
				        },{
				        "id":"22",
				        "text":"Master Ruangan",
				        "checked":false,
				        "attributes":{
				            "url":"master_ruangan",
				            "view":"master_ruangan"
				        	}
				        
				        }]
				 },{
				    "id":3,
				    "text":"Laporan",
				    "iconCls":"icon-save",
				    "children":[{
				    	"id":"31",
				        "text":"Berkas",
				        "checked":false,
				        "attributes":{
				            "url":"berkas",
				            "view":"berkas"
				        	}
				        },{
				        "id":"32",
				        "text":"Ekspedisi",
				        "checked":false,
				        "attributes":{
				            "url":"berkas",
				            "view":"berkas"
				        	}
				        },{
				       	"id":"33",
				        "text":"Master Laporan",
				        "checked":false,
				        "attributes":{
				            "url":"berkas",
				            "view":"berkas"
				        	}
				        }]
				 }
			    ]';
		echo $menu;	
	}

	public function getContent(){
		//print_r($_POST);
		$url = isset($_POST['url'])?$_POST['url']:"";
		$view = isset($_POST['view'])?$_POST['view']:"";
		$this->load->view($view,null,true);
		//echo $view;
	}

	public function getContentMenu($view=''){
		// //print_r($_POST);
		// $url = isset($_POST['url'])?$_POST['url']:"";
		// $view = isset($_POST['view'])?$_POST['view']:"";
		$this->load->view($view);
		//echo $view;
	}

}