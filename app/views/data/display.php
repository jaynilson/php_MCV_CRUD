<?php
// Assuming $result is the data returned from $userDataModel->getData($userId)
foreach ($result as $row): ?>
    <p><?php echo htmlspecialchars($row['data']); ?></p>
<?php endforeach; ?>