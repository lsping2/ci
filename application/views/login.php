<div class="alert mycolor1" role="alert">로그인</div>


<form name="form1" method="POST" action="" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="exampleInputId">아이디</label>
		<input type="text" name="mb_id" class="form-control" id="exampleInputId" aria-describedby="IDHelp" value="<?=set_value("mb_id");?>" >
	  </div>
	  <? if(form_error("mb_id") == true) echo form_error("mb_id");?> 

     
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" name="mb_password" class="form-control" id="exampleInputPassword1" value="<?=set_value("mb_password");?>"  >
	  </div>
	  <? if(form_error("mb_password") == true) echo form_error("mb_password");?> 

	  <button type="submit" class="btn btn-primary">로그인</button>
	</form>

