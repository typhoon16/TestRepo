<? include_once("../libs/config.php"); 




//-----------------------------------------------------------------------------------------------------------------------
// 로그인이 없으면.. 로그인 페이지로딩..
//-----------------------------------------------------------------------------------------------------------------------
	if(!LOGIN()){ 
		$tpl['frame'] = new templete('../design/login.html');	
		$tpl['frame'] ->Set('SITENAME');
		$tpl['frame']->Display();
		exit;
	}


	$_uniq = uniqid();
	$myPageUrl = $_SERVER['PHP_SELF']."?__u=".$_uniq;
	$url_ajax = "../main/ajax_main.php?__u=".$_uniq;
	$str = get_rand_str('azAZ09$',20);
	$_csrfToken = bin2hex($str);

//-----------------------------------------------------------------------------------------------------------------------
// 공통 프레임 로드.
//-----------------------------------------------------------------------------------------------------------------------
	$tpl['frame'] = new templete('../design/frame.html');	


	$mode = (isset($_GET['mode'])) ? stripslashes($_GET['mode']) : "dashboard" ;
//-----------------------------------------------------------------------------------------------------------------------
// 페이지 명칭에 따라서 디자인 호출.
//-----------------------------------------------------------------------------------------------------------------------


	if($mode == "dashboard") {
		$body_D = "./dashboard_D.html";
		
	}
	else if($mode == "info"){
		$body_D = "./info_D.html";
	}
	else if($mode == "test"){
		$body_D = "./test_D.html";
	}
	else if($mode == "test2"){
		$body_D = "./test2_D.html";
	}
	
	
	


	$tpl['body'] = new templete($body_D);
	$tpl['body'] -> Set('myPageUrl,url_return, arr_game,arr_data, PageMoving, url_list, TotalRecord, div_str_no_cnt, my_remaind, title_bg, cnt_game_5, cnt_game_6, cnt_game, url_ajax, sports_type, game_pk,BET_MIN_MONEY, _csrfToken, opt_baby, baby_pk');
	
	
	$body = $tpl['body']->Display(true);
	
	/* top menu active flag */
	$menu_active_dashboard = "active"; 
	$menu_active_account = ""; 
	$menu_active_order = ""; 
	$menu_active_stat = ""; 
	$menu_active_config = ""; 

	$top_menu = "../design/top_menu.html"; 
	$tpl['top_menu'] = new templete($top_menu);
	$tpl['top_menu'] -> Set('menu_active_dashboard, menu_active_account, menu_active_order, menu_active_config ');
	if($tpl['top_menu']){ 
		$top_menu = $tpl['top_menu']->Display(true);
	}

	$top = "../design/top.html";
	$tpl['top'] = new templete($top);		
	$tpl['top'] -> Set('ss_id, top_menu, ss_name ');
	
	if($tpl['top']){ 
		$top = $tpl['top']->Display(true);
	}

	
	/*
	$left_menu = "../design/left_menu.html"; 
	$tpl['left_menu'] = new templete($left_menu);
	if($tpl['left_menu']){ 
		$left_menu = $tpl['left_menu']->Display(true);
	}
	*/

	

	$sidebar_right = "../design/sidebar_right.html"; 
	$tpl['sidebar_right'] = new templete($sidebar_right);
	if($tpl['sidebar_right']){ 
		$sidebar_right = $tpl['sidebar_right']->Display(true);
	}


	$tpl['frame'] -> Set('body,left_menu,bottom, top, SITENAME,sidebar_right, ss_id,ss_level,ss_nick_name, ss_member_level, ss_name,PAGETITLE,myPageUrl,url_ajax, recaptcha_site_key, OPENGRAPH');
	
	$tpl['frame']->Display();


?>