<script>
function search_it(){

  if( $(".search_key").val() )
  {
    form1.action="/index.php/member/lists/search_key/"+ $(".search_key").val();
  }
  else
  {
    form1.action="/index.php/member/lists";
  }
    form1.submit();
}

</script>
<div class="alert mycolor1" role="alert">서브타이틀</div>

<form name="form1" method="post" action="">
<table width="100%">
<tr>
  <td width="50%">
        <input type="text" class="form-control search_key" name="search_key"  value="<?=$search_key?>">
  </td>
  <td>
         <button class="btn mycolor1" type="button" onClick="search_it();">검색</button>
  </td>

  <td align="right">
    <a href="/index.php/member/add"  class="btn btn-primary">추가</a>
  </td>
</tr>
</table>
</form>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">FILE</th>
      <th scope="col">DATE</th>
    </tr>
  </thead>
  <tbody>

<? 
foreach($list as $row)
{   
?>



    <tr>
      <th scope="row">1</th>
      <td><a href="/index.php/member/view/mb_no/<?=$row->mb_no?>"><?=$row->mb_id?></a></td>
      <td><a href="/index.php/member/view/mb_no/<?=$row->mb_no?>"><?=$row->mb_name?></a></td>
      <td>
        <? if( $row->file_name ) :?>
         <img src="/file/<?=$row->file_name?>" width="50">
        <? endif?>

      </td>
      <td><?=$row->reg_date?></td>
    </tr>
<?
}
?>

  </tbody>
</table>

<?
echo $pagination;
?>
