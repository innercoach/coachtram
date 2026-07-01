<?php
/**
 * Section: cta-final — khối kêu gọi hành động cuối trang dịch vụ.
 * Nạp qua: edt_section('cta-final', ['badge'=>…, 'title'=>…, 'text'=>…, 'btn_label'=>…, 'btn_url'=>…]);
 *
 * @var array $args badge|title|text|btn_label|btn_url|bg
 */
if (!defined('ABSPATH')) exit;

$badge     = $args['badge']     ?? '';
$title     = $args['title']     ?? '';
$text      = $args['text']      ?? '';
$btn_label = $args['btn_label'] ?? 'Đặt lịch phiên khám phá';
$btn_url   = $args['btn_url']   ?? home_url('/lien-he/');
$bg        = $args['bg']        ?? 'bg-tram-3';
?>
<section class="srv-cta-final <?php echo esc_attr($bg); ?>">
  <div class="container" data-reveal>
    <?php if ($badge) : ?><span class="badge badge--dark"><?php echo esc_html($badge); ?></span><?php endif; ?>
    <h2><?php echo esc_html($title); ?></h2>
    <?php if ($text) : ?><p><?php echo esc_html($text); ?></p><?php endif; ?>
    <a href="<?php echo esc_url($btn_url); ?>" class="btn btn--accent btn--lg"><?php echo esc_html($btn_label); ?></a>
  </div>
</section>
