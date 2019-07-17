<?php

$file = rex_file::get($this->getPath('docs/rex_custom_nav.md'));

$parsedown = new rex_nav_parsedown();
$content = $parsedown->text($file);
$content = preg_replace('@<h1[^>]*?>.*?<\/h1>@si', '', $content);

$classContent = file_get_contents($this->getPath('lib/rex_custom_nav.php'));
$content .= '<code><pre>' . highlight_string($classContent, true)  . '</pre></code>';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('rex_custom_nav'));
$fragment->setVar('body', $content, false);

echo $fragment->parse('core/page/section.php');

