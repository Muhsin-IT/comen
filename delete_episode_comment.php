<?php
include "../koneksi.php";

$id_episode = $_GET['id_episode'];
$sql = $db->prepare("DELETE FROM komentar WHERE id_episode = ?");
$sql->execute([$id_episode]);

echo json_encode(['status' => 'success']);
