<?php
declare(strict_types=1);
namespace SangPortfolio\WordpressClientPortalStarter;
if (! defined('ABSPATH')) { exit; }
final class Feature {
    private const OPTION = 'wordpress_client_portal_starter_enabled';
    private const SLUG = 'wordpress-client-portal-starter';
    private const TITLE = 'WordPress Client Portal Starter';
    public function register(): void {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_menu', [$this, 'registerPage']);
        if (Support::enabled(self::OPTION)) { $this->registerFeature(); }
    }
    public function registerSettings(): void { register_setting(self::SLUG, self::OPTION, ['sanitize_callback' => static fn($value): string => empty($value) ? '0' : '1']); }
    public function registerPage(): void { add_options_page(self::TITLE, self::TITLE, 'manage_options', self::SLUG, [$this, 'renderPage']); }
    public function renderPage(): void { if (! current_user_can('manage_options')) { return; } echo '<div class="wrap"><h1>' . esc_html(self::TITLE) . '</h1><form method="post" action="options.php">'; settings_fields(self::SLUG); echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION) . '" value="1" ' . checked(Support::enabled(self::OPTION), true, false) . '> ' . esc_html__('Enable feature', 'sang-portfolio') . '</label>'; submit_button(); echo '</form></div>'; }
    private function registerFeature(): void { add_shortcode('sang_client_portal', [$this, 'renderPortal']); }
    public function renderPortal(): string { if (! is_user_logged_in()) { return '<p>' . esc_html__('Please log in to access your client portal.', 'sang-portfolio') . '</p>'; } $user = wp_get_current_user(); return '<section class="sang-client-portal"><h2>' . esc_html(sprintf(__('Welcome, %s', 'sang-portfolio'), $user->display_name)) . '</h2><p>' . esc_html__('Your private resources can be rendered here through client-specific integrations.', 'sang-portfolio') . '</p></section>'; }
}
