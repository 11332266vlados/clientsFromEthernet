<form method="post">
    <select name="parent_id">
        <option value="0">Главная</option>
        <?php if (isset($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <?php if ($thisId == $post['id'] || in_array($post['id'],$childsIds)) {continue;}?>
                <option <?php if ($parentId == $post['id']): ?> selected <?php endif; ?>
                        value="<?=$post['id']?>"><?=$post['title']?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select> - Родитель <br> <br>
    <input type="text" name="title" <?php if (isset($title)): ?> value="<?=$title?>" <?php endif; ?> > - Название <br><br>
    <input type="text" name="description"  <?php if (isset($description)): ?> value="<?=$description?>" <?php endif; ?> > - Описание <br><br>
    <button type="submit">Сохранить</button>

</form>