<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

	 <link rel="stylesheet" href="/css/style.css"> 

	 <script src="/js/jquery-3.5.1.slim.min.js" ></script>
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js"></script>
	<script src="/js/moment-with-locales.min.js"></script>
	<script src="/js/bootstrap-datetimepicker.js"></script>

	<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css"> 
	<link rel="stylesheet" href="/css/fontawesome.min.css"> 

    <title>Hello, world!</title>
  </head>



	<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
	  <a class="navbar-brand" href="/">관리자</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto"> <!--mr-auto 메뉴 양끝으로 배치 -->
		  <li class="nav-item active">
			<a class="nav-link" href="/member/lists">회원 </a>
		  </li>


		   <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="/member/lists" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  메뉴1
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item" href="/gubun/lists">분류관리</a>
			  <a class="dropdown-item" href="/product/lists">상품관리</a>

			  <div class="dropdown-divider"></div>

			  <a class="dropdown-item" href="#">하위3</a>

			</div>
		  </li>


		</ul>
		<? if (!$this->session->userdata('mb_id')) :?>	
			<a class="btn btn-sm-outline-secondary btn-dark" href="/login/login">로그인</a>
		<? else :?>
			<a class="btn btn-sm-outline-secondary btn-dark" href="/login/logout"> 로그아웃</a>
		<? endif ?>	
	  </div>
	</nav>
     <br>

<body>
<div class="container">