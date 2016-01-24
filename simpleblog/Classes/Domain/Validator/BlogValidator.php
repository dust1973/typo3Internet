<?php
namespace Typovision\Simpleblog\Domain\Validator;

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
use Typovision\Simpleblog\Domain\Model\Blog;

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BlogValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * Validates the given value
	 *
	 * @param Blog $object
	 *
	 * @return bool
	 */
	protected function isValid($object) {

		$forbiddenTitelWord = 'CMS Bashing';
		$forbiddenDescriptionWord = 'ist gut';
		if (preg_match('/' . $forbiddenTitelWord .'/i', $object->getTitle()) &&
			preg_match('/' . $forbiddenDescriptionWord . '/i', $object->getDescription())
		) {

			$this->result->forProperty('title')
				->addError(
					new \TYPO3\CMS\Extbase\Error\Error(
						LocalizationUtility::translate(
							'validator.blog.title',
							'simpleblog',
							array(
								1 => $forbiddenTitelWord,
								2 => $forbiddenDescriptionWord
							)
						),
						1393160862,
						array(
							'title' => $object->getTitle(),
							'description' => $object->getDescription()
						)
					)
				);

			$this->result->forProperty('description')
				->addError(
					new \TYPO3\CMS\Extbase\Error\Error(
						LocalizationUtility::translate(
							'validator.blog.description',
							'simpleblog',
							array(
								1 => $forbiddenTitelWord,
								2 => $forbiddenDescriptionWord
							)
						),
						1393161081,
						array(
							'title' => $object->getTitle(),
							'description' => $object->getDescription()
						)
					)
				);
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

?>