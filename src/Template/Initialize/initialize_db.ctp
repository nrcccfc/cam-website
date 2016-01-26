<!-- File: src/Template/Initialize/initialize_db.ctp -->
<h3>Initialize Results</h3>
<center>
<table style="width:720">
    <tr>
        <th>Table</th>
        <th>Records Created</th>
    </tr>

    <?php foreach ($finalResults as $result): ?>
        <tr>
            <td><?= h($result['table']) ?></td>
            <td><?= h($result['count']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</center>