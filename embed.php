<?php
include "koneksi.php";

$id_anime = $_GET['id_anime'];
$id_episode = $_GET['id_episode'] ?? 0;
$mode = $_GET['mode'] ?? 'episode';

if ($mode == 'all') {
    $sql = $db->prepare("SELECT * FROM komentar WHERE id_anime = ? ORDER BY tanggal DESC");
    $sql->execute([$id_anime]);
} else {
    $sql = $db->prepare("SELECT * FROM komentar WHERE id_anime = ? AND id_episode = ? ORDER BY tanggal DESC");
    $sql->execute([$id_anime, $id_episode]);
}

$komen = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="style.css">

<div class="komen-wrapper">
    <div class="komen-switch">
        <a href="?id_anime=<?= $id_anime ?>&id_episode=<?= $id_episode ?>&mode=episode">Komentar Episode Ini</a> |
        <a href="?id_anime=<?= $id_anime ?>&mode=all">Semua Komentar</a>
    </div>

    <div id="komen-box">
        <?php foreach ($komen as $k): ?>
            <div class="komen">
                <b><?= htmlspecialchars($k['nama_user']) ?></b>
                <?php if ($mode == 'all' && $k['id_episode'] != 0): ?>
                    <span class="episode-label">(Episode <?= $k['id_episode'] ?>)</span>
                <?php elseif ($k['id_episode'] == 0): ?>
                    <span class="episode-label">(Komentar Anime)</span>
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($k['isi_komentar'])) ?></p>
                <small><?= $k['tanggal'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="komen-form">
        <form method="POST" action="api/add_comment.php">
            <input type="hidden" name="id_anime" value="<?= $id_anime ?>">
            <input type="hidden" name="id_episode" value="<?= $id_episode ?>">
            <input type="text" name="nama_user" placeholder="Nama" required>
            <textarea name="isi_komentar" placeholder="Tulis komentar..." required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
</div>