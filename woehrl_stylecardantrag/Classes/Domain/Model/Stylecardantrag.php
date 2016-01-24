<?php
namespace WOEHRL\WoehrlStylecardantrag\Domain\Model;

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
 * Stylecardantrag
 */
class Stylecardantrag extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {


    /**
     * This is the title of the post
     *
     * @var \string
     */
    protected $titel;

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
    protected $land;

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
     * @validate WOEHRL\WoehrlStylecardantrag\Validation\Validator\PlzValidator
     *
     */
    protected $plz;

    /**
     * This is the title of the post
     * @var \string
     * @validate NotEmpty
     *
     */
    protected $ort;


    /**
     * This is the title of the post
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $adresse;

    /**
     * This is the title of the post
     *
     * @var \string
     */
    protected $telefon;

    /**
     * This is the title of the post
     *
     * @var \string
     */
    protected $mobil;

    /**
     * This is the title of the post
     *
     * @var \string
     * @validate WOEHRL\WoehrlStylecardantrag\Validation\Validator\GeburtsdatumValidator
     * @validate NotEmpty
     */
    protected $geburtsdatum;

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
     */
    protected $werbung;

    /**
     * This is the title of the post
     *
     * @var \boolean
     * @validate WOEHRL\WoehrlStylecardantrag\Validation\Validator\AgbValidator
     */
    protected $agb;

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
    public function getLand()
    {
        return $this->land;
    }

    /**
     * @param string $land
     */
    public function setLand($land)
    {
        $this->land = $land;
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
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * @param string $ort
     */
    public function setOrt($ort)
    {
        $this->ort = $ort;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @param string $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @return string
     */
    public function getMobil()
    {
        return $this->mobil;
    }

    /**
     * @param string $mobil
     */
    public function setMobil($mobil)
    {
        $this->mobil = $mobil;
    }

    /**
     * @return string
     */
    public function getGeburtsdatum()
    {
        return $this->geburtsdatum;
    }

    /**
     * @param string $geburtsdatum
     */
    public function setGeburtsdatum($geburtsdatum)
    {
        $this->geburtsdatum = $geburtsdatum;
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

    /**
     * @return boolean
     */
    public function isAgb()
    {
        return $this->agb;
    }

    /**
     * @param boolean $agb
     */
    public function setAgb($agb)
    {
        $this->agb = $agb;
    }






}