Breadcrumb Navigation
=====================

Ausgabe einer Breadcrumb Navigation
-----------------------------------

```php
$nav = new rex_breadcrumb_nav();

$nav->setListMode(false); // gibt eine reine linkliste ohne ul/li's aus
$nav->setListId('breadcrumb-nav'); // ul (ol) id: 'breadcrumb'
$nav->setListClass('breadcrumb'); // ul (ol) klasse: 'breadcrumb-nav'
$nav->setOrderedList(true); // es wird eine ol liste anstelle einer ul liste ausgegeben
$nav->setStartArticleName('Home'); // startartikel name: 'home'
$nav->setStartArticleIconClass('fa fa-home'); // startartikel ausgabe mit font-awesome icon
$nav->setHideStartArticleName(true); // startartikel name wird nicht angezeigt, icon sollte dafür gesetzt werden

echo $nav->getNavigation();
```
