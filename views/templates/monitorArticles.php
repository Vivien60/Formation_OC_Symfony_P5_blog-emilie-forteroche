<?php
    /** 
     * Affichage de la partie admin : liste des articles avec un monitoring :
     * nombre de vues, nombre de commentaires, date de publication.
     */
?>

<h2>Monitoring des articles</h2>

<div class="monitoringArticles">
    <?php foreach ($articles as $article) {
        /** @var Article $article */
        ?>
        <div class="articleLine">
            <div class="title"><?= $article->getTitle() ?></div>
            <div class="content"><?= $article->getNbViews() ?></div>
            <div class="content"><?= $article->getNbComments() ?></div>
            <div class="content"><?= $article->getDateCreation()->format('Y-m-d') ?></div>
        </div>
    <?php } ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>