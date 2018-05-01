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

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextField;
use SilverWare\FontIcons\Forms\FontIconField;
use SilverWare\Forms\FieldSection;
use SilverWare\Lists\ListSource;
use Page;

/**
 * An extension of the page class for an FAQ page.
 *
 * @package SilverWare\FAQs\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-faqs
 */
class FAQPage extends Page implements ListSource
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'FAQ Page';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'FAQ Pages';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'Holds a series of FAQs organised into categories';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/faqs: admin/client/dist/images/icons/FAQPage.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_FAQPage';
    
    /**
     * Defines the default child class for this object.
     *
     * @var string
     * @config
     */
    private static $default_child = FAQCategory::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'TopIcon' => 'FontIcon',
        'TopLabel' => 'Varchar(32)',
        'ShowFAQs' => 'Boolean',
        'ShowTopButtons' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'TopIcon' => 'chevron-up',
        'ShowFAQs' => 1,
        'ShowTopButtons' => 1
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        FAQCategory::class
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
        
        // Create Style Fields:
        
        $fields->addFieldsToTab(
            'Root.Style',
            [
                FieldSection::create(
                    'FAQsStyle',
                    $this->fieldLabel('FAQsStyle'),
                    [
                        FontIconField::create(
                            'TopIcon',
                            $this->fieldLabel('TopIcon')
                        )
                    ]
                )
            ]
        );
        
        // Create Options Fields:
        
        $fields->addFieldsToTab(
            'Root.Options',
            [
                FieldSection::create(
                    'FAQsOptions',
                    $this->fieldLabel('FAQsOptions'),
                    [
                        TextField::create(
                            'TopLabel',
                            $this->fieldLabel('TopLabel')
                        ),
                        CheckboxField::create(
                            'ShowTopButtons',
                            $this->fieldLabel('ShowTopButtons')
                        ),
                        CheckboxField::create(
                            'ShowFAQs',
                            $this->fieldLabel('ShowFAQs')
                        )
                    ]
                )
            ]
        );
        
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
        
        $labels['TopIcon'] = _t(__CLASS__ . '.TOPICON', 'Top icon');
        $labels['TopLabel'] = _t(__CLASS__ . '.TOPBUTTONLABEL', 'Top button label');
        $labels['ShowFAQs'] = _t(__CLASS__ . '.SHOWFAQSINPAGE', 'Show FAQs in page');
        $labels['ShowTopButtons'] = _t(__CLASS__ . '.SHOWTOPBUTTONS', 'Show top buttons');
        
        $labels['FAQsStyle'] = $labels['FAQsOptions'] = _t(__CLASS__ . '.FAQS', 'FAQs');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers all categories within the receiver.
     *
     * @return DataList
     */
    public function getAllCategories()
    {
        return $this->AllChildren()->filter('ClassName', FAQCategory::class);
    }
    
    /**
     * Answers all visible categories within the receiver.
     *
     * @return ArrayList
     */
    public function getVisibleCategories()
    {
        return $this->getAllCategories()->filterByCallback(function ($category) {
            return $category->hasFAQs();
        });
    }
    
    /**
     * Answers a list of FAQs within the page.
     *
     * @return DataList
     */
    public function getFAQs()
    {
        return FAQ::get()->filter('ParentID', $this->AllChildren()->column('ID') ?: null);
    }
    
    /**
     * Answers a list of FAQs within the receiver.
     *
     * @return DataList
     */
    public function getListItems()
    {
        return $this->getFAQs();
    }
    
    /**
     * Answers the link mode for FAQs.
     *
     * @return string
     */
    public function getLinkMode()
    {
        return ($this->ShowFAQs) ? 'anchor' : 'category';
    }
    
    /**
     * Answers a message string to be shown when no data is available.
     *
     * @return string
     */
    public function getNoDataMessage()
    {
        return _t(__CLASS__ . '.NODATAAVAILABLE', 'No data available.');
    }
}
