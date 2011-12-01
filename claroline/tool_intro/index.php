<?php // $Id: index.php 13424 2011-08-17 14:46:21Z abourguignon $

/**
 * CLAROLINE
 *
 * Manage tools' introductions
 *
 * @version     $Revision: 13424 $
 * @copyright   (c) 2001-2011, Universite catholique de Louvain (UCL)
 * @license     http://www.gnu.org/copyleft/gpl.html (GPL) GENERAL PUBLIC LICENSE
 * @package     CLINTRO
 * @author      Claro Team <cvs@claroline.net>
 * @since       1.9
 */


// Reset session variables
$cidReset = true; // course id
$gidReset = true; // group id
$tidReset = true; // tool id

// Load Claroline kernel
require_once dirname(__FILE__) . '/../inc/claro_init_global.inc.php';

// Build the breadcrumb
$nameTools = get_lang('Headlines');

// Initialisation of variables and used classes and libraries
require_once get_module_path('CLTI').'/lib/toolintroductioniterator.class.php';

$introId            = (!empty($_REQUEST['introId'])?((int) $_REQUEST['introId']):(null));
$introCmd           = (!empty($_REQUEST['introCmd'])?($_REQUEST['introCmd']):(null));
$isAllowedToEdit    = claro_is_allowed_to_edit();

set_current_module_label('CLINTRO');

// Init linker
FromKernel::uses('core/linker.lib');
ResourceLinker::init();

// Instanciate dialog box
$dialogBox = new DialogBox();



if (isset($introCmd) && $isAllowedToEdit)
{
    // Set linker's params
    if ($introId)
    {
        $currentLocator = ResourceLinker::$Navigator->getCurrentLocator(
            array('id' => (int) $introId));
        
        ResourceLinker::setCurrentLocator($currentLocator);
    }
    
    // CRUD
    if ($introCmd == 'rqAdd')
    {
        $toolIntro = new ToolIntro();
        $toolIntroForm = $toolIntro->renderForm();
    }
    
    if ($introCmd == 'rqEd')
    {
        $toolIntro = new ToolIntro($introId);
        if($toolIntro->load())
        {
            $toolIntroForm = $toolIntro->renderForm();
        }
    }
    
    if ($introCmd == 'exAdd')
    {
        $toolIntro = new ToolIntro();
        $toolIntro->handleForm();
        
        //TODO inputs validation
        
        // Manage ressources
        if ($toolIntro->save())
        {
            $currentLocator = ResourceLinker::$Navigator->getCurrentLocator(
                array( 'id' => (int) $toolIntro->getId() ) );
            
            $resourceList =  isset($_REQUEST['resourceList'])
                ? $_REQUEST['resourceList']
                : array()
                ;
            
            ResourceLinker::updateLinkList( $currentLocator, $resourceList );
            
            $dialogBox->success( get_lang('Introduction added') );
            
            // Notify that the introsection has been created
            $claroline->notifier->notifyCourseEvent('introsection_created', claro_get_current_course_id(), claro_get_current_tool_id(), $toolIntro->getId(), claro_get_current_group_id(), '0');
        }
    }
    
    if ($introCmd == 'exEd')
    {
        $toolIntro = new ToolIntro($introId);
        $toolIntro->handleForm();
        
        //TODO inputs validation
        
        if ($toolIntro->save())
        {
            $currentLocator = ResourceLinker::$Navigator->getCurrentLocator(
                array( 'id' => (int) $toolIntro->getId() ) );
            
            $resourceList =  isset($_REQUEST['resourceList'])
                ? $_REQUEST['resourceList']
                : array()
                ;
            
            ResourceLinker::updateLinkList( $currentLocator, $resourceList );
            
            $dialogBox->success( get_lang('Introduction modified') );
            
            // Notify that the introsection has been modified
            $claroline->notifier->notifyCourseEvent('introsection_modified', claro_get_current_course_id(), claro_get_current_tool_id(), $toolIntro->getId(), claro_get_current_group_id(), '0');
        }
    }
    
    if ($introCmd == 'exDel')
    {
        $toolIntro = new ToolIntro($introId);
        
        if ($toolIntro->delete())
        {
            $dialogBox->success( get_lang('Introduction deleted') );
            
            //TODO linker_delete_resource('CLINTRO_');
        }
    }
    
    // Modify rank and visibility
    if ($introCmd == 'exMvUp')
    {
        $toolIntro = new ToolIntro($introId);
        if($toolIntro->load())
        {
            if ($toolIntro->moveUp())
            {
                $dialogBox->success( get_lang('Introduction moved up') );
            }
            else
            {
                $dialogBox->error( get_lang('This introduction can\'t be moved up') );
            }
        }
    }
    
    if ($introCmd == 'exMvDown')
    {
        $toolIntro = new ToolIntro($introId);
        $toolIntro->load();
        if($toolIntro->load())
        {
            if ($toolIntro->moveDown())
            {
                $dialogBox->success( get_lang('Introduction moved down') );
            }
            else
            {
                $dialogBox->error( get_lang('This introduction can\'t be moved down') );
            }
        }
    }
    
    if ($introCmd == 'mkVisible')
    {
        $toolIntro = new ToolIntro($introId);
        
        if ($toolIntro->load())
        {
            $toolIntro->setVisibility('SHOW');
            
            if ($toolIntro->save())
            {
                $dialogBox->success( get_lang('Introduction\' visibility modified') );
            }
            else
            {
                $dialogBox->error( get_lang('This introduction\'s visibility can\'t be modified') );
            }
        }
    }
    
    if ($introCmd == 'mkInvisible')
    {
        $toolIntro = new ToolIntro($introId);
        
        if ($toolIntro->load())
        {
            $toolIntro->setVisibility('HIDE');
            
            if ($toolIntro->save())
            {
                $dialogBox->success( get_lang('Introduction\' visibility modified') );
            }
            else
            {
                $dialogBox->error( get_lang('This introduction\'s visibility can\'t be modified') );
            }
        }
    }
}

// Display
$toolIntroIterator = new ToolIntroductionIterator(claro_get_current_course_id());

$toolIntroductions = '';
$toolIntroForm = (empty($toolIntroForm) ? '' : $toolIntroForm);

if ($toolIntroIterator->count() > 0)
{
    foreach ($toolIntroIterator as $toolIntro)
    {
        $toolIntroductions .= $toolIntro->render();
    }
}
else
{
    $toolIntro = new ToolIntro();
    
    $dialogBox->info(get_lang('There\'s no headline for this course right now.  Use the form below to add a new one.'));
    
    $toolIntroForm = $toolIntro->renderForm();
}

$output = '';
$output .= $dialogBox->render()
         . '<p>'
         . '<a href="'
         . htmlspecialchars(Url::Contextualize( $_SERVER['PHP_SELF'] .'?introCmd=rqAdd')).'">'
         . '<img src="' . get_icon_url('default_new') . '" alt="' . get_lang('New introduction') . '" /> '
         . get_lang('New item').'</a>'
         . '</p>'
         . $toolIntroForm
         . $toolIntroductions;

// Append output
$claroline->display->body->appendContent($output);

// Render output
echo $claroline->display->render();