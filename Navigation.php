<?php

class Navigation {
	public static function buildNavigation($parentPageID = -1) {
		$hasChildren = FALSE;
		$outputHTML = '<ul>%s</ul>';
		$childrenHTML = '';
		$links = self::getSubPages($parentPageID);
		foreach ($links as $link) {
			$childrenHTML .= '<li><a href="'. $link['PAGE_URL'] . '">' . $link['PAGE_TITLE'] . '</a>';
			if ($link['SUB_PAGES_COUNT'] > 0) {
				$hasChildren = TRUE;
				$childrenHTML .= self::buildNavigation($link['CONTENT_PAGE_ID']);
			}
			$childrenHTML .= '</li>';
		}
		return sprintf($outputHTML, $childrenHTML);
	}
	
	public static function buildBootstrapNavigation($parentPageID = -1) {
		$hasChildren = FALSE;
		$outputHTML = '<ul parentPageID="' . $parentPageID . '"'. ($parentPageID == -1?' class="nav navbar-nav"':' class="dropdown-menu"') . '>%s</ul>';
		$childrenHTML = '';
		$links = self::getSubPages($parentPageID);
		foreach ($links as $link) {
			if ($link['SUB_PAGES_COUNT'] > 0) {
				$childrenHTML .= '<li class="dropdown"><a href="'. $link['PAGE_URL'] . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $link['PAGE_TITLE'] . '<span class="caret"></span></a>';
				$hasChildren = TRUE;
				$childrenHTML .= self::buildBootstrapNavigation($link['CONTENT_PAGE_ID']);
			} else {
				$childrenHTML .= '<li><a href="'. $link['PAGE_URL'] . '">' . $link['PAGE_TITLE'] . '</a>';
			}
			$childrenHTML .= '</li>';
		}
		return sprintf($outputHTML, $childrenHTML);
	}
	
	
}
?>
