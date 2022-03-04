<div class="alert mycolor1" role="alert">상품수정</div>

<form name="form1" method="POST" action="" enctype="multipart/form-data" >
<table class="table table-bordered table-sm mymargin5">
<tr>
    <td style="width:10%;text-align:center">분류</td>
    <td align="left">
    <div class="form-inline">
    <select name="gubun_no" class="form-control input-sm">-->
        <? for ($i=0; $i<count($list); $i++) :?>
            <option value="<?=$list[$i]->no?>" <? if( $row->gubun_no == $list[$i]->no) echo "selected";?>><?=$list[$i]->name?></option>
        <? endfor ?>
     </select>
    </div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">상품명</td>
    <td align="left">
    <div class="form-inline">
    <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=$row->name?>" >
    </div>
    <? if(form_error("name") == true) echo form_error("name");?> 
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">가격</td>
    <td align="left">
    <div class="form-inline">
    <input type="text" name="price" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=$row->price?>" >
    </div>
    <? if(form_error("price") == true) echo form_error("price");?> 
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">이미지</td>
    <td align="left">
    <div class="form-inline">
    <? if( $row->file_name ) :?>
         <img src="/file_product/<?=$row->file_name?>" width="50">
    <? endif?>
    <?php echo form_open_multipart('upload/do_upload');?>
		<input type="file" name="userfile" class="form-control" id="exampleInputFile" >
    </div>
    </td>
</tr>

</table>
	  
<button type="submit" class="btn btn-primary">수정</button>
<a href="/index.php/product/"  class="btn btn-primary">목록</a>
</form>

