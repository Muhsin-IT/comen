<?php
include "../koneksi.php";

$id_anime = $_GET['id_anime'];
$mode = $_GET['mode'] ?? 'episode';
$id_episode = $_GET['id_episode'] ?? 0;

if ($mode == 'all') {
    $sql = $db->prepare("SELECT * FROM komentar WHERE id_anime = ? ORDER BY tanggal DESC");
    $sql->execute([$id_anime]);
} else {
    $sql = $db->prepare("SELECT * FROM komentar WHERE id_anime = ? AND id_episode = ? ORDER BY tanggal DESC");
    $sql->execute([$id_anime, $id_episode]);
}

$komen = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($komen);
