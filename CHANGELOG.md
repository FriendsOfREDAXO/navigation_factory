Navigation Factory - Changelog
==============================

### Version 2.0.2 - 24. Januar 2020

* fix für PHP 7.3 and 7.4
* fix bei der Verwendung von multiple Klassen (Danke @fietstouring)

### Version 2.0.2 - 24. Januar 2020

* fix für PHP 7.3

### Version 2.0.1 - 09. Juni 2018

* Link entfernt auf Startseite, thx@alexplusde
* Ausgabe der Codebeispiele für REDAXO 5.6 wiederhergestellt

### Version 2.0.0 - 15. März 2017

* Portierung zu REDAXO 5
* Klasse `rex_custom_nav` hinzugefügt. Kann als Vorlage benutzt werden um eine eigene Navigation zu schreiben
* Methode `setHideWebsiteStartArticle()` in `setHideSiteStartArticle` umbenannt. Alte Methode bleibt aufgrund compat bestehen.

### Version 1.1.1 - 01. März 2016

* Fixed #12: Home-Link nicht ausgeben wenn leer, thx@alexplusde
* Fixed: RexSearch compat

### Version 1.1.0 - 02. Dezember 2015

* Fixed: Community Addon Permissions
* Fixed #2: `has-sub` in `rex_nav` wird jetzt dem Li zugewiesen, thx@alexwenz
* Neu: `setListMode()` zur `rex_breadcrumb_nav` hinzugefügt. Ergibt bei `false` eine reine Linkliste ohne ul/li's, thx@JeGr
* Neu: Der PHP Simple HTML DOM Parser wurde dem Addon hinzugefügt und steht zur Benutzung auch ausserhalb des Addons bereit
* Verbessert: Bei gleichzeitiger Nutzung von `setStartLevel()` und `setStartCategoryId()` wird eine Warnung angezeigt

### Version 1.0.1 - 19. November 2015

* Updatehinweis: Addon bitte reinstallieren.
* Neu: Startseite mit Logo hinzugefügt

### Version 1.0.0 - 18. November 2015

* Geändert: Klasse `nav42` umbenannt und aufgeteilt in die Klassen `rex_nav`, `rex_lang_nav` und `rex_breadcrumb_nav`
* Geändert: Alle Methodennamen mit einem `Li` darin wurden umbenannt. `Li` = `ListItem`
* Geändert: Alle Methodennamen mit einem `Ul` darin wurden umbenannt. `Ul` = `List`
* Geändert: Alle Klassen geben einheitlich die Navigation über Ausgabemethode `getNavigation()` aus
* Geändert: `getNavigationByCategory()` entfernt, stattdessen `setStartCategoryId()` hinzugefügt
* Geändert: `getNavigationByLevel()` entfernt, stattdessen `setLevelStart()` hinzugefügt
* Geändert: `setLevelCount()` hinzugefügt, gibt die Anzahl der auszugebenden Levels an, beginned ab dem Start-Level bzw. der Start-Kategorie
* Geändert: `setLevelStart()` erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListClass()` (ehemals `setUlClass()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: `setListId()` (ehemals `setUlId()`) erstes Level beginnt jetzt bei 1, nicht mehr bei 0.
* Geändert: Methode `setLinkFromUserFunc()` in `setCustomLink()` umbenannt
* Geändert: Es gab umfangreiche Änderungen an der Breadcrumb Navigation. Bitte die Codebeispiele studieren
* Neu: Methode `setListClass()` zur Klasse `rex_lang_nav` hinzugefügt, thx@darwin
* Neu: Methode `setShowHasSubClass()` zur Klasse `rex_nav` hinzugefügt, zeigt automatisch eine 'has-sub' Klasse für die Ul an
* Neu: Methode `setHasSubClass()` zur Klasse `rex_nav` hinzugefügt, zum ändern des Klassenmames. default ist 'has-sub'

