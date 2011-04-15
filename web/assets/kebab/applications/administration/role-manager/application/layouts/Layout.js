/**
 * Kebab Application Bootstrap Class
 *
 * @category    Kebab (kebab-reloaded)
 * @package     Applications
 * @namespace   KebabOS.applications.roleManager.application.layouts
 * @author      Yunus ÖZCAN <yuns.ozcan@lab2023.com>
 * @copyright   Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license     http://www.kebab-project.com/licensing
 */
KebabOS.applications.roleManager.application.layouts.Layout = Ext.extend(Ext.Panel, {

    // Application bootstrap
    bootstrap: null,
    layout:'border',
    border:false,

    initComponent: function() {
        // panels are defined here
        this.mainCenter = new KebabOS.applications.roleManager.application.views.MainCenter({
            bootstrap: this.bootstrap,
            region: 'center'
        });
        this.roleForm = new KebabOS.applications.roleManager.application.views.RoleForm({
            bootstrap: this.bootstrap,
            region: 'west',
            width:200,
            collapseMode:'mini',
            split:true
        });


        var config = {
            items:[this.mainCenter,this.roleForm]
        }

        Ext.apply(this, config);

        KebabOS.applications.roleManager.application.layouts.Layout.superclass.initComponent.call(this);
    }
});
