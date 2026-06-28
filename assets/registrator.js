import { LightBooleanController } from '@corvet/light-stimulus-bundle/controllers/light_boolean_controller.js'
import { LightDateController } from '@corvet/light-stimulus-bundle/controllers/light_date_controller.js'
import { LightDecimalController } from '@corvet/light-stimulus-bundle/controllers/light_decimal_controller.js'
import { LightEntityController } from '@corvet/light-stimulus-bundle/controllers/light_entity_controller.js'
import { LightIntegerController } from '@corvet/light-stimulus-bundle/controllers/light_integer_controller.js'
import { LightStringController } from '@corvet/light-stimulus-bundle/controllers/light_string_controller.js'
import { LightTextController } from '@corvet/light-stimulus-bundle/controllers/light_text_controller.js'

export default class {
    doRegister(app) {
        app.register('corvet--light-symfony-bundle--light-boolean', LightBooleanController);
        app.register('corvet--light-symfony-bundle--light-date', LightDateController);
        app.register('corvet--light-symfony-bundle--light-decimal', LightDecimalController);
        app.register('corvet--light-symfony-bundle--light-entity', LightEntityController);
        app.register('corvet--light-symfony-bundle--light-integer', LightIntegerController);
        app.register('corvet--light-symfony-bundle--light-string', LightStringController);
        app.register('corvet--light-symfony-bundle--light-text', LightTextController);
    }
}
