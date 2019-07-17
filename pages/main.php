<?php

$content = '
<p id="logo"><img class="img-responsive" src="' . $this->getAssetsUrl('images/logo.png') . '" alt="" /></p>
';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('main_title'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
