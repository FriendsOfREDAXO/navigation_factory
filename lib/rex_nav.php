<?php

class rex_nav {
	protected $startCategoryId;
	protected $levelCount;
	protected $showAll;
	protected $ignoreOfflines;
	protected $hideWebsiteStartArticle;
	protected $selectedClass;
	protected $activeClass;
	protected $listId;
	protected $listClass;
	protected $listItemClass;
	protected $listItemIdFromMetaField;
	protected $listItemClassFromMetaField;
	protected $customLinkFunction;
	protected $hideIds;
	protected $listItemIdFromCategoryId;
	protected $listItemClassFromCategoryId;
	protected $showHasSubClass;
	protected $hasSubClass;

	protected $startLevelWasSet;
	protected $startCategoryIdWasSet;

	// old vars from rex_navigation
	var $path = array();
	var $callbacks = array();
	var $current_article_id = -1;
	var $current_category_id = -1;

	public function __construct() {
		$this->startCategoryId = 0;
		$this->levelCount = 5;
		$this->showAll = false;
		$this->ignoreOfflines = true;
		$this->hideWebsiteStartArticle = false;
		$this->selectedClass = 'selected';
		$this->activeClass = 'selected active';
		$this->listId = array();
		$this->listClass = array();
		$this->listItemClass = '';
		$this->listItemIdFromMetaField = '';
		$this->listItemClassFromMetaField = '';
		$this->customLinkFunction = '';
		$this->hideIds = array();
		$this->listItemIdFromCategoryId = array();
		$this->listItemClassFromCategoryId = array();
		$this->showHasSubClass = false;
		$this->hasSubClass = 'has-sub';

		$this->startLevelWasSet = false;
		$this->startCategoryIdWasSet = false;
	}

	public function getNavigation() {
		return $this->get($this->startCategoryId);
	}

	public function setStartCategoryId($catId) {
		$this->startCategoryId = $catId;
		$this->startCategoryIdWasSet = true;
	}

	public function setStartLevel($startLevel) {
		$curArt = rex_article::getCurrent();

		$navPath = explode('|', ('0|0' . $curArt->getPath() . $curArt->getId() . '|'));

		if (isset($navPath[$startLevel]) && $navPath[$startLevel] != '') {
			$this->startCategoryId = $navPath[$startLevel];
		} else {
			$this->startCategoryId = -1;
		}

		$this->startLevelWasSet = true;
	}

	public function setLevelCount($levelCount) {
		$this->levelCount = $levelCount;
	}

	public function setShowAll($showAll) {
		$this->showAll = $showAll;
	}

	public function setIgnoreOfflines($ignoreOfflines) {
		$this->ignoreOfflines = $ignoreOfflines;
	}

	/* deprecated */
	public function setHideWebsiteStartArticle($hideWebsiteStartArticle) {
		$this->hideWebsiteStartArticle = $hideWebsiteStartArticle;
	}

	public function setHideSiteStartArticle($hideSiteStartArticle) {
		$this->hideWebsiteStartArticle = $hideSiteStartArticle;
	}

	public function setSelectedClass($selectedClass) {
		$this->selectedClass = $selectedClass;
	}

	public function setActiveClass($activeClass) {
		$this->activeClass = $activeClass;
	}

	public function setListId($listId, $level = 1) {
		$this->listId[$level - 1] = $listId;
	}

	public function setListClass($listClass, $level = 1) {
		$this->listClass[$level - 1] = $listClass;
	}

	public function setListItemClass($listItemClass) {
		$this->listItemClass = $listItemClass;
	}

	public function setListItemIdFromMetaField($listItemIdFromMetaField) {
		$this->listItemIdFromMetaField = $listItemIdFromMetaField;
	}

	public function setListItemClassFromMetaField($listItemClassFromMetaField) {
		$this->listItemClassFromMetaField = $listItemClassFromMetaField;
	}

	public function setCustomLink($customLinkFunction) {
		$this->customLinkFunction = $customLinkFunction;
	}

	public function setHideIds($hideIds) {
		$this->hideIds = $hideIds;
	}

	public function setListItemIdFromCategoryId($listItemIdFromCategoryId) {
		$this->listItemIdFromCategoryId = $listItemIdFromCategoryId;
	}

	public function setListItemClassFromCategoryId($listItemClassFromCategoryId) {
		$this->listItemClassFromCategoryId = $listItemClassFromCategoryId;
	}

	public function setShowHasSubClass($showHasSubClass) {
		$this->showHasSubClass = $showHasSubClass;
	}

	public function setHasSubClass($hasSubClass) {
		$this->hasSubClass = $hasSubClass;
	}

