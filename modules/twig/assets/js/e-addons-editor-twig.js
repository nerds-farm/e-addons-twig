function e_addons_check_twig_loading() {
    var preview = jQuery("iframe#elementor-preview-iframe").contents();
    if (preview.find("div.elementor-widget-e-text-editor-twig").length) {
        if (preview.find("div.elementor-widget-e-text-editor-twig.elementor-loading").length) {
            // disable save buttons
            jQuery('#elementor-panel-saver-button-publish, #elementor-panel-saver-button-save-options, #elementor-panel-saver-menu-save-draft').addClass('elementor-saver-disabled').prop('disabled', true);
            jQuery('#elementor-panel-saver-button-publish').addClass('e-addons-elementor-saver-disabled');
            //jQuery('.elementor-control-custom_twig_error .e-addons-php-error').slideDown();
            //console.log('errore');
        } else {
            if (jQuery('#elementor-panel-saver-button-publish').hasClass('e-addons-elementor-saver-disabled')) {
                // enable save buttons
                jQuery('#elementor-panel-saver-button-publish, #elementor-panel-saver-button-save-options, #elementor-panel-saver-menu-save-draft').removeClass('elementor-saver-disabled').removeClass('elementor-disabled').prop('disabled', false).removeProp('disabled');
                jQuery('#elementor-panel-saver-button-publish').removeClass('e-addons-elementor-saver-disabled');
            }
            //jQuery('.elementor-control-custom_twig_error .e-addons-php-error').slideUp();
        }
    }
}

// TWIG
jQuery(window).load(function () {
    elementor.hooks.addAction('panel/open_editor/widget/e-text-editor-twig', function (panel, model, view) {
        e_addons_check_twig_loading();
    });
    if (jQuery('#elementor-preview-iframe').length) {
        setInterval(function () {
            e_addons_check_twig_loading();
        }, 1000);
    }
});
console.log('E-TWIG');