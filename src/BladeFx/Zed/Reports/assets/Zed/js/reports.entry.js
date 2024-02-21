'use strict';

require('../sass/reports.scss')
import CategorySwitcher from "./modules/category-switcher";
import ParameterFormModal from "./modules/parameter-form-modal";

const categorySwitcher = new CategorySwitcher();
const parameterFormModal = new ParameterFormModal()

categorySwitcher.init();
parameterFormModal.init();
