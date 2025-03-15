import { startStimulusApp } from '@symfony/stimulus-bundle';
import Reveal from '@stimulus-components/reveal'
import Dropdown from '@stimulus-components/dropdown'

const app = startStimulusApp();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
app.register('reveal', Reveal);
app.register('dropdown', Dropdown);
