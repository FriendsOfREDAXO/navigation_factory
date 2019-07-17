Hauptnavigation
===============

Ausgabe des 1. Navigationslevels
--------------------------------

```php
$nav = new rex_nav();

$nav->setStartLevel(1); // startet bei level 1
$nav->setLevelCount(1); // anzahl der ausgegeben level: 1 level

echo $nav->getNavigation();
```

Ausgabe des 2. und 3. Navigationslevels
---------------------------------------

```php
$nav = new rex_nav();

$nav->setStartLevel(2); // startet bei level 2
$nav->setLevelCount(2); // anzahl der ausgegeben level: 2 level

echo $nav->getNavigation();
```

Ausgabe der Navigation mit Startkategorie Id = 42
-------------------------------------------------

```php
$nav = new rex_nav();

$nav->setStartCategoryId(42); // startet bei kategorie id = 42
$nav->setLevelCount(1); // anzahl der ausgegeben level: 1 level

echo $nav->getNavigation();
```


Alle verfügbaren Methoden und Parameter der rex_nav Klasse
----------------------------------------------------------

```php
$nav = new rex_nav();

$nav->setStartCategoryId(42); // beginnt bei der startkategorie 42
$nav->setLevelCount(2); // anzahl der ausgegeben level: 2 level
$nav->setShowAll(true); // alle unterebenen werden angezeigt
$nav->setIgnoreOfflines(false); // offline artikel werden angezeigt
$nav->setHideSiteStartArticle(true); // startartikel der website wird ausgeblendet
$nav->setHideIds(array(42, 108)); // kategorien mit ids 42 und 108 werden ausgeblendet
$nav->setSelectedClass('current'); // li klasse für selektierte menüpunkte: 'current'
$nav->setActiveClass('current active'); // li klasse für gerade aktiven menüpunkt: 'current active'
$nav->setShowHasSubClass(true); // zeigt 'has-sub' klasse für die li an
$nav->setHasSubClass('has-sub'); // klassenname der 'has-sub' klasse
$nav->setListId('nav', 1); // erste ul id: 'nav'
$nav->setListClass('sf-menu', 1); // erste ul klasse 'sf-menu'
$nav->setListItemClass('list-item'); // li klasse 'list-item'
$nav->setListItemIdFromMetaField('cat_css_id'); // li id aus metainfo feld: 'cat_css_id'
$nav->setListItemClassFromMetaField('cat_css_class'); // li klasse aus metainfo feld: 'cat_css_class'
$nav->setListItemIdFromCategoryId(array(42 => 'foo', 108 => 'bar')); // li id anhand artikel id
$nav->setListItemClassFromCategoryId(array(42 => 'the-class')); // li klasse anhand artikel id
$nav->setCustomLink(function($cat, $depth) { // gesamter link anhand php funktion
    if ($depth == 1) {
		// hier als beispiel: erste ebene ohne verlinkung
        return htmlspecialchars($cat->getName());
    } else {
		// alle anderen ebenen werden normal verlinkt
        return '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
    }
});

echo $nav->getNavigation();
```
