<?php
namespace Woehrl\WoehrlMarkenverwaltung\Domain\Repository;

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
 * The repository for Markes
 */
class MarkeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    public function getMarkenFromMMTabeles($modehaus, $categoryName, $categoryId){


      if($modehaus){
          $sql = " SELECT
                 tx_woehrlmarkenverwaltung_domain_model_marke.marke as marke,
                 tx_woehrlmarkenverwaltung_domain_model_marke.markelink as link,
                 UPPER(SUBSTRING(marke,1,1)) as anfangsbuchstabe
                 FROM tx_woehrlmarkenverwaltung_domain_model_marke
                 INNER JOIN tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm
                 ON tx_woehrlmarkenverwaltung_domain_model_marke.uid = tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm.uid_foreign
                 WHERE tx_woehrlmarkenverwaltung_domain_model_marke.uid=tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm.uid_foreign
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys=$categoryId
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
                     AND tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm.uid_local = $modehaus
                GROUP BY marke
                ORDER BY marke";
        }else{
          $sql = " SELECT
                 tx_woehrlmarkenverwaltung_domain_model_marke.marke as marke,
                 tx_woehrlmarkenverwaltung_domain_model_marke.markelink as link,
                 UPPER(SUBSTRING(marke,1,1)) as anfangsbuchstabe
                 FROM tx_woehrlmarkenverwaltung_domain_model_marke
                 INNER JOIN tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm
                 ON tx_woehrlmarkenverwaltung_domain_model_marke.uid = tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm.uid_foreign
                 WHERE tx_woehrlmarkenverwaltung_domain_model_marke.uid=tx_woehrlmarkenverwaltung_haus_hat_" . $categoryName . "_mm.uid_foreign
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys=$categoryId
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
                     AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
                GROUP BY marke
                ORDER BY marke";
        }
        $query = $this->createQuery();
        $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
        $query->statement($sql);
        return $query->execute();
    }

    /**
     * Returns all objects of this repository.
     *
     * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category $category
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     * @api
     */
    public function findByCategory(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category $category) {
        $sql = " SELECT
             tx_woehrlmarkenverwaltung_domain_model_marke.marke as marke,
             tx_woehrlmarkenverwaltung_domain_model_marke.markelink as link,
             UPPER(SUBSTRING(marke,1,1)) as anfangsbuchstabe
             FROM tx_woehrlmarkenverwaltung_domain_model_marke
             WHERE tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0 AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0 AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = " .$category->getUid()."
            GROUP BY marke
            ORDER BY marke";
        $query = $this->createQuery();
        $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
        $query->statement($sql);
        return $query->execute();
    }

}