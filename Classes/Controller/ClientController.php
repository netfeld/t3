<?php
namespace Netfeld\Test\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Hauke 
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
 * @package test
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ClientController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * clientRepository
	 *
	 * @var \Netfeld\Test\Domain\Repository\ClientRepository
	 * @inject
	 */
	protected $clientRepository;
	
	/**
	* Action-Unabhaengige Inits 
	* @return void
	*/
	public function initializeAction() {		
		//DATE TIME "dateOfBirth" muss für den Property mapper konvertiert werden ... string > DATE TIME
		
		if (isset($this->arguments['client'])) {
			$this->arguments['client']
				->getPropertyMappingConfiguration()
				->forProperty('dateOfBirth')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}
	

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$clients = $this->clientRepository->findAll();
		$this->view->assign('clients', $clients);
	}

	/**
	 * action show
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @return void
	 */
	public function showAction(\Netfeld\Test\Domain\Model\Client $client) {
		$this->view->assign('client', $client);
	}

	/**
	 * action new
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @ignorevalidation  $client
	 * @return void
	 */
	public function newAction(\Netfeld\Test\Domain\Model\Client $client = NULL) {
		$this->view->assign('client', $client);
	}

	/**
	 * action create
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @return void
	 */
	public function createAction(\Netfeld\Test\Domain\Model\Client $client) {
		$this->clientRepository->add($client);
		$this->flashMessageContainer->add('Your new Client was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @ignorevalidation  $client
	 * @return void
	 */
	public function editAction(\Netfeld\Test\Domain\Model\Client $client) {
		$this->view->assign('client', $client);
	}

	/**
	 * action update
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @return void
	 */
	public function updateAction(\Netfeld\Test\Domain\Model\Client $client) {
		$this->clientRepository->update($client);
		$this->flashMessageContainer->add('Your Client was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Netfeld\Test\Domain\Model\Client $client
	 * @return void
	 */
	public function deleteAction(\Netfeld\Test\Domain\Model\Client $client) {
		$this->clientRepository->remove($client);
		$this->flashMessageContainer->add('Your Client was removed.');
		$this->redirect('list');
	}

}
?>