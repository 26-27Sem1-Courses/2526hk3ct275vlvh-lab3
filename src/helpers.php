<?php

// Chuyển hướng đến một trang khác
function redirect(string $location): void
{
    header('Location: ' . $location, true, 302);
    exit();
}

function html_escape(string $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}
