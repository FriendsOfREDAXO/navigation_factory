<?php

class rex_lang_nav {
	protected $listId;
	protected $listClass;
	protected $selectedClass;
	protected $showListItemIds;
	protected $hideListItemIfOfflineArticle;
	protected $useLangCodeAsLinkText;
	protected $upperCaseLinkText;

	public function __construct() {
		$this->listId = '';
		$this->listClass = '';
		$this->selectedClass = 'selected';
		$this->showListItemIds = false;
		$this->hideListItemIfOfflineArticle = false;
		$this->useLangCodeAsLinkText = false;
		$this->upperCaseLinkText = false;
	}

	public function setListId($listId) {
		$this->listId = $listId;
	}
	
	public function setListClass($listClass) {
		$this->listClass = $listClass;
	}

	public function setSelectedClass($selectedClass) {
		$this->selectedClass = $selectedClass;
	}

	public function setShowListItemIds($showListItemIds) {
		$this->showListItemIds = $showListItemIds;
	}

	public function setHideListItemIfOfflineArticle($hideListItemIfOfflineArticle) {
		$this->hideListItemIfOfflineArticle = $hideListItemIfOfflineArticle;
	}

	public function setUseLangCodeAsLinkText($useLangCodeAsLinkText) {
		$this->useLangCodeAsLinkText = $useLangCodeAsLinkText;
	}

	public function setUpperCaseLinkText($upperCaseLinkText) {
		$this->upperCaseLinkText = $upperCaseLinkText;
	}

	public function getNavigation() {
		// list id
		if ($this->listId == '') {
			$listIdAttribute = '';
		} else {
			$listIdAttribute = ' id="' . $this->listId . '"';
		}
		
		// list class
		if ($this->listClass == '') {
			$listClassAttribute = '';
		} else {
			$listClassAttribute = ' class="' . $this->listClass . '"';
		}

		$curArt = rex_article::getCurrent();
		$out = '<ul' . $listIdAttribute . $listClassAttribute . '>';

		foreach (rex_clang::getAll() as $clang) {
			$clangId = $clang->getId();
			$clangName = $clang->getName();
			$clangCode = $clang->getCode();
			$article = rex_article::get($curArt->getId(), $clangId);

			// new article id
			if ($article instanceof rex_article && $article->isOnline()) {
				$newArticleId = $article->getId();
				$articleStatus = true;
			} else {
				$newArticleId = $curArt->getId();
				$articleStatus = false;
			}

			if (!$articleStatus && $this->hideListItemIfOfflineArticle) {
				// do nothing
			} else {
				// link text
				if ($this->useLangCodeAsLinkText) {
					$linkText = $clangCode;
				} else {
					$linkText = $clangName;
				}

				if ($this->upperCaseLinkText) {
					$linkText = strtoupper($linkText);
				}

				// li attribute
				if ($this->showListItemIds) {
					$listItemIdAttribute = ' id="' . $clangCode . '"';
				} else {
					$listItemIdAttribute = '';
				}

				// class attribute
				if (rex_clang::getCurrentId() == $clangId) {
					$listItemClassAttribute = ' class="' . $this->selectedClass . '"';
				} else {
					$listItemClassAttribute = '';
				}
				
				// li out
				$out .= '<li' . $listItemIdAttribute . $listItemClassAttribute . '><a href="' . rex_getUrl($newArticleId, $clangId) . '">' . $linkText . '</a></li>';
			}
		}

		$out .= '</ul>';

		return $out;
	}
}

