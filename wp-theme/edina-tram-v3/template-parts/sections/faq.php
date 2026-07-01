<?php
/**
 * Section: faq — accordion câu hỏi thường gặp.
 * Nạp qua: edt_section('faq', ['items' => [['q'=>'…','a'=>'…'], …]]);
 *
 * @var array $args badge|heading|label|items[]
 */
if (!defined('ABSPATH')) exit;

$badge   = $args['badge']   ?? 'FAQ';
$heading = $args['heading'] ?? 'Câu hỏi thường gặp';
$label   = $args['label']   ?? 'Câu hỏi thường gặp';
$items   = $args['items']   ?? [];
if (!$items) return;
?>
<section class="srv-section--alt" aria-label="<?php echo esc_attr($label); ?>">
  <div class="container container--narrow">
    <div class="section-header">
      <?php if ($badge) : ?><span class="badge"><?php echo esc_html($badge); ?></span><?php endif; ?>
      <h2 style="margin-top: var(--space-4);"><?php echo esc_html($heading); ?></h2>
      <div class="divider"></div>
    </div>
    <div class="faq-list">
      <?php foreach ($items as $item) : ?>
        <div class="faq-item" data-reveal>
          <button class="faq-q" aria-expanded="false">
            <span><?php echo esc_html($item['q']); ?></span>
          </button>
          <div class="faq-a"><div><div class="faq-a-inner"><?php echo wp_kses_post($item['a']); ?></div></div></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
