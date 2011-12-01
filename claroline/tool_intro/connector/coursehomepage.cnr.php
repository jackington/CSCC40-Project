<?php // $Id: coursehomepage.cnr.php 13525 2011-09-05 08:05:39Z abourguignon $

// vim: expandtab sw=4 ts=4 sts=4:

/**
 * CLAROLINE
 *
 * Course home page: Announcements portlet
 *
 * @version     $Revision: 13525 $
 * @copyright   (c) 2001-2011, Universite catholique de Louvain (UCL)
 * @license     http://www.gnu.org/copyleft/gpl.html (GPL) GENERAL PUBLIC LICENSE
 * @package     CLCHP
 * @author      Antonin Bourguignon <antonin.bourguignon@claroline.net>
 * @author      Claroline team <info@claroline.net>
 * @since       1.10
 */

require_once get_module_path( 'CLTI' ) . '/lib/toolintroductioniterator.class.php';

class CLTI_Portlet extends CourseHomePagePortlet
{
    public function renderContent()
    {
        // Init linker
        FromKernel::uses('core/linker.lib');
        ResourceLinker::init();
        
        $output = '';
        $output .= '<dl id="portletHeadlines">' . "\n";
        
        $toolIntroIterator = new ToolIntroductionIterator($this->courseCode);
        
        if ($toolIntroIterator->count() > 0)
        {
            $introList = '';
            
            foreach ($toolIntroIterator as $introItem)
            {
                if ($introItem->getVisibility() == 'SHOW')
                {
                    // Display attached resources (if any)
                    $currentLocator = ResourceLinker::$Navigator->getCurrentLocator(array('id' => $introItem->getId()));
                    $currentLocator->setModuleLabel('CLINTRO');
                    $currentLocator->setResourceId($introItem->getId());
                    
                    $resources = ResourceLinker::renderLinkList($currentLocator);
                    
                    // Prepare the render
                    $introList .= '<dt>' . "\n"
                             . '</dt>' . "\n"
                             . '<dd'.(!$toolIntroIterator->hasNext()?' class="last"':'').'>' . "\n"
                             . claro_parse_user_text($introItem->getContent()) . "\n"
                             . $resources
                             . '</dd>' . "\n";
                }
            }
        }
        
        if ($toolIntroIterator->count() == 0 || empty($introList))
        {
            $output .= '<dt></dt>'
                     . '<dd>' . "\n"
                     . ' ' . get_lang('No headline') . '. '
                     . (claro_is_allowed_to_edit() ? '<a href="' . htmlspecialchars(Url::Contextualize(get_module_url('CLTI').'/index.php?cmd=rqAdd')) . '">'
                     . get_lang('Would you like to add one ?') . '</a>' . "\n" : '')
                     . '</dd>' . "\n";
        }
        else
        {
            $output .= $introList;
        }
        
        $output .= '</dl>';
        
        return $output;
    }
    
    public function renderTitle()
    {
        $output = get_lang('Headlines');
        
        if (claro_is_allowed_to_edit())
        {
            $output .= ' <span class="separator">|</span> <a href="'
                     . htmlspecialchars(Url::Contextualize(get_module_url( 'CLTI' ) . '/index.php'))
                     . '">'
                     . '<img src="' . get_icon_url('settings') . '" alt="'.get_lang('Settings').'" /> '
                     . get_lang('Manage').'</a>';
        }
        
        return $output;
    }
}