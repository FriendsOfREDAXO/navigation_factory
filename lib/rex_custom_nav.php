<?php

class rex_custom_nav {
	public function getNavigation() {
		$nav = '';
		$currentClass = 'selected';
		$curArticle = rex_article::getCurrent();
		$path = explode('|', trim($curArticle->getPath(), '|'));

		$nav .= '<ul>';

		foreach (rex_category::getRootCategories() as $lev1) {  
			if ($lev1->isOnline()) {
				if (isset($path[0]) && $lev1->getId() == $path[0]) {
					$nav .= '<li class="' . $currentClass . '"><a href="' . $lev1->getUrl() . '">' . $lev1->getName() . '</a>';
				} else {
					$nav .= '<li><a href="' . $lev1->getUrl() . '">' . $lev1->getName() . '</a>';
				}
				 		   
				if (isset($path[0]) && $lev1->getId() == $path[0]) {
					if (count($lev1->getChildren()) > 0) {
						$nav .= '<ul>';

						foreach ($lev1->getChildren() as $lev2) {
							if ($lev2->isOnline()) {
								if (isset($path[1]) && $lev2->getId() == $path[1]) {
									$nav .= '<li class="' . $currentClass . '"><a href="' . $lev2->getUrl() . '">' . $lev2->getName() . '</a>';
								} else {
									$nav .= '<li><a href="' . $lev2->getUrl() . '">' . $lev2->getName() . '</a>';
								}

								if (isset($path[1]) && $lev2->getId() == $path[1]) {
									if (count($lev1->getChildren()) > 0) {
										$nav .= '<ul>';

										foreach ($lev2->getChildren() as $lev3) {
											if ($lev3->isOnline()) {
												if (isset($path[2]) && $lev3->getId() == $path[2]) {
													$nav .= '<li class="' . $currentClass . '"><a href="' . $lev3->getUrl() . '">' . $lev3->getName() . '</a></li>';
												} else {
													$nav .= '<li><a href="' . $lev3->getUrl() . '">' . $lev3->getName() . '</a></li>';
												}
											}
										}

										$nav .= '</ul>';
									}
								}

								$nav .= '</li>';
							}
						}
	
						$nav .= '</ul>';
					}
				}
				
				$nav .= '</li>';
			}
		}

		$nav .= '</ul>';

		return $nav;
	}
}
