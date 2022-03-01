<div class="alert mycolor1" role="alert">회원상세</div>


<form>
	  <div class="form-group">
		<label for="exampleInputId">아이디</label>
		  <?=$row->mb_id; ?>
	  </div>

    <div class="form-group">
		<label for="exampleInputName">이름</label>
    <?=$row->mb_name; ?>
	  </div>

    
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
      <?=$row->mb_password; ?>
	  </div>

	  <div class="form-group">
		<label for="exampleInputFile">File</label>
		<? if( $row->file_name ) :?>
         <img src="/file/<?=$row->file_name?>" width="50">
      <? endif?>
	  </div>






	  <a href="/index.php/member/edit/mb_no/<?=$row->mb_no; ?>" class="btn btn-primary">수정</a>
    <a href="/index.php/member/del/mb_no/<?=$row->mb_no; ?>" class="btn btn-primary" onClick="return confirm('삭제?');">삭제</a>
    <a href="/index.php/member/"  class="btn btn-primary">목록</a>
	</form>


