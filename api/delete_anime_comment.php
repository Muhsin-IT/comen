<?php
include "../koneksi.php";

$id_anime = $_GET['id_anime'];
$sql = $db->prepare("DELETE FROM komentar WHERE id_anime = ?");
$sql->execute([$id_anime]);

echo json_encode(['status' => 'success']);
