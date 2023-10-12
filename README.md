# Cách tấn công

- Ấn vào Login -> phần username điền như sau -> `user" OR "1"="1 --` -> Submit

# Khắc phục bị tấn công

- Thêm `addslashes()` vào $userName $md5Password bên UserModel trong public function auth -> `$sql = 'SELECT \* FROM users WHERE name = "' . addslashes($userName) . '" AND password = "'.addslashes($md5Password).'"';`

# Giải thích khắc phục bị tấn công

- Hàm `addslashes()` thêm dấu gạch chéo `\` trước các ký tự đặc biệt như dấu nháy đơn `'`, dấu nháy kép `"`, dấu chấm phẩy `;` và dấu gạch chéo `\` trong chuỗi. Ví dụ khi người dùng nhập giá trị cho biến `$username` là `' OR 1=1 --` sau khi sử dụng hàm trên sẽ trở thành `\' OR 1=1 --`. Câu truy vấn khi đó: `SELECT \* FROM users WHERE username = '\' OR 1=1 --'` trở nên an toàn

# php-training

- Repository: https://github.com/tailieuweb/training-php

## System requirements

- Apache: 2.4
- MySQL: 5.7 ; MariaDB: 10.x
- PHP: 7.x, 8.x
- Wamp/Xampp

# Features

- CRUD user
