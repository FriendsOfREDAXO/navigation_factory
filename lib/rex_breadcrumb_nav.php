<?php

class rex_breadcrumb_nav {
	protected $listMode;
	protected $listId;
	protected $listClass;
	protected $orderedList;
	protected $startArticleName;
	protected $startArticleIconClass;
	protected $hideStartArticleName;

	public function __construct() {
		$this->listMode = true;
		$this->listId = '';
		$this->listClass = '';
		$this->orderedList = false;
		$this->startArticleName = '';
		$this->startArticleIconClass = '';
		$this->hideStartArticleName = false;
	}

	public function setListMode($listMode) {
		$this->listMode = $listMode;
	}

	public function setListId($listId) {
		$this->listId = $listId;
	}

	public function setListClass($listClass) {
		$this->listClass = $listClass;
	}

	public function setOrderedList($orderedList) {
		$this->orderedList = $orderedList;
	}

	public function setStartArticleName($startArticleName) {
		$this->startArticleName = $startArticleName;
	}

	public function setStartArticleIconClass($startArticleIconClass) {
		$this->startArticleIconClass = $startArticleIconClass;
	}

	public function setHideStartArticleName($hideStartArticleName) {
		$this->hideStartArticleName = $hideStartArticleName;
	}

	public function getNavigation() {
		$html = '';

		if ($this->orderedList) {
			$listType = 'ol';
		} else {
			$listType = 'ul';
		}

		if ($this->listId !== '') {
			$listIdAttribute = ' id="' . $this->listId . '"';
		} else {
			$listIdAttribute = '';
		}

		if ($this->listClass !== '') {
			$listClassAttribute = ' class="' . $this->listClass . '"';
		} else {
			$listClassAttribute = '';
		}

		if ($this->listMode) {
			$html = '<' . $listType . $listIdAttribute . $listClassAttribute . '>';
		}

		$curArt = rex_article::getCurrent();
		$path = explode('|', $curArt->getPath());

		if ($curArt->getId() !== rex_article::getSiteStartArticleId()) {
			$path = array_merge(array(rex_article::getSiteStartArticleId()), $path);
		}

		foreach ($path as $id) {
			if ($id > 0) {
				$article = rex_article::get($id);

				if ($article->isOnline()) {
					$linkText = $article->getName();

					if ($this->listMode) {
						$html .= '<li>';
					}

					if (intval($id) === rex_article::getSiteStartArticleId()) {
						if ($this->hideStartArticleName) {
							$linkText = '';
						} else {
							if ($this->startArticleName != '') {
								$linkText = $this->startArticleName;
							}
						}

						if ($this->startArticleIconClass != '') {
							$linkText = '<i class="' . $this->startArticleIconClass . '"></i>' . $linkText;
						}
					}

					if (intval($id) === $curArt->getId()) {
						$html .= $linkText;
					} else if ($linkText != '') {
						$html .= '<a href="' . $article->getUrl() . '">' . $linkText . '</a>';
					}

					if ($this->listMode) {
						$html .= '</li>';
					}
				}
			}
		}

		if ($this->listMode) {
			$html .= '</' . $listType . '>';
		}
		
		return $html;
	}
}

