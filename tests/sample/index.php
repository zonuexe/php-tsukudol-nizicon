<?php
namespace Tsukudol;
use Teto\HTTP;

include_once __DIR__ . '/../bootstrap.php';

$is_ja = HTTP\AcceptLanguage::detect(function ($tag) { return $tag['language'] == 'ja'; }, false);

if ($is_ja) {
    $lang_lame = 'ja-JP';
    $lang_tag  = 'ja-Jpan';
    $title = '虹のコンキスタドール (Niji no Conquistador)';
    $toc   = 'メンバー一覧';
    $birthday = '誕生日';
    $date_format = 'Y年n月j日';
} else {
    $lang_lame = 'en';
    $lang_tag  = 'en';
    $title = 'Niji no Conquistador (虹のコンキスタドール)';
    $toc   = 'List of members';
    $birthday = 'Birthday';
    $date_format = 'j F Y';
}

?>
<!DOCTYPE html>
<html lang="<?= h($lang_name) ?>">
<meta charset="UTF-8">
<title><?= h($title) ?></title>
<h1><?= h($title) ?></h1>

<h2><?= h($toc) ?></h2>

<ul>
<?php
$list_member = function (Nizicon\Member $member) use ($lang_tag) {
    return $member->names->getNameIn($lang_tag);
};
foreach (Nizicon::members() as $member): ?>
    <li><a href="#<?= h($member->twitter->screen_name) ?>"><span lang="<?=
            h($lang_name) ?>"><?= h($list_member($member)) ?></a></li>
<?php endforeach; ?>
</ul>

<?php

$ruby_name = function (Nizicon\Member $member) {
    $jpan_family = h($member->names->searchValue('family', ['script' => 'Jpan']));
    $jpan_given  = h($member->names->searchValue('given',  ['script' => 'Jpan']));
    $hira_family = h($member->names->searchValue('family', ['script' => 'Hira']));
    $hira_given  = h($member->names->searchValue('given',  ['script' => 'Hira']));
    $given_ruby  = ($jpan_given !== $hira_given) ? $hira_given : '';

    $eng_name    = h($member->names->getNameIn('en'));
    $rtc = "<rp>[</rp><rtc lang=\"en\">$eng_name</rtc><rp>]</rp>";

    return "<ruby lang=\"ja\">$jpan_family<rb>$jpan_given<rp>(</rp><rt>$hira_family<rt>$given_ruby<rp>)</rp> $rtc</ruby>";
};

foreach (Nizicon::members() as $member): ?>
<article class="member" id="<?= h($member->twitter->screen_name) ?>">
<h1><?= $ruby_name($member) ?> as <a href="<?= h($member->blog_url) ?>"><?= $member->nick_names->getNameIn($lang_tag) ?></a></h1>
<img src="<?= h($member->head_shot_urls[0]) ?>">
<dl>
    <dt>Twitter</dt>
    <dd>@<a href="<?= h($member->twitter->getUrlAsShort()) ?>"><?= h($member->twitter->screen_name) ?></a></dd>
<?php if ($member->pixiv): ?>
    <dt>pixiv</dt>
    <dd>id:<a href="<?= h($member->pixiv->getUrl()) ?>"><?= h($member->pixiv->id) ?></a> / <a href="<?=
        h($member->pixiv->getUrlAsShort()) ?>"><?= h($member->pixiv->getUrlAsShort(false)) ?></a></dd>
<?php endif; ?>
    <dt><?= h($birthday) ?></dt>
    <dd><time datetime="<?= h($member->birth_day->format(\DateTime::W3C)) ?>"><?=
            h($member->birth_day->format($date_format)) ?></time></dd>
</dl>
</article>
<?php
endforeach;
?>
<hr>
<footer>Niji No Conquistador on PHP - <a href="https://github.com/zonuexe/php-tsukudol-nizicon">zonuexe/php-tsukudol-nizicon</a></footer>
</html>

<?php
/**
 * @param  string $string
 * @return string
 */
function h($string)
{
    return htmlspecialchars($string, ENT_COMPAT | ENT_HTML5, 'UTF-8');
}
