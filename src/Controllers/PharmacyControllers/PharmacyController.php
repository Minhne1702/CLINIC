<?php
echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>
    <h2>💁 Giao diện Dược sĩ</h2>
    <p>Xin chào: <strong>{$_SESSION['user']['fullName']}</strong></p>
    <a href='index.php?action=logout' style='padding:10px 20px;background:#333;color:white;text-decoration:none;border-radius:5px;'>Đăng xuất</a>
</div>";
