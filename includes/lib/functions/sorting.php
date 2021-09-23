<?php
function sorting($defaultfield, $imgvirpath, $defaultorder=''){
	global $sorting_elements, $sort, $sorting_element, $sorting_element_a, $sort_img;
	global $request;
	
	$sorting_elements='';
	if($defaultorder==''){
		$sort = $request->postvalue('sort','','asc');
	}
	else{
		$sort = $defaultorder;
	}
	$sorting_element = $request->postvalue('sorting','string',$defaultfield);
	if($sorting_element!=''){
		$sorting_elements=$sorting_element.' '.$sort;
		$sorting_elements=' order by '.$sorting_elements;
	}
	$sort_img='<img src="'.$imgvirpath.'images/a/sort_up.gif" border="0">';
	if($sort=='desc') $sort_img='<img src="'.$imgvirpath.'images/a/sort_down.gif" border="0">';
	$sorting_element_a=array($sorting_element=>$sort_img);
	
	echo tep_draw_hidden_field('sorting',$sorting_element,'id="sorting"');
	echo tep_draw_hidden_field('sort',$sort,'id="sort"');
	?>
	<script>
		function sort(sortexp){
			var sort = document.getElementById("sort");
			var sorting = document.getElementById("sorting");
			if(sorting.value!=sortexp){
			  sort.value = 'asc';
			}else{
			  sort.value = sort.value.toLowerCase()=='asc'?'desc':'asc';
			}
			sorting.value = sortexp;
			document.forms[0].submit();
		}
	</script>
	<?php 
}
?>