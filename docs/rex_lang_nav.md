Sprachnavigation
================

Ausgabe einer einfachen Sprachnavigation
----------------------------------------

```php
$nav = new rex_lang_nav();

$nav->setListId('lang-nav'); // ul id: 'lang-nav'
$nav->setListClass('lang'); // ul class: 'my-lang-class'
$nav->setSelectedClass('current'); // li klasse für selektierten menüpunkt: 'current'
$nav->setShowListItemIds(true); // zusätzliche, eindeutige li id's werden ausgegeben
$nav->setHideListItemIfOfflineArticle(false); // bei einem offline artikel li nicht verstecken sondern auf startartikel der website verlinken
$nav->setUseLangCodeAsLinkText(true); // langcode anstelle sprachname als linktext ausgeben
$nav->setUpperCaseLinkText(true); // linktext in großbuchstaben anzeigen

echo $nav->getNavigation();
```
