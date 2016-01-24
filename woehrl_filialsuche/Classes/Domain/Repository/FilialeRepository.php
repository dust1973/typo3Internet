<?php
namespace Woehrl\WoehrlFilialsuche\Domain\Repository;

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
 * The repository for Filiales
 */
class FilialeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    public function getOpengeoDb($plz)
    {

       // $sql = "SELECT * FROM tx_woehrlfilialsuche_domain_model_geodaten WHERE plz LIKE '%" . $plz."%'";
        $sql = "SELECT loc_id, name, adresse, lat, lon, typ FROM tx_woehrlfilialsuche_domain_model_geodaten";

        $query = $this->createQuery();
        $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
        $query->statement($sql);
        return $query->execute();
    }
}