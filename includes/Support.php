<?php
declare(strict_types=1);
namespace SangPortfolio;
if (! defined('ABSPATH')) { exit; }
final class Support {
    public static function enabled(string $option): bool { return '1' === (string) get_option($option, '1'); }
    public static function pageUrl(string $slug): string { return admin_url('options-general.php?page=' . rawurlencode($slug)); }
}
