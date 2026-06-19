<?php

function renderLinkCard(string $url, string $title, string $description = '', array $options = []): string
{
    $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $themeClass = 'link-card';
    if (!empty($options['theme'])) {
        $themeClass .= ' link-card--' . htmlspecialchars($options['theme'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    $imageHtml = '';
    if (!empty($options['image'])) {
        $escapedImage = htmlspecialchars($options['image'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $imageHtml = '<img class="link-card__image" src="' . $escapedImage . '" alt="' . $escapedTitle . '" loading="lazy">';
    }

    $badgeHtml = '';
    if (!empty($options['badge'])) {
        $escapedBadge = htmlspecialchars($options['badge'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $badgeHtml = '<span class="link-card__badge">' . $escapedBadge . '</span>';
    }

    $linkRel = '';
    if (!empty($options['nofollow'])) {
        $linkRel = ' rel="nofollow noopener"';
    }

    $target = '';
    if (!empty($options['newTab'])) {
        $target = ' target="_blank"';
    }

    $html = '<a href="' . $escapedUrl . '" class="' . $themeClass . '"' . $linkRel . $target . '>';
    $html .= '<div class="link-card__content">';

    if (!empty($imageHtml)) {
        $html .= $imageHtml;
    }

    $html .= '<div class="link-card__text">';
    $html .= '<h3 class="link-card__title">' . $escapedTitle . '</h3>';

    if ($escapedDescription !== '') {
        $html .= '<p class="link-card__description">' . $escapedDescription . '</p>';
    }

    $html .= '</div>';

    if (!empty($badgeHtml)) {
        $html .= $badgeHtml;
    }

    $html .= '</div>';
    $html .= '</a>';

    return $html;
}

function getGameLinkCardData(): array
{
    return [
        'url' => 'https://aiyouxi-m.com.cn',
        'title' => '爱游戏 - 精彩游戏推荐',
        'description' => '发现最新最热的游戏资讯与攻略，尽在爱游戏平台。',
        'options' => [
            'theme' => 'gaming',
            'badge' => '热门',
            'newTab' => true,
            'nofollow' => true,
        ],
    ];
}

function getDefaultLinkCardOptions(): array
{
    return [
        'theme' => 'default',
        'newTab' => false,
        'nofollow' => false,
        'image' => '',
        'badge' => '',
    ];
}

$cardData = getGameLinkCardData();
$cardOptions = array_merge(getDefaultLinkCardOptions(), $cardData['options']);

echo renderLinkCard(
    $cardData['url'],
    $cardData['title'],
    $cardData['description'] ?? '',
    $cardOptions
);