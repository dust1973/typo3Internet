<?php
namespace WOEHRL\WoehrlOnlinebefragung\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * The repository for Questions
 */
class QuestionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

/**
 * Find category
 * @param int $categoryUid
 * @param int $pid
 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
 */
    public function findByKat($categoryUid, $pid) {
        $query = $this->createQuery();
        $query->statement("SELECT * FROM tx_woehrlonlinebefragung_domain_model_question WHERE hidden= 0 AND deleted = 0 AND pid= ".$pid." AND category = " . $categoryUid . " LIMIT 1"); // string
        //var_dump($query->getSource());
        // LIMIT
        //$query->setLimit(1); // integer
        return $query->execute();
    }


}