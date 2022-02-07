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
      <form  method="post"> <!-- formがfromになっていた。actionは指定しなくても、このプログラムが実行されます -->
        <li> <label for="title">タイトル</label> <input type="search" name="t"> </li>
        <li> <label for="author name">著者名</label> <input type="search" name="a"> </li>
        <li> <label for="year">出版年</label> <input type="search" name="l">～<input type="search" name="h"> </li>
        <li> <label for="favorite">お気に入り</label>
          <select name="f" id="favorite-select">
            <option value="1">1以上</option> <!-- valueを指定しないと値がPHPに渡されません -->
            <option value="2">2以上</option>
            <option value="3">3以上</option>
            <option value="4">4以上</option>
            <option value="5">5以上</option>
            </select>
        </li>
        <input type="submit" value="検索">
      </form>
    </ul>

    <?php

$t=htmlspecialchars($_POST["t"], ENT_QUOTES);
$a=htmlspecialchars($_POST["a"], ENT_QUOTES);
$l=htmlspecialchars($_POST["l"], ENT_QUOTES);
$h=htmlspecialchars($_POST["h"], ENT_QUOTES);
$f=htmlspecialchars($_POST["f"], ENT_QUOTES);
$db = new PDO("mysql:host=localhost;dbname=db","root","root");


print "<p style='font-size:20pt'>検索結果</p>";

// まず$sqlにSQL文を作っていきます
$sql="SELECT * FROM books WHERE 1";
if ($t != '') { // $tに値がある時だけSQL文を追加するという意味です
  $sql.=" AND title LIKE '%$t%'";
}
if ($a != '') {
  $sql.=" AND author LIKE  '%$a%'";
}
if ($l != '') {
  $sql.=" AND   year >= '$l'"; // ここは出版年が「◯◯以上」なのでこのように記述
}
if ($h != '') {
  $sql.=" AND  year <= '$h'"; // ここは出版年が「◯◯以下」なのでこのように記述
}
if ($f != '') {
  $sql.=" AND  suki >= '$f'"; // ここも「以上」なのでこのように記述する
}

// SQL文ができたら、そのSQLをqueryで実行します
$result=$db->query($sql);

// テーブルのヘッダー部分は一度だけ表示すればいいので、whileの繰り返しの前に記述します
print "<table border>
<tr>
<td>タイトル</td>
<td>著者</td>
<td>出版年</td>
<td>出版社</td>
<td>ISBN</td>
<td>おすすめ度</td>
</tr>";

while ($r = $result->fetch()){
      print "
      <tr>
      <td>{$r['title']}</td>
      <td>{$r['author']}</td>
      <td>{$r['year']}</td>
      <td>{$r['publisher']}</td>
      <td>{$r['isbn']}</td>
      <td>{$r['suki']}</td>
      </tr>
      ";
}

// tableの閉じタグはwhileの外に記述します
print "</table>";
?>

  </body>
</html>