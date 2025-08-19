<?php
    /** 
     * Affichage de la partie admin : liste des articles avec un monitoring :
     * nombre de vues, nombre de commentaires, date de publication.
     */
?>
<div class="monitoringArticles">
    <div class="monitoringArticles--header">
        <h2>Monitoring des articles</h2>
        <h2><a href="index.php?action=admin">Edition des articles</a></h2>
    </div>
    <div class="monitoring__list">
        <div class="monitoring__list--header title"><h3>Titre</h3><div class="monitoring__list--order"><a href="?action=monitorArticles&order=title&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=title&dir=0">&#9206;</a></div></div>
        <div class="monitoring__list--header content"><h3>Vues</h3><div class="monitoring__list--order"><a href="?action=monitorArticles&order=title&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=title&dir=0">&#9206;</a></div></div>
        <div class="monitoring__list--header content"><h3>Commentaires</h3><div class="monitoring__list--order"><a href="?action=monitorArticles&order=title&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=title&dir=0">&#9206;</a></div></div>
        <div class="monitoring__list--header content"><h3>Date de publication</h3><div class="monitoring__list--order"><a href="?action=monitorArticles&order=title&dir=1">&#9207;</a>&nbsp;<a href="?action=monitorArticles&order=title&dir=0">&#9206;</a></div></div>
        <?php foreach ($articles as $article) {
            /** @var Article $article */
            ?>
                <div class="title"><?= $article->getTitle() ?></div>
                <div class="content"><?= $article->getNbViews() ?></div>
                <div class="content"><?= $article->getNbComments() ?></div>
                <div class="content"><?= $article->getDateCreation()->format('Y-m-d') ?></div>
        <?php } ?>
    </div>
</div>
<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>