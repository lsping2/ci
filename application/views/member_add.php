<div class="alert mycolor1" role="alert">회원추가</div>


<form name="form1" method="POST" action="" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="exampleInputId">아이디</label>
		<input type="text" name="mb_id" class="form-control" id="exampleInputId" aria-describedby="IDHelp" value="<?=set_value("mb_id");?>" >
	  </div>
	  <? if(form_error("mb_id") == true) echo form_error("mb_id");?> 

      <div class="form-group">
		<label for="exampleInputName">이름</label>
		<input type="text" name="mb_name" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=set_value("mb_name");?>" >
	  </div>
	  <? if(form_error("mb_name") == true) echo form_error("mb_name");?> 

    
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" name="mb_password" class="form-control" id="exampleInputPassword1" value="<?=set_value("mb_password");?>"  >
	  </div>
	  <? if(form_error("mb_password") == true) echo form_error("mb_password");?> 

	  <?php echo form_open_multipart('upload/do_upload');?>
	  <div class="form-group">
		<label for="exampleInputFile
		]">파일</label>
		<input type="file" name="userfile" class="form-control" id="exampleInputFile"  value="<?=set_value("userfile");?>" >
	  </div>



	  <div class="form-group form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Check me out</label>
	  </div>
	  <button type="submit" class="btn btn-primary">등록</button>
	</form>

