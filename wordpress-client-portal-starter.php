<?php
/**
 * Plugin Name: WordPress Client Portal Starter
 * Description: A foundation for a secure WordPress client portal and self-service content workflows.
 * Version: 0.1.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

namespace SangPortfolio;

if (! defined('ABSPATH')) {
    exit;
}

final class WordpressClientPortalStarterPlugin {
    public function __construct() {
        add_action('init', [$this, 'bootstrap']);
    }

    public function bootstrap(): void {
        do_action('sang_portfolio_wordpress_client_portal_starter_ready');
    }
}

new WordpressClientPortalStarterPlugin();
