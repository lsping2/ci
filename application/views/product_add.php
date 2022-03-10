<script>
$(function(){
    $("#pdate").datetimepicker({
        locale: "ko",
        format: "YYYY-MM-DD",
        defaultDate : moment()
    });
    $("#pdate").on("dp.change", function(e){
        //alert('변경');
    })
});

function find_product(){
    window.open("/findproduct","","resizeable=yes,scrollbars=yes,width=500,height=600");
}
</script>
<div class="alert mycolor1" role="alert">상품추가</div>

<form name="form1" method="POST" action="" enctype="multipart/form-data" >
<table class="table table-bordered table-sm mymargin5">
<tr>
    <td style="width:10%;text-align:center">분류</td>
    <td align="left">
    <div class="form-inline">
        <select name="gubun_no" class="form-control input-sm">
        <? for ($i=0; $i<count($list); $i++) :?>
            <option value="<?=$list[$i]->no?>"><?=$list[$i]->name?></option>
        <? endfor ?>
        </select>
    </div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">등록일</td>
    <td align="left">
    <div class="input-group input-group-sm date" style="width:120px">
    <input type="text" name="pdate" id="pdate" class="form-control from-control-sm">
    </div>
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">상품명</td>
    <td align="left">
    <div class="form-inline">
    <input type="hidden" name="product_no">
    <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=set_value("name");?>" >
    <input type="button" value="제품찾기" onClick="find_product()"class="form-control btn btn-sm mycolor1">
    </div>
    <? if(form_error("name") == true) echo form_error("name");?> 
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">가격</td>
    <td align="left">
    <div class="form-inline">
    <input type="text" name="price" class="form-control" id="exampleInputName" aria-describedby="IDHelp" value="<?=set_value("price");?>" >
    </div>
    <? if(form_error("price") == true) echo form_error("price");?> 
    </td>
</tr>

<tr>
    <td style="width:10%;text-align:center">이미지</td>
    <td align="left">
    <div class="form-inline">
    <?php echo form_open_multipart('upload/do_upload');?>
		<input type="file" name="userfile" class="form-control" id="exampleInputFile"  value="<?=set_value("userfile");?>" >
    </div>
    </td>
</tr>

</table>
	  
<button type="submit" class="btn btn-primary">등록</button>
</form>

