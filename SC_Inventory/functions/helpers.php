<?php
// functions/helpers.php

// Sanitizar entrada GET
function sanitize($data){
    return htmlspecialchars(strip_tags($data));
}

// Formatear precio
function formatPrice($price){
    return number_format($price, 2, '.', ',');
}
?>
