<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <p>簡易書籍検索</p>
    <ul>
      <form  method="post">
        <li> <label for="name">名前</label> <input type="search" name="n"> </li>
        <li> <label for="name_kana">名前（ひらがな）</label> <input type="search" name="k"> </li>
        <li> <label for="gender">性別</label> <input type="search" name="g"></li>
        <li> <label for="blood_type">血液型</label><input type="search" name="b"></li>
        <li> <label for="height">身長</label><input type="search" name="l">～<input type="search" name="h"> </li>
        <li> <label for="birth_date">生年月日</label><input type="search" name="bd"></li>
        <li> <label for="center_song">センター曲</label><input type="search" name="c"></li>
        <input type="submit" value="検索">
      </form>
    </ul>

    <?php

$n=htmlspecialchars($_POST["n"], ENT_QUOTES);
$k=htmlspecialchars($_POST["k"], ENT_QUOTES);
$g=htmlspecialchars($_POST["g"], ENT_QUOTES);
$l=htmlspecialchars($_POST["l"], ENT_QUOTES);
$b=htmlspecialchars($_POST["b"], ENT_QUOTES);
$h=htmlspecialchars($_POST["h"], ENT_QUOTES);
$bd=htmlspecialchars($_POST["bd"], ENT_QUOTES);
$c=htmlspecialchars($_POST["c"], ENT_QUOTES);
$db = new PDO("mysql:host=localhost;dbname=db","root","root");


print "<p style='font-size:20pt'>検索結果</p>";

$sql="SELECT * FROM nogizaka46 WHERE 1";
if ($n != '') {
  $sql.=" AND name LIKE '%$n%'";
}
if ($k != '') {
  $sql.=" AND name_kana LIKE  '%$k%'";
}
if ($g != '') {
  $sql.=" AND gender LIKE  '%$g%'";
}
if ($b != '') {
  $sql.=" AND blood_type LIKE  '%$b%'";
}
if ($l != '') {
  $sql.=" AND   height >= '$l'";
}
if ($h != '') {
  $sql.=" AND  height <= '$h'";
}
if ($bd != '') {
  $sql.=" AND birth_date LIKE  '%$bd%'";
}
if ($c != '') {
  $sql.=" AND center_song LIKE  '%$c%'";
}



$result=$db->query($sql);


print "<table border>
<tr>
<td>名前</td>
<td>名前（かな）</td>
<td>性別</td>
<td>血液型</td>
<td>身長</td>
<td>生年月日</td>
<td>センター曲</td>
</tr>";

while ($r = $result->fetch()){
      print "
      <tr>
      <td>{$r['name']}</td>
      <td>{$r['name_kana']}</td>
      <td>{$r['gender']}</td>
      <td>{$r['blood_type']}</td>
      <td>{$r['height']}</td>
      <td>{$r['birth_date']}</td>
      <td>{$r['center_song']}</td>
      </tr>
      ";
}


print "</table>";
?>

  </body>
</html>