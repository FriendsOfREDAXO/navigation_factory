<?php
$file = rex_file::get($this->getPath('docs/rex_nav.md'));

$parsedown = new rex_nav_parsedown();
$content = $parsedown->text($file);
$content = preg_replace('@<h1[^>]*?>.*?<\/h1>@si', '', $content);

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('rex_nav'));
$fragment->setVar('body', $content, false);

echo $fragment->parse('core/page/section.php');

