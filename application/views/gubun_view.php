<div class="alert mycolor1" role="alert">분류상세</div>

<form>
<table class="table">
	
<div class="form-group">
    <label for="exampleInputName">분류명</label>
    <?=$row->name; ?>
</div>


</table>

<a href="/gubun/edit/no/<?=$row->no; ?>" class="btn btn-primary">수정</a>
<a href="/gubun/del/no/<?=$row->no; ?>" class="btn btn-primary" onClick="return confirm('삭제?');">삭제</a>
<a href="/gubun/"  class="btn btn-primary">목록</a>
</form>


