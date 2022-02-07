NovaEditorJS.booting(function (editorConfig, fieldConfig) {
    if (fieldConfig.toolSettings.quote.activated === true) {
        editorConfig.tools.quote = {
            class: require('@editorjs/quote'),
            config: {
                placeholder: fieldConfig.toolSettings.quote.placeholder,
                inlineToolbar: true,
            },
            shortcut: fieldConfig.toolSettings.quote.shortcut
        }
    }
});
