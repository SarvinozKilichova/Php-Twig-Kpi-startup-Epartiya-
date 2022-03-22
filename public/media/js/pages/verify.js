$(function() {
    $('.ui.form').form({
        fields: {
            code: {
                identifier  : 'code',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Тасдиқлаш коди киритилмаган'
                    }
                ]
            }
        }
    });
});