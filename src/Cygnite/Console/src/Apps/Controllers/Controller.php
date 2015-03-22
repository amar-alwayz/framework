namespace {%Apps%}\Controllers;

use Cygnite\Foundation\Application;
use Cygnite\Common\Input\Input;
use Cygnite\FormBuilder\Form;
use Cygnite\Validation\Validator;
use Cygnite\Common\UrlManager\Url;
use Cygnite\Mvc\Controller\AbstractBaseController;
use {%Apps%}\Components\Form\%ControllerName%Form;
use {%Apps%}\Models\%StaticModelName%;

/**
* This file is generated by Cygnite CLI
* You may alter code to fit your needs
*/

class %ControllerName%Controller extends AbstractBaseController
{

    //protected $layout = 'layout.twig';

    protected $templateEngine = true;

    //protected $templateExtension = '.html.twig';

    protected $autoReload = true;

    protected $twigDebug = true;

    /**
    * Your constructor.
    * @access public
    *
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Default method for your controller. Render welcome page to user.
    * @access public
    *
    */
    public function indexAction()
    {
        $%controllerName% = array();
        $%controllerName% = %StaticModelName%::all(array('orderBy' => '{%primaryKey%} desc',
                /*'paginate' => array(
                    'limit' => Url::segment(3)
                )*/
            )
        );
        $flash = null;

        // Check if flash message exists, render if flash message set
        if ($this->hasFlash('success')) {
            $flash = $this->getFlash('success');
        } elseif ($this->hasError()) {
            $flash = $this->getFlash('error');
        }

        $this->render('index')->with(
            array(
                'records' => $%controllerName%,
                'flashMessage' => $flash,
                'links' => '', //%StaticModelName%::createLinks()
                'title' => 'Cygnite Framework - Crud Application'
            )
        );
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
                    $this->setFlash('success', '%ControllerName% saved successfully!')
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

        // render view page
        $this->render('create')->with(array(
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
        $validator = null; $%controllerName% = array();
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
                    $this->setFlash('success', '%ControllerName% saved successfully!')
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

         // render view page
        $this->render('update')->with(array(
                'form' => $form->buildForm()->render(),
                'validation_errors' => $form->errors,
                'title' => 'Update %ControllerName%'
        ));
    }

    /**
    * Display product details
    * @param type $id
    */
    public function showAction($id)
    {
        $%modelName% = %StaticModelName%::find($id);

        // render view page
        $this->render('show')->with(array(
                'record' => $%modelName%,
                'title' => 'Show a %ControllerName%'
        ));
    }

    /**
    * Delete %controllerName% using id
    *
    * @param type $id
    */
    public function deleteAction($id)
    {
        $%controllerName% = new %modelName%();
        if ($%controllerName%->trash($id) == true) {
            $this->setFlash('success', '%ControllerName% Deleted Successfully!')
                 ->redirectTo('%controllerName%/');
        } else {
            $this->setFlash('error', 'Error Occured while deleting %ControllerName%!')
                 ->redirectTo('%controllerName%/');
        }
    }

}//End of your %ControllerName% controller
