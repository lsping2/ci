<div class="alert mycolor1" role="alert">상품추가</div>

<form name="form1" method="POST" action="" enctype="multipart/form-data" >
<table class="table table-bordered table-sm mymargin5">
<tr>
    <td style="width:10%;text-align:center">분류</td>
    <td align="left">
    <div class="form-inline"><?=$row->gubun_name; ?></div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">상품명</td>
    <td align="left">
    <div class="form-inline"><?=$row->name; ?></div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">가격</td>
    <td align="left">
    <div class="form-inline"><?=$row->price; ?></div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">이미지</td>
    <td align="left">
     <div class="form-inline">
     <? if( $row->file_name ) :?>
         <img src="/file_product/<?=$row->file_name?>" width="50">
      <? endif?>
    </div>
    </td>
</tr>

</table>
	  
<a href="/index.php/product/edit/no/<?=$row->no; ?>" class="btn btn-primary">수정</a>
<a href="/index.php/product/del/no/<?=$row->no; ?>" class="btn btn-primary" onClick="return confirm('삭제?');">삭제</a>
<a href="/index.php/product/"  class="btn btn-primary">목록</a>
</form>

