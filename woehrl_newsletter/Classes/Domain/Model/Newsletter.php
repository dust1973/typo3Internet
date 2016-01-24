<?php
namespace WOEHRL\WoehrlNewsletter\Domain\Model;

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
     */
    protected $titel;


    /**
     * This is the title of the post
     *
     * @var \boolean
     */
    protected $damenmode;

    /**
     * @return boolean
     */
    public function isDamenmode()
    {
        return $this->damenmode;
    }

    /**
     * @param boolean $damenmode
     */
    public function setDamenmode($damenmode)
    {
        $this->damenmode = $damenmode;
    }

    /**
     * @return boolean
     */
    public function isHerrenmode()
    {
        return $this->herrenmode;
    }

    /**
     * @param boolean $herrenmode
     */
    public function setHerrenmode($herrenmode)
    {
        $this->herrenmode = $herrenmode;
    }

    /**
     * @return boolean
     */
    public function isKindermode()
    {
        return $this->kindermode;
    }

    /**
     * @param boolean $kindermode
     */
    public function setKindermode($kindermode)
    {
        $this->kindermode = $kindermode;
    }

    /**
     * This is the title of the post
     *
     * @var \boolean
     */
    protected $herrenmode;

    /**
     * This is the title of the post
     *
     * @var \boolean
     */
    protected $kindermode;

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


    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $anrede;

    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $vorname;

    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $nachname;

    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     * @validate WOEHRL\WoehrlNewsletter\Validation\Validator\PlzValidator
     *
     */
    protected $plz;



    /**
     * This is the title of the post
     *
     * @var \string
     * @validate WOEHRL\WoehrlNewsletter\Validation\Validator\KundennummerValidator
     */
    protected $kundennummer;


    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     * @validate EmailAddress
     */
    protected $email;

    /**
     * This is the title of the post
     *
     * @var \boolean
     * @validate WOEHRL\WoehrlNewsletter\Validation\Validator\AgbValidator
     */
    protected $werbung;

    /**
     * @return string
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * @param string $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * @return string
     */
    public function getAnrede()
    {
        return $this->anrede;
    }

    /**
     * @param string $anrede
     */
    public function setAnrede($anrede)
    {
        $this->anrede = $anrede;
    }

    /**
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param string $vorname
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param string $nachname
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * @return string
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * @param string $plz
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;
    }

    /**
     * @return string
     */
    public function getKundennummer()
    {
        return $this->kundennummer;
    }

    /**
     * @param string $kundennummer
     */
    public function setKundennummer($kundennummer)
    {
        $this->kundennummer = $kundennummer;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return boolean
     */
    public function isWerbung()
    {
        return $this->werbung;
    }

    /**
     * @param boolean $werbung
     */
    public function setWerbung($werbung)
    {
        $this->werbung = $werbung;
    }









}