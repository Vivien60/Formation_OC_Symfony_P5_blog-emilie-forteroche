<?php
    /** 
     * Affichage de la partie admin : liste des articles avec un monitoring :
     * nombre de vues, nombre de commentaires, date de publication.
     */
?>
<div class="monitoringArticles adminContent">
    <div class="adminContent__header">
        <h2 class="adminContent__header--aside">Monitoring des articles</h2>
        <h2 class="adminContent__header--aside"><a href="index.php?action=admin">Edition des articles</a></h2>
    </div>
    <div class="monitoring__list commentPaleTable gridList">
        <div class="gridList--header title"><h3>Titre</h3><div class="gridList--order"><a href="?action=monitorArticles&order=title&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=title&dir=0">&#9206;</a></div></div>
        <div class="gridList--header content"><h3>Vues</h3><div class="gridList--order"><a href="?action=monitorArticles&order=views&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=views&dir=0">&#9206;</a></div></div>
        <div class="gridList--header content"><h3>Commentaires</h3><div class="gridList--order"><a href="?action=monitorArticles&order=nb-comments&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=nb-comments&dir=0">&#9206;</a></div></div>
        <div class="gridList--header content"><h3>Date de publication</h3><div class="gridList--order"><a href="?action=monitorArticles&order=date-pub&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=date-pub&dir=0">&#9206;</a></div></div>
        <div>&nbsp;</div>
        <?php foreach ($articles as $article) {
            /** @var Article $article */
            ?>
                <div class="title"><?= Utils::format($article->getTitle()) ?></div>
                <div class="content"><?= $article->getNbViews() ?></div>
                <div class="content"><?= $article->getNbComments() ?></div>
                <div class="content"><?= $article->getDateCreation()->format('d/m/Y') ?></div>
                <div><a class="submit gridList__cell--button" href="index.php?action=monitorComments&id=<?= $article->getId() ?>">Commentaires</a></div>
        <?php } ?>
    </div>
</div>
<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>