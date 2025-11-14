<?php
include "../koneksi.php";

$id_anime = $_POST['id_anime'];
$id_episode = $_POST['id_episode'] ?? 0;
$nama_user = trim($_POST['nama_user']);
$isi_komentar = trim($_POST['isi_komentar']);

if (!$nama_user || !$isi_komentar) {
    echo json_encode(['status' => 'error', 'msg' => 'Nama atau komentar kosong']);
    exit;
}

$sql = $db->prepare("INSERT INTO komentar (id_anime, id_episode, nama_user, isi_komentar) VALUES (?, ?, ?, ?)");
$sql->execute([$id_anime, $id_episode, $nama_user, $isi_komentar]);

echo json_encode(['status' => 'success']);
