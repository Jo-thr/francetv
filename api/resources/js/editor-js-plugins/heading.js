NovaEditorJS.booting(function (editorConfig, fieldConfig) {
    if (fieldConfig.toolSettings.header.activated === true) {
        editorConfig.tools.header = {
            class: require('@editorjs/header'),
            config: {
                placeholder: fieldConfig.toolSettings.header.placeholder,
                levels: fieldConfig.toolSettings.header.levels,
                defaultLevel: 2
            },
            shortcut: fieldConfig.toolSettings.header.shortcut
        }
    }
});
