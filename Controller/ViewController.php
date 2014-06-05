<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia	                                                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*	    along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/

namespace View\Controller;

use View\Event\ViewEvent;
use View\Form\ViewForm;
use View\Model\View;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Model\ProductQuery;


/**
 * Class ViewController
 * @package View\Controller
 * @author manuel raynaud <mraynaud@openstudio.fr>
 */
class ViewController extends BaseAdminController
{

    public function createAction($source_id)
    {
    	
        $form = new ViewForm($this->getRequest());
        $error_message = null;
    //    try {

           /* $product = ProductQuery::create()
                ->findPk($product_id);

            if (null === $product) {
                throw new \Exception('product_id is not a valid product');
            }*/

            $viewForm = $this->validateForm($form);


            $event = new ViewEvent(
                $viewForm->get('view')->getData(),
                $viewForm->get('source')->getData(),
                $viewForm->get('source_id')->getData()
            );
            
           $this->dispatch('view.create', $event);
			
		//	var_dump($event);

             $this->redirect($viewForm->get('success_url')->getData());

/*
        } catch(\Exception $e) {
            $error_message = $e->getMessage();


        }
*/
        $this->setupFormErrorContext(
            'erreur création view',
            $error_message,
            $form
        );

        return $this->render(
          $viewForm->get('source')->getData() . "-edit", array(
                $viewForm->get('source')->getData() . '_id' => $source_id,
                'current_tab' => 'modules',
                'category' => '1'
            )
        );
    }
} 