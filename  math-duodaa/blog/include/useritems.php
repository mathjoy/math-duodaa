<?php

if(!BLOG_VER)
{
echo '<script>window.location.href="/";</script>';	
exit;
}


//跟进用户权限，生成用户对文章操作的按钮
function blog_ger_ar_operation_bar($article,$hasright)
{
	$html='';
	if($hasright)
	{
		$html.='<div class="ar_operation">'."\n";
		$html.='<span><a href="#">阅读全文</a></span>'."\n";
		$html.='<span><a href="#">评论</a></span>'."\n";
		$html.='<span><a href="#">修改</a></span>'."\n";
		$html.='<span><a href="#">删除</a></span>'."\n";
		$html.='</div>'."\n";
	}
	else
	{
		$html.='<div class="ar_operation">'."\n";
		$html.='<span><a href="#">阅读全文</a></span>'."\n";
		$html.='<span><a href="#">评论</a></span>'."\n";
		$html.='</div>'."\n";

	}
	return $html;
}