	protected function _getNavigation($categoryId) { 
		static $depth = 0;

		$return = '';
		$listIdAttribute = '';
		$listClassAttribute = '';
		$listClasses = '';

		if ($categoryId < 0) {
			return '';
		} elseif ($categoryId < 1) {
			$cats = rex_category::getRootCategories($this->ignoreOfflines);
		} else {
			$curCat = rex_category::get($categoryId);

			if ($curCat instanceof rex_category) {
				$cats = $curCat->getChildren($this->ignoreOfflines);
			} else {
				// invalud $categoryId
				return '';
			}
		}

		if (count($cats) > 0) {
			if (isset($this->listId[$depth])) {
				$listIdAttribute = ' id="' . $this->listId[$depth] . '"';
			}

			if (isset($this->listClass[$depth])) {
				$listClasses .= ' ' . $this->listClass[$depth];
			}

			if ($listClasses != '') {
				$listClassAttribute = ' class="' . trim($listClasses) . '"';
			}

			$return .= '<ul' . $listIdAttribute . $listClassAttribute . '>';
		}
			
		foreach ($cats as $cat) {
			if ($this->_checkCallbacks($cat, $depth)) {
				$cssClasses = '';
				$idAttribute = '';

				// default li class
				if ($this->listItemClass != '') {
					$cssClasses .= ' ' . $this->listItemClass;
				}

				// li class
				if (is_array($this->listItemClassFromCategoryId) && isset($this->listItemClassFromCategoryId[$cat->getId()])) {
					$cssClasses .= ' ' . $this->listItemClassFromCategoryId[$cat->getId()];
				}
				
				 
				if ($this->listItemClassFromMetaField != '' && $cat->getValue($this->listItemClassFromMetaField) != '') {
					$cssClasses .= ' ' . trim(str_replace("|", " ", $cat->getValue($this->listItemClassFromMetaField)));
				}

				// li id
				if (is_array($this->listItemIdFromCategoryId) && isset($this->listItemIdFromCategoryId[$cat->getId()])) {
					$idAttribute = ' id="' . $this->listItemIdFromCategoryId[$cat->getId()] . '"';
				} elseif ($this->listItemIdFromMetaField != '' && $cat->getValue($this->listItemIdFromMetaField) != '') {
					$idAttribute = ' id="' . $cat->getValue($this->listItemIdFromMetaField) . '"';
				}

				// selected class
				if ($cat->getId() == $this->current_category_id) {
					// active menuitem
					$cssClasses .= ' ' . $this->activeClass;
				} elseif (in_array($cat->getId(), $this->path)) {
					// current menuitem
					$cssClasses .= ' ' . $this->selectedClass;
				} else {
					// do nothing
				}

				$trimmedCssClasses = trim($cssClasses);

				// build class attribute
				if ($trimmedCssClasses != '') {
					$classAttribute = ' class="' . $trimmedCssClasses . '"';
				} else {
					$classAttribute = '';
				}

				if (($this->hideWebsiteStartArticle && ($cat->getId() == rex_article::getSiteStartArticleId())) || (in_array($cat->getId(), $this->hideIds))) {
					// do nothing
				} else {
					$depth++;
					$urlType = 0; // default

					$return .= '<li' . $idAttribute . $classAttribute . '>';

					if ($this->customLinkFunction != '') {
						$defaultLink = call_user_func($this->customLinkFunction, $cat, $depth);
					} else {
						$defaultLink = '<a href="' . $cat->getUrl() . '">' . htmlspecialchars($cat->getName()) . '</a>';
					}

					// normal behaviour
					$return .= $defaultLink;		
				
					if (($this->showAll || $cat->getId() == $this->current_category_id || in_array($cat->getId(), $this->path)) && ($this->levelCount > $depth || $this->levelCount < 0)) {
						$return .= $this->_getNavigation($cat->getId());
					}
				
					$depth--;

					$return .= '</li>';
				}
			}
		}

		if (count($cats) > 0) {
			$return .= '</ul>';
		}

		return $return;
	}

	protected function get($categoryId = 0) { 
		if (!$this->_setActivePath()) {
			return false;
		}

		if (class_exists('rex_ycom_auth')) {
			$this->addCallback("rex_nav::checkPerm");
		}

		$out = $this->_getNavigation($categoryId);

		// show message if start level and start category were used
		if ($this->startCategoryIdWasSet && $this->startLevelWasSet) {
			$out = "<div style='display: inline-block; padding: 3px; border: 1px solid #fff;'>rex_nav: don't use setStartLevel() and setStartCategoryId() at the same time!</div>" . PHP_EOL . $out;
		}

		// add has-sub
		if ($this->showHasSubClass) {
			$html = rex_nav_simple_html_dom::str_get_html($out);

			if (is_object($html)) {
				$matches = $html->find("ul");

				foreach ($matches as $value) {
					$parent = $value->parent();

					if ($parent->tag == 'li') {
						$parent->class = trim($this->hasSubClass . ' ' . $parent->class);
					}
				}

				$out = $html->save();
			}
		}
		
		return $out;
	}

	protected function _setActivePath() {
		$article_id = rex_article::getCurrentId();
		
		if ($OOArt = rex_article::get($article_id)) {
			$path = trim($OOArt->getValue("path"), '|');
			$this->path = array();

			if	($path != "") {
				$this->path = explode("|", $path);
			}

			$this->current_article_id = $article_id;
			$this->current_category_id = $OOArt->getCategoryId();
	
			return TRUE;
		}

		return FALSE;
	}

	protected function checkPerm($nav, $depth) {
		return rex_ycom_auth::checkPerm($nav);
	}

	public function addCallback($callback = "", $depth = "") {
		if ($callback != "") {
			$this->callbacks[] = array("callback" => $callback, "depth" => $depth);
		}
	}

	protected function _checkCallbacks($category, $depth) {
		foreach($this->callbacks as $c) {
			if ($c["depth"] == "" || $c["depth"] == $depth) {
				$callback = $c['callback'];
			
				if (is_string($callback)) {
					$callback = explode('::', $callback, 2);

					if (count($callback) < 2) {
						$callback = $callback[0];
					}
				}

				if (is_array($callback) && count($callback) > 1) {
					list($class, $method) = $callback;

					if (is_object($class)) {
						$result = $class->$method($category, $depth);
					} else {
						$result = $class::$method($category, $depth);
					}
				} else {
					$result = $callback($category, $depth);
				}

				if (!$result) {
					return false;
				}
			}
		}

		return true;
	}
}

