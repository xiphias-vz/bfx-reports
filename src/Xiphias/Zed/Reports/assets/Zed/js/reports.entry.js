'use strict';

require('../sass/reports.scss')

import CategorySwitcher from "./modules/category-switcher";
import PreviewListener from './modules/preview-listener';
const categorySwitcher = new CategorySwitcher();
const previewListener = new PreviewListener();

categorySwitcher.init();
previewListener.initialize();
