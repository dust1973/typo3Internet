<?php
namespace Typovision\Simpleblog\Validation\Validator;

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

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FacebookValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * API Service
	 *
	 * @var \Typovision\Simpleblog\Service\ExternalApiService
     * @inject
	 */
	protected $apiService;

	/**
	 * Object Manager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @inject
	 */
	protected $objectManager;


	/**
	 * Validates the given value
	 *
	 * @param mixed $value
	 * @return bool
	 */
	protected function isValid($value) {
		$apiValidationResult = $this->apiService->validateData($value);
		$success = TRUE;
		if ($apiValidationResult['title']) {
			/** @var \TYPO3\CMS\Extbase\Validation\Error $error */
			$error = $this->objectManager->get(
				'TYPO3\\CMS\\Extbase\\Validation\\Error',
				$apiValidationResult['title'],
				1393165267,
				array($value->getTitle())
			);
			$this->result->forProperty('title')->addError($error);
			$success = FALSE;
		}
		return $success;
	}
}
?>