<div class="alert mycolor1" role="alert">분류수정</div>


<form name="form1" method="POST" action="" enctype="multipart/form-data">

      <div class="form-group">
		<label for="exampleInputName">분류명</label>
		<input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=$row->name?>" >
	  </div>
	  <? if(form_error("name") == true) echo form_error("name");?> 

    <button type="submit" class="btn btn-primary">수정</button>
</form>

