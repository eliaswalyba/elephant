<h1>Gestion des articles</h1>
<h4><?= $total; ?> Articles</h4>
<hr />
<table>
    <thead>
        <tr>
            <th  style="border: 1px solid gray; background-color: #949494">ID</th>
            <th  style="border: 2px solid green;">Titre</th>
            <th  style="border: 2px solid green;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td style="width: 5em; text-align: center"><?= $post->id; ?></td>
                <td style="text-align: center; width: 50em"><?= $post->title; ?></td>
                <td><a href="#">Editer</a> | <a href="#">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>