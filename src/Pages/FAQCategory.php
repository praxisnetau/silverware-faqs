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

use SilverWare\Lists\ListSource;
use Page;

/**
 * An extension of the page class for an FAQ category.
 *
 * @package SilverWare\FAQs\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-faqs
 */
class FAQCategory extends Page implements ListSource
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'FAQ Category';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'FAQ Categories';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A category within an FAQ page which holds a series of FAQs';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/faqs: admin/client/dist/images/icons/FAQCategory.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_FAQCategory';
    
    /**
     * Defines the default child class for this object.
     *
     * @var string
     * @config
     */
    private static $default_child = FAQ::class;
    
    /**
     * Determines whether this object can exist at the root level.
     *
     * @var boolean
     * @config
     */
    private static $can_be_root = false;
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'HideFromMainMenu' => 1
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        FAQ::class
    ];
    
    /**
     * Answers a list of FAQs within the category.
     *
     * @return DataList
     */
    public function getFAQs()
    {
        return FAQ::get()->filter('ParentID', $this->ID);
    }
    
    /**
     * Answers true if the receiver has at least one FAQ.
     *
     * @return boolean
     */
    public function hasFAQs()
    {
        return $this->getFAQs()->exists();
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
     * Answers a unique ID for the HTML template.
     *
     * @return string
     */
    public function getHTMLID()
    {
        return $this->URLSegment;
    }
    
    /**
     * Answers true if the footer for FAQs is to be shown in the template.
     *
     * @return boolean
     */
    public function isFooterShown()
    {
        return (boolean) $this->getParent()->ShowTopButtons;
    }
    
    /**
     * Answers the icon to use for top buttons.
     *
     * @return string
     */
    public function getTopIcon()
    {
        return $this->getParent()->TopIcon;
    }
    
    /**
     * Answers the label to use for top buttons.
     *
     * @return string
     */
    public function getTopLabel()
    {
        return $this->getParent()->TopLabel;
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
