<?php
echo isset($result) ? 'Deleted user with id - ' . $_POST['id'] : '<h1>smth went wrong</h1>';
echo "<br><a href = 'cabinet'>Back to cabinet</a>";