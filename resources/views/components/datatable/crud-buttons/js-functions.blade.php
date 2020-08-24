<script>
    function generateButtons(tableId, tableConfig) {
        if (!tableConfig || !tableConfig.buttons) {
            return [];
        }
        if (_.isArray(tableConfig.buttons)) {
            let buttons = [];
            tableConfig.buttons.forEach(currentButton => {
                buttons.push(generateButton(tableId, currentButton));
            });
            return buttons;
        }
        return [generateButton(tableId, tableConfig.buttons)];
    }
    function generateButton(tableId, object) {
        if(object != null)
        {
            let element = {
                text: `<i class="${object.icon}"></i> ${object.text}`,
                className: object.className,
                action: function (evt, dt) {
                    let rows = dt.rows( { selected: true } ).data();
                    object.action(evt, rows, dt)
                },
                attr: object.attr
            };
            if (element.attr && element.attr.id) {
                element.attr.id = `${element.attr.id}-${tableId}`
            }
            return element;
        }
    }

</script>
