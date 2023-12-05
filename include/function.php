<?php

function C($text)
{
    return trim(strip_tags(htmlspecialchars(addslashes($text))));
}
?>