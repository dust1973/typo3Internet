<?php
namespace Typovision\Simpleblog\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BlogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Search the searchword in property title
	 *
	 * @param string $search
	 * @param int $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findSearchForm($search, $limit) {
		$query = $this->createQuery();
		$query->matching(
			$query->like('title', '%' . $search . '%')
		);
		$query->setOrderings(array('title' => QueryInterface::ORDER_DESCENDING));

		if ($limit && intval($limit) > 0) {
			$query->setLimit(intval($limit));
		}
		$result = $query->execute();
		return $result;
	}
}

?>