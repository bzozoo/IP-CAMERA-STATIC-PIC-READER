<?php
//Kamera kép mappa elérési útvonala
$d = '/DATAS/CMS/CM1/';
 
$globList = glob($d . '*.{jpg,JPG,jpeg,JPEG,png,PNG}', GLOB_BRACE);
 
$globListCount = count($globList);
 
//Kiíratjuk a megszámlált képfájlok számát
echo 'Total: ' . count($globList) . ' files ';
echo '<hr>';
 
//cast to int
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
 
$perPage = 10;
 
$totalPage = (int)ceil(count($globList) / $perPage);
 
$page = max(1, min($totalPage, $page));
 
$start = ($page - 1) * $perPage;
 
echo 'Page: ' . $page . ' / Start: ' . $start . ' - Stop: ' . ($page * $perPage);
echo '<hr>';
 
//pagination
echo '<p>';
    for ($pageNumber = 1;$pageNumber <= $totalPage;$pageNumber++):
    echo "<a href='?page=$pageNumber'> &nbsp; $pageNumber &nbsp; </a>";
  endfor;
echo '</p>';
 
echo '<hr>';
 
foreach ($globList as $file) {
    $picArray[] = ['kepurl' => $file, 'kepdate' => filemtime($file)];
}
 
foreach ($picArray as $key => $row) {
    $kepdatekey[$key] = $row['kepdate'];
    $kepurlkey[$key] = $row['kepurl'];
}
 
array_multisort(array_column($picArray, 'kepdate'), SORT_DESC, array_column($picArray, 'kepurl'), SORT_ASC, $picArray);
 
foreach (array_slice($picArray, $start, $perPage) as $key => $value) {
    $kepurl = $value['kepurl'];
    echo '<div style="float: left; margin: 10px; font-size: 12px; text-align: center;">';
    echo "<img height='50px' width='50px' src='{$kepurl}' />'";
    echo '<br />';
    echo basename($value['kepurl']);
    echo '<br />';
    echo date('Y F d H:i:s', $value['kepdate']);
    echo '</div>';
}
