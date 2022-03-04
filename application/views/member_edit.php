<div class="alert mycolor1" role="alert">회원정보수정</div>


<form name="form1" method="POST" action="" enctype="multipart/form-data">
	  <div class="form-group">
		<label for="exampleInputId">아이디</label>
		<input type="text" name="mb_id" class="form-control" id="exampleInputId" aria-describedby="IDHelp" value="<?=$row->mb_id?>" >
	  </div>
	  <? if(form_error("mb_id") == true) echo form_error("mb_id");?> 

      <div class="form-group">
		<label for="exampleInputName">이름</label>
		<input type="text" name="mb_name" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=$row->mb_name?>" >
	  </div>
	  <? if(form_error("mb_name") == true) echo form_error("mb_name");?> 

    
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" name="mb_password" class="form-control" id="exampleInputPassword1"  >
	  </div>
	  <? if(form_error("mb_password") == true) echo form_error("mb_password");?> 


	  <?php echo form_open_multipart('upload/do_upload');?>
	  <? if( $row->file_name ) :?>
         <img src="/file/<?=$row->file_name?>" width="50">
      <? endif?>
	  <div class="form-group">
		<label for="exampleInputFile
		]">파일</label>
		<input type="file" name="userfile" class="form-control" id="exampleInputFile"  value="<?=set_value("userfile");?>" >
	  </div>

	  <button type="submit" class="btn btn-primary">수정</button>
	</form>

