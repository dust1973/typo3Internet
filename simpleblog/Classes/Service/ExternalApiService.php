<?php
namespace Typovision\Simpleblog\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Patrick Lobacher <patrick.lobacher@typovision.de>, typovision GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ExternalApiService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @param \Typovision\Simpleblog\Domain\Model\Blog $blog
	 *
	 * @return array
	 */
	public function validateData(\Typovision\Simpleblog\Domain\Model\Blog $blog) {
		$errors = array();

		//$fb = file_get_contents('http://graph.facebook.com/' . $blog->getTitle());
		//$fb = json_decode($fb, TRUE);

		if ($fb) {
			$errors['title'] = LocalizationUtility::translate(
				'validator.facebook.notvalid',
				'simpleblog',
				array(
					1 => htmlspecialchars($fb['id']),
					2 => htmlspecialchars($fb['link'])
				)
			);
		}
		return $errors;
	}
}

?>