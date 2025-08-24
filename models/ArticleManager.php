<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(?string $orderColumn = 'default', ?int $direction = 0) : array
    {
        $order = match($orderColumn) {
            'title' => 3,
            'date-pub' => 5,
            'views' => 7,
            'nb-comments' => 8,
            default => 1,
        };
        //La colonne peut être passée sous forme de numéro,
        // ce qui l'évitera d'être entourée de guillemets lors du binding.
        //Par contre, desc et asc ne peut pas être passés sous forme d'entiers,
        // ce qui les obligera à être entouré de guillemets, et ne fonctionnera pas.
        //Il est donc nécessaire de concaténer le sens du tri, en utilisant une whitelist par sécurité
        $orderDir = $direction ? 'desc' : 'asc';
        $sql = "SELECT article.*, count(comment.id) as nb_comments
                FROM article 
                    LEFT JOIN comment on article.id = comment.id_article 
                GROUP BY article.id
                ORDER BY :order $orderDir";
        $result = $this->db->query($sql, [
            'order' => $order,
        ]);
        $articles = [];
        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation, date_update) VALUES (:id_user, :title, :content, NOW(), NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId(),
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function incNbViews(Article $article) : void
    {
        if(!Utils::userConnected()) {
            $article->incNbViews();
            $this->updateOnlyNbViews($article);
        }
    }

    public function updateOnlyNbViews(Article $article)
    {
        $sql = "UPDATE article SET nb_views = :nb_views WHERE id = :id";
        $this->db->query($sql, [
            'nb_views' => $article->getNbViews(),
            'id' => $article->getId(),
        ]);
    }
}