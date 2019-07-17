<?php
$file = rex_file::get($this->getPath('README.md'));

$parsedown = new rex_nav_parsedown();
$content = $parsedown->text($file);

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('help_readme'));
$fragment->setVar('body', $content, false);

echo $fragment->parse('core/page/section.php');
