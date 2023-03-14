<?php
namespace helpers;

class RedirectHelper {
    public function redirect(string $url): void
    {
        header("Location: $url", true);
        die;
    }
}
