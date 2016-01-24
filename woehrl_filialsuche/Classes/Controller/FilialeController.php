<?php
namespace Woehrl\WoehrlFilialsuche\Controller;

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
 * FilialeController
 */
require_once './typo3conf/ext/woehrl_filialsuche/Classes/Lib/OgdbDistance.php';

//DEFINE('OGDB_EARTH_RADIUS',6371); // https://secure.wikimedia.org/wikipedia/de/wiki/Erdradius#Res.C3.BCmee

//ini_set('precision', 49); // http://de2.php.net/manual/de/function.pi.php

class FilialeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * filialeRepository
	 *
	 * @var \Woehrl\WoehrlFilialsuche\Domain\Repository\FilialeRepository
	 * @inject
	 */
	protected $filialeRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {


		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($filiales, 'filiales');



		$filiales = $this->filialeRepository->findAll();
		$this->view->assign('filiales', $filiales);
	}

	/**
	 * action show
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale) {




		$plz = $filiale->getPlz();
		$radius =$filiale->getRadius();
		if($plz){
			//$filiale->modehaeuser = $this->ogdbRadius($filiale->getPlz(), $radius);

            $filiale->modehaeuser = ogdbRadius($filiale->getPlz(), $radius);
            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($filiale, 'filiales');


			$lat_pos = NULL;
			$lon_pos = NULL;

			foreach ($filiale->modehaeuser as $modehaus) {
				if ((empty($lat_pos)) AND (empty($lon_pos))) {
					$lat_pos = $modehaus['lat_pos'];
					$lon_pos = $modehaus['lon_pos'];
				}
				$distanceArray[] = $modehaus['distance'];

			}


           // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($distanceArray, 'filiales');

            if($distanceArray) {
                $distanceDiff = max($distanceArray) - min($distanceArray);
                if ($distanceDiff < 10) {
                    $zoom = 15;
                } elseif ($distanceDiff > 10 AND $distanceDiff < 50) {
                    $zoom = 10;
                } else {
                    $zoom = 8;
                }
                $filiale->zoom = $zoom;
                $filiale->lat_pos = $lat_pos;
                $filiale->lon_pos = $lon_pos;
            }else{


                $message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                    'Leider wurde keine Filiale zu Ihren Sucheingaben gefunden.',
                    'Ooops!', // the header is optional
                    \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING, // the severity is optional as well and defaults to \TYPO3\CMS\Core\Messaging\FlashMessage::OK
                    TRUE // optional, whether the message should be stored in the session or only in the \TYPO3\CMS\Core\Messaging\FlashMessageQueue object (default is FALSE)
                );
              // $this->flashMessageContainer->add('Leider wurde keine Filiale zu Ihren Sucheingaben gefunden.');
                \TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage($message);
                $this->view->assign('filiale', $filiale);
                $this->redirect('list');
                //$this->redirect('list', NULL,NULL ,array('notfound'=>1));
            }
		}else{
			$filiale->modehaeuser = 2;
		}






		$this->view->assign('filiale', $filiale);
	}

	/**
	 * action new
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $newFiliale
	 * @ignorevalidation $newFiliale
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $newFiliale = NULL) {

		$this->view->assign('newFiliale', $newFiliale);
	}

	/**
	 * action create
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $newFiliale
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $newFiliale) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->filialeRepository->add($newFiliale);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale
	 * @ignorevalidation $filiale
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale) {
		$this->view->assign('filiale', $filiale);
	}

	/**
	 * action update
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->filialeRepository->update($filiale);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlFilialsuche\Domain\Model\Filiale $filiale) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->filialeRepository->remove($filiale);
		$this->redirect('list');
	}



    function ogdbDistance($origin,$destination) {
        $fileData = explode("\n",ogdbGetData());

        foreach ( $fileData as $fileRow ) {
            $fileRow = explode(";",$fileRow);

            $dataStructure = ogdbDataStructure($fileRow);

            if ( $dataStructure ) {
                if ( isset($fileRow[$dataStructure['zip_pos']]) && isset($fileRow[$dataStructure['lon_pos']]) && isset($fileRow[$dataStructure['lat_pos']]) ) {
                    if ( substr_count($fileRow[$dataStructure['zip_pos']],$origin) == 1 ) {
                        $origin_lon = deg2rad($fileRow[$dataStructure['lon_pos']]);
                        $origin_lat = deg2rad($fileRow[$dataStructure['lat_pos']]);
                    }
                    if ( substr_count($fileRow[$dataStructure['zip_pos']],$destination) == 1 ) {
                        $destination_lon = deg2rad($fileRow[$dataStructure['lon_pos']]);
                        $destination_lat = deg2rad($fileRow[$dataStructure['lat_pos']]);
                    }
                }
            }
            unset($dataStructure,$fileRow);
        }
        $distance = FALSE;
        if ( isset($origin_lon) && isset($origin_lat) && isset($destination_lon) && isset($destination_lat) ) {
            $distance = acos(sin($destination_lat)*sin($origin_lat)+cos($destination_lat)*cos($origin_lat)*cos($destination_lon - $origin_lon))*OGDB_EARTH_RADIUS;
        }
        return $distance;
    }

// $sort = "asc", "desc" or "" for nothing
    function ogdbRadius($plz,$km,$sort='asc') {
       // $fileData = explode("\n",ogdbGetData());

        $res = $this->filialeRepository->getOpengeoDb($plz);




        foreach ($res as $fileRow ) {

            //$fileRow = explode(";",$fileRow);
            //$dataStructure = ogdbDataStructure($fileRow);
            //var_dump($dataStructure);

            if ( isset($fileRow['plz']) && isset($fileRow['lon']) && isset($fileRow['lat']) ) {


                if (substr_count($fileRow['plz'],$plz) == 1 ) {
                    $origin_lon = $fileRow['lon'];
                    $origin_lat = $fileRow['lat'];
                    $id = $fileRow['loc_id'];
                }
            }
            unset($fileRow);
        }


        $lambda = $origin_lon * pi() /180;
        $phi = $origin_lat * pi() / 180;
        // Umwandlung der Kurgelkoordinaten ins kartesische Koordinatensystem
        $geoKoordX = OGDB_EARTH_RADIUS * cos($phi) * cos($lambda);
        $geoKoordY = OGDB_EARTH_RADIUS * cos($phi) * sin($lambda);
        $geoKoordZ = OGDB_EARTH_RADIUS * sin($phi);
        $data = array();

        if ( isset($origin_lon) && isset($origin_lat) && isset($id) ) {
            foreach ($res as $fileRow ) {
                //$fileRow = explode("\t",$fileRow);
                //$dataStructure = ogdbDataStructure($fileRow);

                if ( isset($fileRow['plz']) && isset($fileRow['lon']) && isset($fileRow['lat']) ) {
                    $distance =  2*OGDB_EARTH_RADIUS * asin(
                            SQRT(
                                pow($geoKoordX - (OGDB_EARTH_RADIUS * cos($fileRow['lat']*pi()/180) * cos($fileRow['lon']*pi() /180)),2)
                                +pow($geoKoordY - (OGDB_EARTH_RADIUS * cos($fileRow['lat']*pi()/180) * sin($fileRow['lon']*pi() /180)),2)
                                +pow($geoKoordZ - (OGDB_EARTH_RADIUS * sin($fileRow['lat']*pi()/180)),2)
                            ) / (2*OGDB_EARTH_RADIUS));


                    //var_dump($fileRow[3] . '<b> '. round($distance, 2) .'</b>');
                    if( $distance < $km AND $fileRow['name'] != '' ) {


                       // die;

                        $data[($distance+0.01)*1000] = array
                        (
                            'loc_id'=>$fileRow['loc_id'],
                            'name'=>$fileRow['name'],
                            'zip'=>$fileRow['plz'],
                            'distance'=>$distance,
                            'adresse'=>$fileRow['adresse'],
                            'lat_pos'=>$fileRow['lat'],
                            'lon_pos'=>$fileRow['lon'],
                            'url' =>$fileRow['typ']
                        );

                    }

                    //var_dump($data);
                    unset($distance);

                }
                unset($fileRow);
            }

        }

        switch ( $sort ) {
            case 'asc':
                ksort($data);
                break;
            case 'desc':
                krsort($data);
                break;
        }
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($data, date('d-m-Y  H:i'));
        return $data;
    }

}