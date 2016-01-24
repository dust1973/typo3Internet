<?php
namespace WOEHRL\WoehrlNewsletterabmelden\Domain\Model;

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
 * Newsletter
 */
class Newsletter extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     * @validate EmailAddress
     */
    protected $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getMeldung()
    {
        return $this->meldung;
    }

    /**
     * @param string $meldung
     */
    public function setMeldung($meldung)
    {
        $this->meldung = $meldung;
    }


    /**
     * This is the title of the post
     *
     * @var \string
     */
    protected $meldung;
}