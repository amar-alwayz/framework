namespace {%Apps%}\Controllers;

use Cygnite\Common\Input\Input;
use Cygnite\FormBuilder\Form;
use Cygnite\Validation\Validator;
use Cygnite\Common\UrlManager\Url;
use Cygnite\Foundation\Application;
use Cygnite\Mvc\Controller\AbstractBaseController;
use {%Apps%}\Components\Form\%ControllerName%Form;
use {%Apps%}\Models\%StaticModelName%;

/**
* This file is generated by Cygnite Crud Generator
* You may alter code to fit your need
*/

class %ControllerName%Controller extends AbstractBaseController
{
    /**
    * --------------------------------------------------------------------------
    * The %ControllerName% Controller
    *--------------------------------------------------------------------------
    *  This controller respond to uri beginning with %controllerName% and also
    *  respond to root url like "%controllerName%/index"
    *
    * Your GET request of "%controllerName%/index" will respond like below -
    *
    *     public function indexAction()
    *     {
    *            echo "Cygnite : Hello ! World ";
    *     }
    *
    */

    // Plain layout
    protected $layout = 'layouts.base';

    /**
    * Your constructor.
    * @access public
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Default method for your controller. Render index page into browser.
    * @access public
    * @return void
    */
    public function indexAction()
    {
        $%controllerName% = [];
        $%controllerName% = %StaticModelName%::all(array('orderBy' => '{%primaryKey%} desc',
                /*'paginate' => array(
                    'limit' => Url::segment(3)
                )*/)
        );

        $this->render('index', array(
            'records' => $%controllerName%,
            'links' => '', //%StaticModelName%::createLinks(),
            'title' => 'Cygnite Framework - Crud Application'
        ));
    }

    /**
    * Set Validation rules for Form
    * @param $input
    * @return mixed
    */
    private function setValidationRules($input)
    {
        //Set Form validation rules
        return Validator::instance($input, function ($validate)
        {
            $validate%addRule%

            return $validate;
        });
    }

    /**
     * Add a new %controllerName%
     * @return void
     */
    public function addAction()
    {
        $validator = null;
        $form = new %ControllerName%Form();
        $form->action = 'add';
        $input = Input::make();

        //Check is form posted
        if ($input->hasPost('btnSubmit') == true) {

            $validator = $this->setValidationRules($input);

            //Run validation
            if ($validator->run()) {

                $%modelName% = new %StaticModelName%();
                // get post array value except the submit button
                $postArray = $input->except('btnSubmit')->post();

                %modelColumns%

                // Save form details
                if ($%modelName%->save()) {
                    $this->setFlash('success', '%ControllerName% added successfully!')
                        ->redirectTo('%controllerName%/index/'.Url::segment(3));
                } else {
                    $this->setFlash('error', 'Error occured while saving %ControllerName%!')
                        ->redirectTo('%controllerName%/index/'.Url::segment(3));
                }

            } else {
                //validation error here
                $form->errors = $validator->getErrors();
            }

            $form->validation = $validator;
        }

        // We can also use same view page for create and update
        $this->render('create', array(
                'form' => $form->buildForm()->render(),
                'validation_errors' => $form->errors,
                'title' => 'Add a new %ControllerName%'
        ));
    }

    /**
     * Update a %controllerName%
     *
     * @param $id
     */
    public function editAction($id)
    {
        $validator = null; $%controllerName% = [];
        $%controllerName% = %StaticModelName%::find($id);
        $form = new %ControllerName%Form($%controllerName%, Url::segment(3));
        $form->action = 'edit';

        $input = Input::make();

        //Check is form posted
        if ($input->hasPost('btnSubmit') == true) {

            $validator = $this->setValidationRules($input);

            //Run validation
            if ($validator->run()) {

                // get post array value except the submit button
                $postArray = $input->except('btnSubmit')->post();

                %modelColumns%

                // Save form information
                if ($%modelName%->save()) {
                    $this->setFlash('success', '%ControllerName% updated successfully!')
                        ->redirectTo('%controllerName%/index/'.Url::segment(3));
                } else {
                    $this->setFlash('error', 'Error occured while saving %ControllerName%!')
                        ->redirectTo('%controllerName%/index/'.Url::segment(3));
                }

            } else {
                //validation error here
                $form->errors = $validator->getErrors();
            }

            $form->validation = $validator;
        }

        $this->render('update', array(
                'form' => $form->buildForm()->render(),
                'validation_errors' => $form->errors,
                'title' => 'Update the %ControllerName%'
        ));

    }

    /**
    *  Display product details
    * @param type $id
    */
    public function showAction($id)
    {
        $%modelName% = %StaticModelName%::find($id);

        $this->render('show', array(
            'record' => $%modelName%,
            'title' => 'Show the %ControllerName%'
        ));
    }

    /**
    * Delete %controllerName% using id
    *
    * @param type $id
    */
    public function deleteAction($id)
    {
        $%controllerName% = new %StaticModelName%();

        if ($%controllerName%->trash($id) == true) {
            $this->setFlash('success', '%ControllerName% Deleted Successfully!')
                 ->redirectTo('%controllerName%/');
        } else {
            $this->setFlash('error', 'Error Occured while deleting %ControllerName%!')
                 ->redirectTo('%controllerName%/');
        }
    }

}//End of your %ControllerName% controller
