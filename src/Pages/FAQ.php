<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\FAQs\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-faqs
 */

namespace SilverWare\FAQs\Pages;

use Page;

/**
 * An extension of the page class for an FAQ.
 *
 * @package SilverWare\FAQs\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-faqs
 */
class FAQ extends Page
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'FAQ';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'FAQs';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'An individual FAQ within an FAQ category';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/faqs: admin/client/dist/images/icons/FAQ.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_FAQ';
    
    /**
     * Determines whether this object can exist at the root level.
     *
     * @var boolean
     * @config
     */
    private static $can_be_root = false;
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = 'none';
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'ShowInMenus' => 0
    ];
    
    /**
     * Answers a list of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Modify Field Objects:
        
        $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers the labels for the fields of the receiver.
     *
     * @param boolean $includerelations Include labels for relations.
     *
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        // Obtain Field Labels (from parent):
        
        $labels = parent::fieldLabels($includerelations);
        
        // Define Field Labels:
        
        $labels['Title'] = _t(__CLASS__ . '.QUESTION', 'Question');
        $labels['Content'] = _t(__CLASS__ . '.ANSWER', 'Answer');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers a unique ID for the HTML template.
     *
     * @return string
     */
    public function getHTMLID()
    {
        return $this->URLSegment;
    }
    
    /**
     * Answers the parent category of the receiver.
     *
     * @return FAQCategory
     */
    public function getCategory()
    {
        return $this->getParent();
    }
    
    /**
     * Answers the appropriate link for the FAQ.
     *
     * @param string $mode
     *
     * @return string
     */
    public function getFAQLink($mode = 'anchor')
    {
        return ($mode == 'category') ? $this->getCategoryLink() : $this->getAnchorLink();
    }
    
    /**
     * Answers an anchor link for the current page.
     *
     * @return string
     */
    public function getAnchorLink()
    {
        return sprintf('#%s', $this->getHTMLID());
    }
    
    /**
     * Answers an anchor link for the FAQ within the category.
     *
     * @return string
     */
    public function getCategoryLink()
    {
        return $this->getCategory()->Link($this->getAnchorLink());
    }
    
    /**
     * Answers true if the footer is to be shown in the template.
     *
     * @return boolean
     */
    public function getFooterShown()
    {
        return $this->getCategory()->isFooterShown();
    }
    
    /**
     * Answers the icon to use for top buttons.
     *
     * @return string
     */
    public function getTopIcon()
    {
        return $this->getCategory()->getTopIcon();
    }
    
    /**
     * Answers the text to use for top buttons.
     *
     * @return string
     */
    public function getTopText()
    {
        if ($text = $this->getCategory()->getTopLabel()) {
            return $text;
        }
        
        return _t(__CLASS__ . '.TOP', 'Top');
    }
}
