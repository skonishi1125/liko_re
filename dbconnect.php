<?php
//DB接続
try{
	$db = new PDO('mysql:dbname=liko;host=localhost;charset=utf8','root','root');
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
	echo 'DB接続エラー: ' . $e->getMessage();
}
?>

<?php  
//関数定義
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

function makeLink($value){
	return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)" , '<a href="\1\2">\1\2</a>' , $value);
}

?>